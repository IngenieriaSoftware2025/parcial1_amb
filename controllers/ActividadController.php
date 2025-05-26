<?php
namespace Controllers;

use Model\ActiveRecord;
use MVC\Router;

class ActividadController extends ActiveRecord {

    public function paginaactividades(Router $router){
        $router->render('actividades/index', []);
    }
}