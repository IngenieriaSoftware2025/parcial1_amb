<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\Actividades;
use Model\Asistencias;
use MVC\Router;

class AsistenciaController extends ActiveRecord
{

    public function paginaindex(Router $router)
    {
        $actividades = Actividades::all();

        $router->render('asistencias/index', [
            'actividades' => $actividades,
        ]);
    }


    public static function guardarAPI()
    {

        getHeadersApi();

        $_POST['asi_horaestablecida'] = date('Y-m-d H:i', strtotime($_POST['asi_horaestablecida']));
        $_POST['asi_horallegada'] = date('Y-m-d H:i', strtotime($_POST['asi_horallegada']));


        $_POST['asi_actividad'] = filter_var($_POST['asi_actividad'], FILTER_VALIDATE_INT);
        $actividad = $_POST['asi_actividad'];

        if ($actividad !== false && $actividad > 0) {
            try {
                $data = new Asistencias([
                    'asi_actividad' => $_POST['asi_actividad'],
                    'asi_horaestablecida' => $_POST['asi_horaestablecida'],
                    'asi_horallegada' => $_POST['asi_horallegada'],
                    'asi_situacion' => 1
                ]);

                $data->evaluarPuntualidad();

                $crear = $data->crear();

                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Exito, se registro la asistencia'
                ]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Error al guardar',
                    'detalle' => $e->getMessage(),
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Debe seleccionar una actividad valida'
            ]);
            return;
        }
    }


    public static function buscarAPI()
    {

        try {

            $sql = "SELECT * FROM asistencia where asi_situacion = 1";
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Asistencias obtenidas correctamente',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener las Asistencias',
                'detalle' => $e->getMessage(),
            ]);
        }
    }


    public static function modificarAPI()
    {
        getHeadersApi();

        $id = $_POST['asi_id'];
        $_POST['asi_horaestablecida'] = date('Y-m-d H:i', strtotime($_POST['asi_horaestablecida']));
        $_POST['asi_horallegada'] = date('Y-m-d H:i', strtotime($_POST['asi_horallegada']));


        $_POST['asi_actividad'] = filter_var($_POST['asi_actividad'], FILTER_VALIDATE_INT);
        $actividad = $_POST['asi_actividad'];

        if ($actividad !== false && $actividad > 0) {
            try {

                $data = Asistencias::find($id);
                $data->sincronizar([
                    'asi_actividad' => $_POST['asi_actividad'],
                    'asi_horaestablecida' => $_POST['asi_horaestablecida'],
                    'asi_horallegada' => $_POST['asi_horallegada'],
                    'asi_situacion' => 1
                ]);

                $data->evaluarPuntualidad();
                $data->actualizar();

                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Exito, se modifico la asistencia'
                ]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Error al guardar',
                    'detalle' => $e->getMessage(),
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Registre una actividad valida'
            ]);
            return;
        }
    }


    public static function EliminarAPI()
    {

        try {

            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

            $ejecutar = Asistencias::EliminarAsistencias($id);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'El registro ha sido eliminado correctamente'
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Eliminar',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
