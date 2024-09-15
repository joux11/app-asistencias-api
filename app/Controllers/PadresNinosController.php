<?php

use app\Models\PadresNinos;
use app\Repositories\PadresNinosRepository;

class PadresNinosController
{
    protected $padresNinosRepository;

    public function __construct()
    {
        $this->padresNinosRepository = new PadresNinosRepository(new PadresNinos());
    }

    public function create()
    {
        $this->padresNinosRepository->create([
            'padre_id' => $_POST['padre_id'],
            'niño_id' => $_POST['niño_id'],
        ]);
        return array('status' => true, 'msg' => 'Niño asignado correctamente');
    }

    public function delete()
    {
        $this->padresNinosRepository->delete([
            'padre_id' => $_POST['padre_id'],
            'niño_id' => $_POST['niño_id'],
        ]);
        return array('status' => true, 'msg' => 'Niño eliminado correctamente');
    }
}
