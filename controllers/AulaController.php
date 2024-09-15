<?php
require_once '../models/AulasModel.php';
class AulaController
{
    public function getAllAulas()
    {
        $aulas = new AulasModel();
        try {
            $aulas = $aulas->getAll();
            if ($aulas === null) {
                return [];
            } else {
                return $aulas;
            }
        } catch (Exception $e) {
            error_log("Error en ChildController::getAllChildren: " . $e->getMessage());
            return [];
        }
    }
    public function getAulasNoAsignadas()
    {
        $aulas = new AulasModel();
        try {
            $aulas = $aulas->getAllAulasNoAsignadas();
            if ($aulas === null) {
                return [];
            } else {
                return $aulas;
            }
        } catch (Exception $e) {
            error_log("Error en ChildController::getAllChildren: " . $e->getMessage());
            return [];
        }
    }
    public function getAulaById()
    {
        $aulas = new AulasModel();
        try {
            $aula = $aulas->getById($_POST['id']);
            if ($aula === null) {
                return [];
            } else {
                return $aula;
            }
        } catch (Exception $e) {
            error_log("Error en ChildController::getAllChildren: " . $e->getMessage());
            return [];
        }
    }
    public function createAula()
    {
        $aulas = new AulasModel();

        try {
            $aula = $aulas->create($_POST['nombre'], $_POST['descripcion']);

            return array('status' => true, 'msg' => 'Aula creada');
        } catch (Exception $e) {
            error_log("Error en ChildController::createChild: " . $e->getMessage());
            return array('status' => false, 'msg' => $e->getMessage());
        }
    }
    public function deleteAula()
    {
        $aulas = new AulasModel();

        try {
            $success = $aulas->delete($_POST['id']);
            return $success;
        } catch (Exception $e) {
            error_log("Error en ChildController::deleteChild: " . $e->getMessage());
            return false;
        }
    }
}
