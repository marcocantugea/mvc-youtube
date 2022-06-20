<?php

namespace app;

use controllers\mainController;

class router{

    public function route(){

        $mainControlador= new mainController;

        if(!isset($_GET['url'])){
            $mainControlador->indexAction();
            return;
        }

        $url=$_GET['url'];

        if(strpos($url,"/")===false) {
            $controlador=$url."Controller";
            $funcion="indexAction";
            $id=null;
        }else{
            $ruta= explode("/",$url);
            $controlador=$ruta[0]."Controller";
            $funcion=(isset($ruta[1])) ? $ruta[1]."Action" : "indexAction";
            $id=(isset($ruta[2])) ? $ruta[2] : null ;
            $agrs=(isset($ruta[3])) ? \array_slice($ruta,3) : null;
        }
        
        $configuracionControllers= new controllersConfig();

        if(!isset($configuracionControllers->getControllers()[$controlador])){
            $mainControlador->errorAction();
            return;
        }

        $controller= $configuracionControllers->getControllers()[$controlador];
        $ControladorObj= new $controller;

        try {
            $ControladorObj->{$funcion}($id,$agrs);
        } catch (\Throwable $th) {
            $mainControlador->errorAction();
            return;
        }

    }

}