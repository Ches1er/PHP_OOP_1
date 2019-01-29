<?php
class AppStart{

    private $functions_arr = ["file_storage","auth", "view", "redirect"];

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
        include CONTROLLERPATH."/controller_".$controller_action[0].".php";
        //Get action to start
        $action = "action_".$controller_action[1];
        //Start action
        $action = new $action();
        echo $action->run();
    }
}
