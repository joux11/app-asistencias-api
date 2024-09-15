<?php
require '../vendor/autoload.php';

use Google\Client;
use Google\Service\Drive;

// Iniciar sesión si no está iniciada
session_start();

// Configuración del cliente de Google Drive API
$client = new Client();
$client->setAuthConfig('../config/cred7.json'); // Ruta al archivo JSON de credenciales
$client->setAccessType('offline');
$client->setRedirectUri('http://localhost/ws_asistencia/config/googleDrive.php'); // Cambia a 'none' si ya has autorizado antes

if (isset($_GET['code'])) {
    // Si hay un código en la URL, intenta obtener el token de acceso
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
}

// Verifica si el token de acceso está presente y es válido
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);

    // Verifica si el token de acceso ha expirado
    if ($client->isAccessTokenExpired()) {
        // Si el token ha expirado, refresca el token
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        $_SESSION['access_token'] = $client->getAccessToken();
    }

    // Subir el archivo a Google Drive
    try {
        $driveService = new Drive($client);

        $pathSql = $_SESSION['SqlPath'];

        $fileName = basename($pathSql);

        $fileMetadata = new  Google\Service\Drive\DriveFile([
            'name' => $fileName
        ]);
        $content = file_get_contents($pathSql);


        // Subir el archivo a Google Drive
        $file = $driveService->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => 'application/sql', // Tipo MIME del archivo SQL
            'uploadType' => 'multipart'
        ]);

        // Devolver la respuesta como JSON
        $response = [
            'success' => true,
            'fileId' => $file->id,
            'fileName' => $file->name,
            'webViewLink' => $file->webViewLink
        ];

        // Enviar respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    } catch (Exception $e) {
        // Manejo de errores
        $response = [
            'success' => false,
            'error' => $e->getMessage()
        ];

        // Enviar respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // Si no hay token de acceso, solicita autorización del usuario
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit;
}
