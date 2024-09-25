<?php

namespace app\Services;

use Aws\Sns\SnsClient;
use Exception;

use function Symfony\Component\Clock\now;

class AWSService
{
    protected $snsClient;
    public function __construct()
    {

        $this->snsClient = new SnsClient([
            'region' => env('AWS_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    }


    public function sendSMS($telefono, $nombreNino)
    {
        $fechaHora = now()->format('d/m/Y H:i:s');
        $mensaje = "Se ha registrado la asistencia de {$nombreNino} el {$fechaHora}";
        $numberCellphone = $this->FormatNumber($telefono);
        try {
            $result = $this->snsClient->publish([
                'Message' => $mensaje,
                'PhoneNumber' => $numberCellphone,
            ]);
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function FormatNumber($number)
    {
        if (strpos($number, '0') !== 0) {
            $cellphoneNumberNoZero = substr($number, 1, strlen($number) - 1);
            return "+593{$cellphoneNumberNoZero}";
        } else {
            return "+593{$number}";
        }
    }
}
