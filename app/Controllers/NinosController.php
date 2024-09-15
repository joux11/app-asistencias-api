<?php

use app\Models\Ninos;
use app\Repositories\NinosRepository;

class NinosController
{

    protected $ninosRepository;
    public function __construct()
    {
        $this->ninosRepository = new NinosRepository(new Ninos());
    }
    public function getAllInasignados()
    {
        $ninosInasignados = $this->ninosRepository->getAllInasignados();
        return ['status' => true, "data" => $ninosInasignados];
    }
}
