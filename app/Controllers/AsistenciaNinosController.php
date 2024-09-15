<?php

use app\Models\AsistenciaNinos;
use app\Models\Ninos;
use app\Repositories\AsistenciaNinosRepository;
use app\Repositories\NinosRepository;
use app\Services\AWSService;

class AsistenciaNinosController
{
    protected $ninoRepository;
    protected $asistenciaNinosRepository;
    protected $awsService;
    public function __construct()
    {
        $this->asistenciaNinosRepository = new AsistenciaNinosRepository(new AsistenciaNinos());
        $this->awsService = new AWSService();
        $this->ninoRepository = new NinosRepository(new Ninos());
    }

    public function create()
    {
        try {

            $nino = $this->ninoRepository->getById($_POST['niño_id']);
            if (!$nino) {
                return array('status' => false, 'msg' => 'El niño no existe');
            }
            $padres = $nino->padres();
            if ($padres == []) {
                return ['status' => false, "msg" => 'Niño no asignado a un Padre/Representante'];
            }
            $nombreNino = $nino->primer_nombre . ' ' . $nino->segundo_nombre . ' ' . $nino->primer_apellido . ' ' . $nino->segundo_apellido;
            $telefonoPadre = $nino->padres()->first()->celular;
            $res = $this->awsService->sendSMS($telefonoPadre, $nombreNino);

            $this->asistenciaNinosRepository->create([
                'fecha_marcacion' => $_POST['fecha_marcacion'],
                'hora_entrada' => $_POST['hora_entrada'],
                'estado' => $_POST['estado'],
                'observacion_entrada' => $_POST['observacion_entrada'],
                'niño_id' => $_POST['niño_id'],
            ]);

            //return array('status' => true, 'msg' => "Asistencia registrada correctamente y {$res}");
            return $padres;
        } catch (Exception $e) {
            return array('status' => false, 'msg' => $e->getMessage());
        }
    }
}
