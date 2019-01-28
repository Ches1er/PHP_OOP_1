<?php
class AppStart{

    private $functions_arr = ["file_storage","auth", "view", "redirect"];

    public function __construct()
    {
    }

    private function getFunctions(){
        foreach ($this->functions_arr as $f){
            include FNSPATH . "{$f}_fns.php";
        }
    }

    public function run(){
        $this->getFunctions();
        include ROOTPATH."router.php";
        $router = new RunRouter();
        //Get array(controller and action) from router
        $controller_action = $router->run();
        //Get controller to start
        $controller = $controller_action[0];
        include CONTROLLERPATH."/controller_".$controller.".php";
        //Get action to start
        $action = "action_".$controller_action[1];
        $action = new $action();
        echo $action->run();
    }
}
