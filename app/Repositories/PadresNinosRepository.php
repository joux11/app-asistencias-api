<?php

namespace app\Repositories;

use app\Models\PadresNinos;


class PadresNinosRepository
{
    protected $model;
    public function __construct(PadresNinos $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function delete(array $data)
    {
        return $this->model->delete($data);
    }
}
