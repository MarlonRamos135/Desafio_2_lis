<?php

abstract class Controller{
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function render($view, $viewBag=[]){
        $file="Views/".static::class."/$view";
        $file = str_replace("Controller","",$file);
        if(is_file($file)){
            extract($viewBag);
            ob_start();
            require($file);
            $content=ob_get_contents();
            ob_end_clean();
            echo $content;
        }
        else{
            echo "<h1>View not found</h1>";
        }
    }
}