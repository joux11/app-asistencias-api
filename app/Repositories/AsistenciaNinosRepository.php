<?php

namespace app\Repositories;

use app\Models\AsistenciaNinos;

class AsistenciaNinosRepository
{

    protected $model;

    public function __construct(AsistenciaNinos $model)
    {
        $this->model = $model;
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data)
    {
        return $this->model->update($data);
    }
}
