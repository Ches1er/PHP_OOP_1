<?php
trait login_register{

    private function unset_errors_old(){
        if ($_SESSION["errors"]!=null)unset($_SESSION["errors"]);
        if ($_SESSION["old"]!=null)unset($_SESSION["old"]);
        return "";
    }
    public function run(){
        $auth = new Auth("users");
        $redirect = new Redirect("/");
        if ($auth->auth_isAuth())return $redirect->redirect();
        $v = new ViewWithTemplate($this->view,$this->template,["errors"=>$_SESSION["errors"]]);
        $this->unset_errors_old();
        return $v->renderViewWithTemplate();
    }
}

class action_login{
    private $view="login";
    private $template="default";

    use login_register;
}

class action_register{
    private $view="register";
    private $template="default";

    use login_register;
}

class action_logout{
    public function run(){
        $auth = new Auth("users");
        $auth->auth_logout();
        $redirect = new Redirect("/");
        return $redirect->redirect();
    }
}

class action_loginhandle{

    public function run(){
        $auth = new Auth("users");
        if(empty($_POST["login"])||empty($_POST["pass"])){
            $rb=new Redirect_back_with_errors($_SERVER["HTTP_REFERER"],"Заполните все поля");
            return $rb->redirect_back();
        }
        if(!$auth->auth_login($_POST["login"],$_POST["pass"])){
            $rb=new Redirect_back_with_errors($_SERVER["HTTP_REFERER"],"Логин или пароль неверен");
            return $rb->redirect_back();
        }
        $redirect = new Redirect("/");
        return $redirect->redirect();
    }
}

class action_registerhandle{

    public function run(){
        $auth = new Auth("users");

        if(empty($_POST["login"])||empty($_POST["pass"])||empty($_POST["pass2"])){
            $rb=new Redirect_back_with_errors($_SERVER["HTTP_REFERER"],"Заполните все поля");
            return $rb->redirect_back();
        }
        if($_POST["pass"]!==$_POST["pass2"]){
            $rb=new Redirect_back_with_errors($_SERVER["HTTP_REFERER"],"Пароли не совпадают");
            return $rb->redirect_back();
        }
        if(!$auth->auth_register($_POST["login"],$_POST["pass"])){
            $rb=new Redirect_back_with_errors($_SERVER["HTTP_REFERER"],"Имя пользователя уже занято");
            return $rb->redirect_back();
        }

        $redirect=new Redirect("/login");
        return $redirect->redirect();
    }
}
