<?php
require_once '../models/AsignacionAulasModel.php';

class AsignacionAulasController
{
    public function getAllAsignaciones()
    {
        $asignacion = new AsignacionAulasModel();
        try {
            $asignacion = $asignacion->getAll();
            if ($asignacion === null) {
                return [];
            } else {
                return $asignacion;
            }
        } catch (Exception $e) {
            error_log("Error en AsistenciaController::getAllAsistencias: " . $e->getMessage());
            return [];
        }
    }
    public function createAsignacion()
    {
        $asignacion = new AsignacionAulasModel();
        try {
            $success = $asignacion->create($_POST['aula_id'], $_POST['usuario_id']);
            return array('status' => true, 'msg' => 'Asignacion registrada');
        } catch (Exception $e) {
            error_log("Error en AsistenciaNiñosController::createAsistenciaNiño: " . $e->getMessage());
            return array('status' => false, 'msg' => $e->getMessage());
        }
    }
}
