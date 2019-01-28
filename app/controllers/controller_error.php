<?php
class action_404{
    private $view="<h1>404</h1>";

    public function run(){
        return $this->view;
    }
}