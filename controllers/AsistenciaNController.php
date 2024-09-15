<?php

require_once '../models/AsistenciaNModel.php';

class AsistenciaNController
{
    public function getAllAsistenciasN()
    {
        $asistenciaNModel = new AsistenciaNModel();

        try {
            $asistenciasNiños = $asistenciaNModel->getAll();
            if ($asistenciasNiños === null) {
                return [];
            } else {
                return $asistenciasNiños;
            }
        } catch (Exception $e) {
            error_log("Error en AsistenciaNiñosController::getAllAsistenciasNiños: " . $e->getMessage());
            return [];
        }
    }


    public function getAsistenciaNById($id)
    {
        $asistenciaNModel = new AsistenciaNModel();

        try {
            $asistenciaNiño = $asistenciaNModel->getById($id);
            if ($asistenciaNiño === null) {
                return [];
            } else {
                return $asistenciaNiño;
            }
        } catch (Exception $e) {
            error_log("Error en AsistenciaNiñosController::getAsistenciaNiñoById: " . $e->getMessage());
            return [];
        }
    }

    public function getAsistenciaNByDateAndId()
    {
        $asistenciaNModel = new AsistenciaNModel();

        try {
            $asistenciaNiño = $asistenciaNModel->getByDateAndId($_POST['fecha_marcacion'], $_POST['id']);

            if ($asistenciaNiño === null) {
                return [];
            } else {
                return $asistenciaNiño;
            }
        } catch (Exception $e) {
            error_log("Error en AsistenciaNiñosController::getAsistenciaNiñoById: " . $e->getMessage());
            return [];
        }
    }
    public function getAsistenciaNByDate()
    {
        $asistenciaNModel = new AsistenciaNModel();

        try {
            $asistenciaNiño = $asistenciaNModel->getByDate($_POST['fecha_marcacion']);

            if ($asistenciaNiño === null) {
                return [];
            } else {
                return $asistenciaNiño;
            }
        } catch (Exception $e) {
            error_log("Error en AsistenciaNiñosController::getAsistenciaNiñoById: " . $e->getMessage());
            return [];
        }
    }

    public function createAsistenciaN()
    {
        $asistenciaNModel = new AsistenciaNModel();

        try {
            $success = $asistenciaNModel->create($_POST['fecha_marcacion'], $_POST['hora_entrada'], $_POST['estado'], $_POST['observacion_entrada'], $_POST['niño_id']);
            return array('status' => true, 'msg' => 'Asistencia registrada');
        } catch (Exception $e) {
            error_log("Error en AsistenciaNiñosController::createAsistenciaNiño: " . $e->getMessage());
            return array('status' => false, 'msg' => $e->getMessage());
        }
    }

    public function updateAsistenciaN()
    {
        $asistenciaNModel = new AsistenciaNModel();

        try {
            $success = $asistenciaNModel->update($_POST['id'], $_POST['hora_salida'], $_POST['observacion_salida']);
            return array('status' => true, 'msg' => 'Asistencia registrada');
        } catch (Exception $e) {
            error_log("Error en AsistenciaNiñosController::updateAsistenciaNiño: " . $e->getMessage());
            return array('status' => false, 'msg' => $e->getMessage());
        }
    }

    public function deleteAsistenciaN($id)
    {
        $asistenciaNModel = new AsistenciaNModel();

        try {
            $success = $asistenciaNModel->delete($id);
            return $success;
        } catch (Exception $e) {
            error_log("Error en AsistenciaNiñosController::deleteAsistenciaNiño: " . $e->getMessage());
            return false;
        }
    }
}
