<?php

class Routing_config{
    private $routing_arr = [
        "/" => "main@index",
        "/login" => "login@login",
        "/register" => "login@register",
        "/logout" => "login@logout",
        "/login/handle" => "login@loginhandle",
        "/register/handle" => "login@registerhandle",
        "/contacts" => "main@contacts"];

    public function getRoutingArr(): array {
        return $this->routing_arr;
    }
}

class Filter_config{
    private $filter_arr = ['/contacts'];

    public function getFilterArr(): array {
        return $this->filter_arr;
    }
}

class Navigate{

    private $routes;
    private $filter;
    private $auth;

    public function __construct(Routing_config $routes,Filter_config $filter)
    {
        $this->routes = $routes->getRoutingArr();
        $this->filter = $filter->getFilterArr();
        $this->auth = new Auth("users");
    }

    private function routing_getCurentAdrr(){
        return trim(explode("?", $_SERVER["REQUEST_URI"])[0], "/");
    }

    private function routing_isfilteredUrl(){
        foreach ($this->filter as $f)
            if (trim($f, "/") === $this->routing_getCurentAdrr()) return true;
        return false;
    }

    public function routing_navigate():string {
        //Check if user is not auth and url is in filter
        if($this->routing_isfilteredUrl() && !$this->auth->auth_isAuth()) return "error@404";
        $url = $this->routing_getCurentAdrr();
        // Get array with routes, check if url matches routes and return routes
        foreach ($this->routes as $key => $value) {
            if ($url === trim($key, "/")) return $value;
        }
        return "error@404";
    }
}

class RouteToTheControllerAction{
    private $route;
    private $contr_action=[];

    public function __construct(string $route){
        $this->route = $route;
    }

    public function getControllerAction(): array {
        $route = explode("@", $this->route);
        $controller_filename = $route[0];
        $action_name=$route[1];
        $this->contr_action[0]=$controller_filename;
        $this->contr_action[1]=$action_name;
        return $this->contr_action;
    }
}

class RunRouter{
    private $routes;
    private $filter;
    private $navigate;

    public function run(){
        $this->routes = new Routing_config();
        $this->filter = new Filter_config();
        $this->navigate = new Navigate($this->routes,$this->filter);
        $contr_act = new RouteToTheControllerAction($this->navigate->routing_navigate());
        return $contr_act->getControllerAction();
    }
}