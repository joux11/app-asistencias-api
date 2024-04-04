<?php

require_once 'controllers_import.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, Accept, X-Requested-With, x-xsrf-token');
header('Content-Type: application/json; charset=utf-8');

$_POST = json_decode(file_get_contents('php://input'), true);

$user = new UsuarioController();
$child = new ChildController();
$asistencia = new AsistenciaController();
$asistenciaN = new AsistenciaNController();


$recovery = new RecoveryDatabase();

if (isset($_POST['accion'])) {

    if ($_POST['accion'] == "login") {
        $response = $user->login();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "register") {
        $response = $user->register();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "getUser") {
        $response = $user->getAllById();
        echo json_encode($response);
    }


    /* child */

    if ($_POST['accion'] == "getAllChildren") {
        $response = $child->getAllChildren();
        echo json_encode($response);
    }

    if ($_POST['accion'] == "getChild") {
        $response = $child->getChildById();
        echo json_encode($response);
    }

    if ($_POST['accion'] == "registerNiño") {
        $response = $child->createChild();
        echo json_encode($response);
    }


    /*Registro Asistencia Nino */
    if ($_POST['accion'] == "getAllAsistenciasN") {

        $response = $asistenciaN->getAllAsistenciasN();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "getAsistenciaNByDateAndId") {

        $response = $asistenciaN->getAsistenciaNByDateAndId();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "getAsistenciaNByDate") {

        $response = $asistenciaN->getAsistenciaNByDate();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "createAsistenciaN") {

        $response = $asistenciaN->createAsistenciaN();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "updateAsistenciaN") {
        $response = $asistenciaN->updateAsistenciaN();
        echo json_encode($response);
    }

    /* Registro Asistencia */
    if ($_POST['accion'] == "getAsistenciaByDateAndId") {

        $response = $asistencia->getAsistenciaByDateAndId();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "getAsistenciaByUsuario") {

        $response = $asistencia->getAsistenciaByUsuario();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "createAsistencia") {

        $response = $asistencia->createAsistencia();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "updateAsistencia") {

        $response = $asistencia->updateAsistencia();
        echo json_encode($response);
    }

    /* backup base de datos */
    if ($_POST['accion'] == "backup") {
        $recovery->backupDatabase();
    }
} else {
    echo json_encode(array());
}
