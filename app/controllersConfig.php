<?php

namespace app;

use controllers\mainController;

class controllersConfig{

    public function getControllers(){
        return [
            'mainController' => mainController::class
        ];
    }

}