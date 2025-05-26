<?php
namespace Controllers;

use Exception;
use Model\ActiveRecord;
use MVC\Router;
use Model\Actividades;


class ActividadController extends ActiveRecord {

    public function paginaactividades(Router $router){
        $router->render('actividades/index', []);
    }


    public static function guardarAPI()
    {

        getHeadersApi();

        $_POST['act_nombre'] = htmlspecialchars($_POST['act_nombre']);
        $_POST['act_horario'] = date('Y-m-d H:i', strtotime($_POST['act_horario']));

        $cantidad_nombre = strlen($_POST['act_nombre']);
        if ($cantidad_nombre > 2) {

            try {

                $data = new Actividades([
                    'act_nombre' => $_POST['act_nombre'],
                    'act_situacion' => 1
                ]);

                $crear = $data->crear();

                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Exito, se registro la categoria'
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
                'mensaje' => 'Registre un nombre coherente'
            ]);
            return;
        }
    }


    public static function buscarAPI(){

        try {

            $sql = "SELECT * FROM actividades where act_situacion = 1";
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Actividades obtenidas correctamente',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener las Actividades',
                'detalle' => $e->getMessage(),
            ]);
        }
    }


    public static function modificarAPI() {

        getHeadersApi();

        $id = $_POST['act_id'];
        $_POST['act_horario'] = date('Y-m-d H:i', strtotime($_POST['act_horario']));
        $_POST['act_nombre'] = htmlspecialchars($_POST['act_nombre']);

        $cantidad_nombre = strlen($_POST['act_nombre']);
        if ($cantidad_nombre > 2) {

            try {

                $data = Actividades::find($id);
                $data->sincronizar([
                    'act_nombre' => $_POST['act_nombre'],
                    'act_situacion' => 1
                ]);
                $data->actualizar();

                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Exito, se modifico la categoria'
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
                'mensaje' => 'Registre un nombre coherente'
            ]);
            return;
        }
    }


    public static function EliminarAPI() {

        try{

            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

            $ejecutar = Actividades::EliminarActividades($id);

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
