<?php
class action_login{
    private $view="login";
    private $template="default";

    public function __construct()
    {
    }
    public function run(){
        $auth = new Auth(new FileStorage("users"));
        $redirect = new Redirect("/");
        if ($auth->auth_isAuth())return $redirect->redirect();
        $v = new ViewWithTemplate($this->view,$this->template,["errors"=>$_SESSION["errors"]]);
        if ($_SESSION["errors"]!=null)unset($_SESSION["errors"]);
        return $v->renderViewWithTemplate();
    }
}

class action_register{
    private $view="register";
    private $template="default";

    public function __construct()
    {
    }
    public function run(){
        $auth = new Auth(new FileStorage("users"));
        $redirect = new Redirect("/");
        if ($auth->auth_isAuth())return $redirect->redirect();
        $v = new ViewWithTemplate($this->view,$this->template,["errors"=>$_SESSION["errors"],"old"=>$_SESSION["old"]]);
        if ($_SESSION["errors"]!=null)unset($_SESSION["errors"]);
        if ($_SESSION["old"]!=null)unset($_SESSION["old"]);
        return $v->renderViewWithTemplate();
    }
}

class action_logout{
    public function __construct()
    {
    }
    public function run(){
        $auth = new Auth(new FileStorage("users"));
        $redirect = new Redirect("/");
        $auth->auth_logout();
        return $redirect->redirect();
    }
}

class action_loginhandle{
    public function __construct()
    {
    }
    public function run(){
        $auth = new Auth(new FileStorage("users"));
        if(empty($_POST["login"])||empty($_POST["pass"])){
            $rb=new Redirect_back_with_errors("Заполните все поля");
            return $rb->redirect_back();
        }
        if(!$auth->auth_login($_POST["login"],$_POST["pass"])){
            $rb=new Redirect_back_with_errors("Логин или пароль неверен");
            return $rb->redirect_back();
        }
        $redirect = new Redirect("/");
        return $redirect->redirect();
    }
}

class action_registerhandle{
    public function __construct()
    {
    }
    public function run(){
        $rb=new Redirect("/login");
        $auth = new Auth(new FileStorage("users"));
        if(empty($_POST["login"])||empty($_POST["pass"])||empty($_POST["pass2"])){
            $rb=new Redirect_back_with_errors("Заполните все поля");
            return $rb->redirect_back();
        }
        if($_POST["pass"]!==$_POST["pass2"]){
            $rb=new Redirect_back_with_errors("Пароли не совпадают");
            return $rb->redirect_back();
        }
        if(!$auth->auth_register($_POST["login"],$_POST["pass"])){
            $rb=new Redirect_back_with_errors("Имя пользователя уже занято");
            return $rb->redirect_back();
        }
        return $rb->redirect();
    }
}
