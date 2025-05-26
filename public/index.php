<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ActividadController;
use Controllers\AsistenciaController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);

//url's actividades
$router->get('/actividades', [ActividadController::class, 'paginaactividades']);
$router->post('/actividades/guardarAPI', [ActividadController::class, 'guardarAPI']);
$router->get('/actividades/buscarAPI', [ActividadController::class, 'buscarAPI']);
$router->post('/actividades/modificarAPI', [ActividadController::class, 'modificarAPI']);
$router->get('/actividades/eliminar', [ActividadController::class, 'eliminarAPI']);

//url's asistencias
$router->get('/asistencias', [AsistenciaController::class, 'paginaindex']);
$router->post('/asistencias/guardarAPI', [AsistenciaController::class, 'guardarAPI']);
$router->get('/asistencias/buscarAPI', [AsistenciaController::class, 'buscarAPI']);
$router->post('/asistencias/modificarAPI', [AsistenciaController::class, 'modificarAPI']);
$router->get('/asistencias/eliminar', [AsistenciaController::class, 'eliminarAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
