<?php
require_once '../models/ChildModel.php';
class ChildController
{
    public function getAllChildren()
    {
        $childModel = new ChildModel();

        try {
            $children = $childModel->getAll();
            if ($children === null) {
                return [];
            } else {
                return $children;
            }
        } catch (Exception $e) {
            error_log("Error en ChildController::getAllChildren: " . $e->getMessage());
            return [];
        }
    }
    public function getAllChildrenByAula()
    {
        $childModel = new ChildModel();

        try {
            if (!isset($_POST['aula_id'])) {
                $children = $childModel->getAll();
                return $children;
            }
            $children = $childModel->getAllByAula($_POST['aula_id']);
            if (empty($children)) {
                return [];
            } else {
                return $children;
            }
        } catch (Exception $e) {
            error_log("Error en ChildController::getAllChildren: " . $e->getMessage());
            return [];
        }
    }
    public function getChildById()
    {
        $childModel = new ChildModel();

        try {
            $child = $childModel->getById($_POST['id']);
            if ($child === null) {
                return [];
            } else {
                return $child;
            }
        } catch (Exception $e) {
            error_log("Error en ChildController::getChildById: " . $e->getMessage());
            return [];
        }
    }
    public function createChild()
    {
        $childModel = new ChildModel();

        try {
            $child = $childModel->getByCedula($_POST['identificacion']);

            if (!empty($child)) {
                return array('status' => false, 'msg' => 'Ya existe un registro con la cédula ' . $_POST['identificacion']);
            }
            $childModel->create($_POST['identificacion'], $_POST['primer_nombre'], $_POST['segundo_nombre'], $_POST['primer_apellido'], $_POST['segundo_apellido'], $_POST['fecha_nacimiento'], $_POST['genero'], $_POST['aula_id']);
            return array('status' => true, 'msg' => 'Registro creado');
        } catch (Exception $e) {
            error_log("Error en ChildController::createChild: " . $e->getMessage());
            return array('status' => false, 'msg' => $e->getMessage());
        }
    }
    public function updateChild($id, $identificacion, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $fecha_nacimiento, $genero)
    {
        $childModel = new ChildModel();

        try {
            $success = $childModel->update($id, $identificacion, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $fecha_nacimiento, $genero);
            return $success;
        } catch (Exception $e) {
            error_log("Error en ChildController::updateChild: " . $e->getMessage());
            return false;
        }
    }
    public function deleteChild($id)
    {
        $childModel = new ChildModel();

        try {
            $success = $childModel->delete($id);
            return $success;
        } catch (Exception $e) {
            error_log("Error en ChildController::deleteChild: " . $e->getMessage());
            return false;
        }
    }
}
