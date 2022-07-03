<?php

namespace controllers;

class mainController{

    public function indexAction(){
        echo 'pagina Principal sin rutas';
    }

    public function errorAction(){
        echo 'pagina de error';
    }

    public function parseString(){
        echo "funcion de parse string";
    }

    public function viewConfigAction(){
        $args= func_get_args();
        echo "pagina de ver configuracion ";
        print_r($args);
    }

}