<?php
require_once('../modelo/clsTarea.php');

controlador($_POST['accion']);

// ESTADOS: [0] => ELIMINADO ; [1] => PENDIENTE ; [2] => [COMPLETADO]

function controlador($accion)
{
    $objCat = new clsTarea();

    switch ($accion) {
        case 'NUEVO':
            $resultado = array();
            try {
                $descripcion = $_POST['descripcion'];
                $estado = $_POST['estado'];

                $existeTarea = $objCat->verificarDuplicado($descripcion);
                if ($existeTarea->rowCount() > 0) {
                    throw new Exception("Existe una tarea con la misma descripcion", 1);
                }

                $objCat->insertarTarea($descripcion, $estado);
                $resultado['correcto'] = 1;
                $resultado['mensaje'] = "Tarea Registrada de forma Satisfactoria";

                echo json_encode($resultado);
            } catch (Exception $e) {
                $resultado['correcto'] = 0;
                $resultado['mensaje'] = "No se pudo registrar la tarea. " . $e->getMessage();

                echo json_encode($resultado);
            }

            break;

        case 'ACTUALIZAR':
            $resultado = array();
            try {
                $descripcion = $_POST['descripcion'];
                $estado = $_POST['estado'];
                $idtarea = $_POST['idtarea'];

                $existeTarea = $objCat->verificarDuplicado($descripcion, $idtarea);
                if ($existeTarea->rowCount() > 0) {
                    throw new Exception("Existe una tarea con la misma Descripcion", 1);
                }

                $objCat->actualizarTarea($idtarea, $descripcion, $estado);
                $resultado['correcto'] = 1;
                $resultado['mensaje'] = "Tarea Actualizada de forma Satisfactoria";

                echo json_encode($resultado);
            } catch (Exception $e) {
                $resultado['correcto'] = 0;
                $resultado['mensaje'] = "No se pudo actualizar la categoria. " . $e->getMessage();

                echo json_encode($resultado);
            }

            break;

        case 'CONSULTAR_TAREA':
            try {
                $idtarea = $_POST['idtarea'];
                $resultado = $objCat->consultarTareaPorId($idtarea);
                $resultado = $resultado->fetch(PDO::FETCH_NAMED);
                echo json_encode($resultado);
            } catch (Exception $e) {
                $resultado['correcto'] = 0;
                $resultado['mensaje'] = $e->getMessage();

                echo json_encode($resultado);
            }
            break;

        case 'CAMBIAR_ESTADO_TAREA':
            try {
                $idtarea = $_POST['idtarea'];
                $estado = $_POST['estado'];
                $arrayEstado = array('ELIMINADA', 'PENDIENTE', 'COMPLETADA');

                $objCat->actualizarEstadoTarea($idtarea, $estado);
                $resultado = array('correcto' => 1, 'mensaje' => 'El estado de la tarea ha sido cambiado a: ' . $arrayEstado[$estado] . ' de forma satisfactoria');
                echo json_encode($resultado);
            } catch (Exception $e) {
                $resultado = array('correcto' => 0, 'mensaje' => $e->getMessage());
                echo json_encode($resultado);
            }
            break;

        default:
            // code...
            break;
    }
}
