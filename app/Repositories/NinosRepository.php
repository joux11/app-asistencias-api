<?php

namespace app\Repositories;

use app\Models\Ninos;

class NinosRepository
{
    protected $model;
    public function __construct(Ninos $model)
    {
        $this->model = $model;
    }
    public function getById($id)
    {
        return $this->model->with('padres')->find($id);
    }
    public function getAllInasignados()
    {
        return $this->model->doesntHave('padres')->get();
    }
}
