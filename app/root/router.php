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

    public function getRoutingArr(): array
    {
        return $this->routing_arr;
    }
}

class Filter_config{
    private $filter_arr = ['/contacts'];

    public function getFilterArr(): array
    {
        return $this->filter_arr;
    }
}

class Navigate{

    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    private function routing_getCurentAdrr(){
        return trim(explode("?", $_SERVER["REQUEST_URI"])[0], "/");
    }

    private function routing_isfilteredUrl($fc){
        foreach ($fc as $f)
            if (trim($f, "/") === $this->routing_getCurentAdrr()) return true;
        return false;
    }

    public function routing_navigate(){
        //Array w filtered adresses
        $fc = new Filter_config();
        //Create new Auth object
        $auth = new Auth(new FileStorage("users"));
        //Check if user is not auth and url is in filter
        if($this->routing_isfilteredUrl($fc->getFilterArr())&& !$auth->auth_isAuth())
            return "error@404";

        $url = $this->routing_getCurentAdrr();
        // Get array with routes, check if url matches routes and return routes
        $ra = new Routing_config();
        foreach ($ra->getRoutingArr() as $key => $value) {
            if ($url === trim($key, "/"))
                return $value;
        }
        return "error@404";
    }
}

class Route_execute{
    private $route;
    private $config_action=[];

    public function __construct(string $route)
    {
        $this->route = $route;
    }

    public function getConfigAction(): array
    {
        $route = explode("@", $this->route);
        $controller_filename = $route[0];
        $action_name=$route[1];
        $this->config_action[0]=$controller_filename;
        $this->config_action[1]=$action_name;
        return $this->config_action;
    }
}

class RunRouter{
    private $routes;
    private $navigate;

    public function run(){
        $this->routes = new Routing_config();
        $this->navigate = new Navigate($this->routes->getRoutingArr());
        $re = new Route_execute($this->navigate->routing_navigate());
        return $re->getConfigAction();
    }
}