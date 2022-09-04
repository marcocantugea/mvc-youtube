<?php

namespace app;

use controllers\mainController;
use controllers\usuarioController;

class controllersConfig{

    public function getControllers(){
        return [
            'mainController' => mainController::class,
            'usuarioController' => usuarioController::class
        ];
    }

}