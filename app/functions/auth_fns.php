<?php
class Auth extends FileStorage {

    public function __construct($file){
        parent::__construct($file);
    }

    private function _auth_getUserByLogin($login){
        $users = $this->fs_getAll();
        foreach ($users as $u)
            if($u["login"]===$login) return $u;
        return NULL;
    }

    private function _auth_sessionAutostart(){
        if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    }

    private function _auth_hash_pass($pass){
        return hash("sha256",$pass);
    }

    private function _auth_create_user_session($user){
        $id = $user["id"];
        $this->_auth_sessionAutostart();
        $_SESSION["user_id"]=$id;
        $_SESSION["user_agent"]=md5($_SERVER["HTTP_USER_AGENT"]);
    }

    public function auth_register($name,$pass){
        if($this->_auth_getUserByLogin($name)!==NULL) return false;
        $user=[
            "login"=>$name,
            "pass"=>$this->_auth_hash_pass($pass)
        ];
        $this->fs_append($user);
        return true;
    }

    public function auth_login($name,$pass){
        $user = $this->_auth_getUserByLogin($name);
        if($user===NULL) return false;
        if ($user["pass"]!==$this->_auth_hash_pass($pass)) return false;
        $this->_auth_create_user_session($user);
        return true;
    }

    public function auth_logout(){
        $this->_auth_sessionAutostart();
        session_destroy();
    }

    public function auth_isAuth(){
        $this->_auth_sessionAutostart();
        if(empty($_SESSION["user_id"])||empty($_SESSION["user_agent"])) return false;
        if($_SESSION["user_agent"]!==md5($_SERVER["HTTP_USER_AGENT"])) return false;
        return true;
    }

    public function auth_currentUser(){
        if(!$this->auth_isAuth()) return NULL;
        return $this->fs_getById($_SESSION["user_id"]);
    }
}


