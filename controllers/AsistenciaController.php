<?php
namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\Actividades;
use Model\Asistencias;
use MVC\Router;

class AsistenciaController extends ActiveRecord {

    public function paginaindex(Router $router){
        $router->render('asistencias/index', []);
    }

public function paginaindex(Router $router)
    {
        $actividades = Actividades::all();
        $asistencias = Asistencias::all();

        $router->render('asistencias/index', [
            'actividades' => $actividades,
            'asistencias' => $asistencias
        ]);
    }

    
}