<?php
require_once '../models/UsuarioModel.php';
class UsuarioController
{
    public function login()
    {
        if (empty($_POST['email'])) {
            return array('status' => false, 'msg' => 'El email es requerido');
        }
        if (empty($_POST['password'])) {
            return array('status' => false, 'msg' => 'La password es requerida');
        }

        try {
            $usuarioModel = new UsuarioModel();
            $hashedPassword = hash('sha256', $_POST['password']);
            $user = $usuarioModel->getUserByEmail($_POST['email']);
            if (empty($user)) {
                return array('status' => false, 'msg' => 'El usuario no existe');
            }
            if ($user['estado'] == "0") {
                return array('status' => false, 'msg' => 'El usuario no esta activo');
            }

            if ($user['rol_id'] == "1") {
                if ($hashedPassword == $user['password']) {
                    unset($user['password']);
                    return array('status' => true, 'msg' => 'Login correcto', 'data' => $user);
                }
                return array('status' => false, 'msg' => 'Usuario/Passworrd incorrecto');
            }

            if (!empty($usuarioModel->getUserNoAsignadoById($user['id']))) {
                return array('status' => false, 'msg' => 'El usuario no ha sido asignado a ninguna aula');
            }
            $userExist = $usuarioModel->getById($user['id']);
            if ($userExist && $hashedPassword == $userExist['password']) {
                unset($userExist['password']);
                return array('status' => true, 'msg' => 'Login correcto', 'data' => $userExist);
            }

            return array('status' => false, 'msg' => 'Usuario/Passworrd incorrecto');
        } catch (Exception $e) {
            return array('status' => false, 'msg' => 'Error de sistema: ' . $e->getMessage());
        }
    }

    public function register()
    {
        $usuarioModel = new UsuarioModel();

        try {
            $user = $usuarioModel->getUserbyCedula($_POST['identificacion']);
            if ($user) {
                return array('status' => false, 'msg' => 'La cedula ya se encuentra registrada');
            }
            $user = $usuarioModel->getUserByEmail($_POST['email']);
            if ($user) {
                return array('status' => false, 'msg' => 'El correo electronico ya se encuentra registrado');
            }

            $hashedPassword = hash('sha256', $_POST['password']);
            $user = $usuarioModel->create($_POST['identificacion'], $_POST['nombre'], $_POST['segundo_nombre'], $_POST['apellido'], $_POST['segundo_apellido'], $_POST['telefono'], $_POST['email'], $hashedPassword);
            return array('status' => true, 'msg' => 'Usuario creado');
        } catch (Exception $e) {
            return array('status' => false, 'msg' => 'Error: ' . $e->getMessage());
        }
    }
    public function getAllById()
    {
        $usuarioModel = new UsuarioModel();
        $user = $usuarioModel->getUserById($_POST['idUsuario']);
        if ($user) {
            unset($user['password']);
            return array('status' => true, 'data' => $user);
        }
        return array('status' => false, 'msg' => "No hay usuario");
    }

    public function getUsersNoAsignado()
    {
        $usuarioModel = new UsuarioModel();

        try {
            $usuario = $usuarioModel->getUsersNoAsignado();
            if ($usuario === null) {
                return [];
            } else {
                return $usuario;
            }
        } catch (Exception $e) {
            error_log("Error en AsistenciaController::getAllAsistencias: " . $e->getMessage());
            return [];
        }
    }
    public function getAllUsers()
    {
        $usuarioModel = new UsuarioModel();
        $users = $usuarioModel->getAll();
        $newUsers = [];
        if (!empty($users)) {
            foreach ($users as $key) {
                unset($key['password']);
                array_push($newUsers, $key);
            }
            return  $newUsers;
        }
        return [];
    }
    public function updateEstado()
    {
        $usuarioModel = new UsuarioModel();
        $user = $usuarioModel->updateEstado($_POST['estado'], $_POST['id']);
        return array('status' => true, 'msg' => 'Estado Actualizado');
    }
}
