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
$aulas = new AulaController();
$asignacion = new AsignacionAulasController();

$padres = new PadresController();
$ninos = new NinosController();
$padres_ninos = new PadresNinosController();
$asistencia_ninos = new AsistenciaNinosController();



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
    if ($_POST['accion'] == "getUsersNoAsignado") {
        $response = $user->getUsersNoAsignado();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "getAllUsers") {
        $response = $user->getAllUsers();
        echo json_encode($response);
    }

    if ($_POST['accion'] == "updateEstado") {
        $response = $user->updateEstado();
        echo json_encode($response);
    }


    /* child */

    if ($_POST['accion'] == "getAllChildren") {
        $response = $child->getAllChildren();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "getAllChildrenByAula") {
        $response = $child->getAllChildrenByAula();
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

    if ($_POST['accion'] == "getChildrenUnAssigned") {
        $response = $ninos->getAllInasignados();
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
    // if ($_POST['accion'] == "createAsistenciaN") {

    //     $response = $asistenciaN->createAsistenciaN();
    //     echo json_encode($response);
    // }
    if ($_POST['accion'] == "createAsistenciaN") {

        $response = $asistencia_ninos->create();
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

    /*Aulas */
    if ($_POST['accion'] == "getAllAulas") {
        $response = $aulas->getAllAulas();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "getAulasById") {
        $response = $aulas->getAulaById();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "getAulasNoAsignadas") {
        $response = $aulas->getAulasNoAsignadas();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "createAula") {

        $response = $aulas->createAula();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "deleteAula") {

        $response = $aulas->deleteAula();
        echo json_encode($response);
    }

    /* ASIGNACION A AULAS */
    if ($_POST['accion'] == "getAllAsignaciones") {
        $response = $asignacion->getAllAsignaciones();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "createAsignacion") {

        $response = $asignacion->createAsignacion();
        echo json_encode($response);
    }

    /* PADRES */
    if ($_POST['accion'] == "getAllPadres") {
        $response = $padres->getAll();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "getNinosPadreById") {
        $response = $padres->getNinosById();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "getPadre") {

        $response = $padres->getById();
        echo json_encode($response);
    }

    if ($_POST['accion'] == "createPadre") {

        $response = $padres->create();
        echo json_encode($response);
    }
    if ($_POST['accion'] == "updatePadre") {

        $response = $padres->update();
        echo json_encode($response);
    }

    if ($_POST['accion'] == "deletePadre") {

        $response = $padres->delete();
        echo json_encode($response);
    }

    if ($_POST['accion'] == "asignarNino") {
        $response = $padres_ninos->create();
        echo json_encode($response);
    }



    /* backup base de datos */
    if ($_POST['accion'] == "backup") {
        $recovery->backupDatabase();
    }
} else {
    echo json_encode(array());
}
