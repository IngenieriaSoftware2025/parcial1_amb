<?php

namespace Model;

class Asistencias extends ActiveRecord
{

    public static $tabla = 'asistencias';
    public static $columnasDB = [

        'asi_actividad',
        'asi_horaestablecida',
        'asi_horallegada',
        'asi_situacion'
    ];
    public static $idTabla = 'asi_id';

    public $asi_id;
    public $asi_actividad;
    public $asi_horaestablecida;
    public $asi_horallegada;
    public $asi_situacion;


    public function __construct($args = []){
        $this->asi_id = $args['asi_id'] ?? null;
        $this->asi_actividad = $args['asi_actividad'] ?? '';
        $this->asi_horaestablecida = $args['asi_horaestablecida'] ?? '';
        $this->asi_horallegada = $args['asi_horallegada'] ?? '';
        $this->asi_situacion = $args['asi_situacion'] ?? 1;
    }

    public static function EliminarAsistencias($id){

        $sql = "UPDATE asistencias SET asi_situacion = 0 WHERE asi_id = $id";

        return self::SQL($sql);
    }
}