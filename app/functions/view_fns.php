<?php

class ViewWithTemplate {
    private $view;
    private $template;
    private $data=[];

    public function __construct(string $view,string $template,array $data)
    {
        $this->view = $view;
        $this->template = $template;
        $this->data = $data;
    }

    private function renderTemplate($content){
        ob_start();
        extract($this->data);
        include TEMPLATEPATH.$this->template.".php";
        return ob_get_clean();
    }
    private function renderView(){
        ob_start();
        extract($this->data);
        include VIEWPATH.$this->view.".php";
        return ob_get_clean();
    }
    public function renderViewWithTemplate(){
        $content = $this->renderView();
        return $this->renderTemplate($content);
    }
}
