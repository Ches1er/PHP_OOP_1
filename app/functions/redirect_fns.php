<?php

class Redirect{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function redirect(){
        header("Location:{$this->url}");
        return "";
    }
}

class Redirect_back_with_errors{
    private $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    public function redirect_back(){
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $_SESSION["errors"] = $this->errors;
        $_SESSION["old"] = $_POST;
        $redirect = new Redirect($_SERVER["HTTP_REFERER"]);
        return $redirect->redirect();
    }
}

