<?php

class action_index{
    private $view="main";
    private $template="default";

    public function run(){
        $v = new ViewWithTemplate($this->view,$this->template,["title"=>"Главная",
            "user"=>new Auth(new FileStorage('users'))]);
        return $v->renderViewWithTemplate();
    }
}

class action_contacts{
    private $view="contacts";
    private $template="default";
    private $data = ["title"=>"Контакты"];

    public function run(){
        $v = new ViewWithTemplate($this->view,$this->template,$this->data);
        return $v->renderViewWithTemplate();
    }
}
