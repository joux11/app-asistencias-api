<?php
require_once '../models/AsistenciaModel.php';

class AsistenciaController
{
    public function getAllAsistencias()
    {
        $asistenciaModel = new AsistenciaModel();

        try {
            $asistencias = $asistenciaModel->getAll();
            if ($asistencias === null) {
                return [];
            } else {
                return $asistencias;
            }
        } catch (Exception $e) {
            error_log("Error en AsistenciaController::getAllAsistencias: " . $e->getMessage());
            return [];
        }
    }

    public function getAsistenciaById($id)
    {
        $asistenciaModel = new AsistenciaModel();

        try {
            $asistencia = $asistenciaModel->getById($id);
            if ($asistencia === null) {
                return [];
            } else {
                return $asistencia;
            }
        } catch (Exception $e) {
            error_log("Error en AsistenciaController::getAsistenciaById: " . $e->getMessage());
            return [];
        }
    }
    public function getAsistenciaByUsuario()
    {
        $asistenciaModel = new AsistenciaModel();

        try {
            $asistencia = $asistenciaModel->getByUserId($_POST['usuario_id']);
            if ($asistencia === null) {
                return [];
            } else {
                return $asistencia;
            }
        } catch (Exception $e) {
            error_log("Error en AsistenciaController::getAsistenciaById: " . $e->getMessage());
            return [];
        }
    }

    public function getAsistenciaByDateAndId()
    {
        $asistenciaModel = new AsistenciaModel();

        try {
            $asistencia = $asistenciaModel->getByDateAndId($_POST['fecha_marcacion'], $_POST['usuario_id']);
            if ($asistencia === null) {
                return [];
            } else {
                return $asistencia;
            }
        } catch (Exception $e) {
            error_log("Error en AsistenciaController::getAsistenciaById: " . $e->getMessage());
            return [];
        }
    }

    public function createAsistencia()
    {
        $asistenciaModel = new AsistenciaModel();

        try {
            $success = $asistenciaModel->create($_POST['fecha_marcacion'], $_POST['hora_entrada'], $_POST['estado'], $_POST['latitud'], $_POST['longitud'], $_POST['usuario_id']);
            return array('status' => true, 'msg' => 'Asistencia creada');
        } catch (Exception $e) {
            error_log("Error en AsistenciaController::createAsistencia: " . $e->getMessage());
            return false;
        }
    }

    public function updateAsistencia()
    {
        $asistenciaModel = new AsistenciaModel();

        try {
            $success = $asistenciaModel->update($_POST['id'], $_POST['hora_salida']);
            return array('status' => true, 'msg' => 'Asistencia actualizada');
        } catch (Exception $e) {
            error_log("Error en AsistenciaController::updateAsistencia: " . $e->getMessage());
            return false;
        }
    }

    public function deleteAsistencia($id)
    {
        $asistenciaModel = new AsistenciaModel();

        try {
            $success = $asistenciaModel->delete($id);
            return array('status' => true, 'msg' => 'Asistencia eliminada');
        } catch (Exception $e) {
            error_log("Error en AsistenciaController::deleteAsistencia: " . $e->getMessage());
            return false;
        }
    }
}
