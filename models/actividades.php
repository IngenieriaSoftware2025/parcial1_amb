<?php

namespace Model;

class Actividades extends ActiveRecord
{

    public static $tabla = 'actividades';
    public static $columnasDB = [

        'act_nombre',
        'act_horario',
        'act_situacion'
    ];
    public static $idTabla = 'act_id';

    public $act_id;
    public $act_nombre;
    public $act_horario;
    public $act_situacion;


    public function __construct($args = []){
        $this->act_id = $args['act_id'] ?? null;
        $this->act_nombre = $args['act_nombre'] ?? '';
        $this->act_horario = $args['act_horario'] ?? '';
        $this->act_situacion = $args['act_situacion'] ?? 1;
    }

    public static function EliminarActividades($id){

        $sql = "UPDATE actividades SET act_situacion = 0 WHERE act_id = $id";

        return self::SQL($sql);
    }
}