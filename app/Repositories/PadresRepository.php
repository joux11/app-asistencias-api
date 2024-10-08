<?php

namespace app\Repositories;

use app\Models\Padres;


class PadresRepository
{
    protected $model;
    public function __construct(Padres $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }
    public function getById($id)
    {
        return $this->model->find($id);
    }
    public function getNinosById($id)
    {
        $padre = $this->model->find($id);
        $ninos = $padre->ninos()->with('aula')->get()->map(function ($nino) {
            $ninoArray = $nino->toArray();
            unset($ninoArray['pivot']);
            return $ninoArray;
        });
        return $ninos;
    }

    public function getByEmail($email)
    {

        return $this->model->where('email', $email)->first();
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function update(array $data)
    {

        return $this->model->update($data);
    }
    public function delete(array $data)
    {
        return $this->model->delete($data);
    }
}
