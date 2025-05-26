<?php
namespace Controllers;

use Model\ActiveRecord;
use MVC\Router;

class ASistenciaController extends ActiveRecord {

    public function paginaindex(Router $router){
        $router->render('asistencias/index', []);
    }
}