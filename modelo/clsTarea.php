<?php

require_once('conexion.php');

// ESTADOS: [0] => ELIMINADO ; [1] => PENDIENTE ; [2] => [COMPLETADO]

class clsTarea
{
    function listarTarea($descripcion, $estado)
    {
        $sql = "SELECT * FROM tarea WHERE estado>0 ";
        $parametos = array();
        if ($descripcion != "") {
            $sql .= " AND descripcion LIKE :descripcion ";
            $parametos[':descripcion'] = '%' . $descripcion . '%';
        }

        if ($estado != "") {
            $sql .= " AND estado=:estado ";
            $parametos[':estado'] = $estado;
        }

        $sql .= " ORDER BY idtarea ASC ";

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametos);

        return $pre;
    }

    function insertarTarea($descripcion, $estado)
    {
        date_default_timezone_set('America/Lima');

        $fecha = date("Y-m-d h:i:s");

        $sql = "INSERT INTO tarea VALUES(null,:descripcion,:estado,:fecha)";
        $parametos = array(':descripcion' => $descripcion, ':estado' => $estado, ':fecha' => $fecha);

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametos);
        return $pre;
    }

    function verificarDuplicado($descripcion, $idtarea = 0)
    {
        $sql = "SELECT * FROM tarea WHERE estado>0 AND descripcion=:descripcion AND idtarea<>:idtarea";
        $parametos = array(':descripcion' => $descripcion, ':idtarea' => $idtarea);

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametos);
        return $pre;
    }

    function consultarTareaPorId($idtarea)
    {
        $sql = "SELECT * FROM tarea WHERE idtarea=:idtarea";
        $parametos = array(':idtarea' => $idtarea);

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametos);
        return $pre;
    }

    function actualizarTarea($idtarea, $descripcion, $estado)
    {
        $sql = "UPDATE tarea SET descripcion=:descripcion, estado=:estado WHERE idtarea=:idtarea";
        $parametos = array(':descripcion' => $descripcion, ':estado' => $estado, ':idtarea' => $idtarea);

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametos);
        return $pre;
    }

    function actualizarEstadoTarea($idtarea, $estado)
    {
        $sql = "UPDATE tarea SET estado=:estado WHERE idtarea=:idtarea ";
        $parametos = array(':idtarea' => $idtarea, ':estado' => $estado);

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametos);
        return $pre;
    }
}
