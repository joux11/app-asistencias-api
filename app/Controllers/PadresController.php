<?php

use app\Models\Padres;
use app\Repositories\PadresRepository;
use Rakit\Validation\Validator;


class PadresController
{
    protected $padresRepository;

    public function __construct()
    {
        $this->padresRepository = new PadresRepository(new Padres());
    }

    public function getAll()
    {
        $padres = $this->padresRepository->getAll();
        return ['status' => true, "data" => $padres];
    }
    public function getById()
    {
        $padre = $this->padresRepository->getById($_POST['id']);
        if ($padre == null) return ['status' => false, "msg" => "Padre no encontrado"];
        $padre->niños = $this->padresRepository->getNinosById($_POST['id']);
        return ['status' => true, "data" => $padre];
    }
    public function getNinosById()
    {
        $ninos = $this->padresRepository->getNinosById($_POST['id']);
        return ['status' => true, "data" => $ninos];
    }

    public function create()
    {
        $validator = new Validator([
            'required' => ':attribute un campo obligatorio.',
            'email' => ':attribute debe ser una dirección de correo válida.',
            'min' => ':attribute debe tener al menos :min digitos.',
            'numeric' => ':attribute debe ser un valor numerico',
        ]);
        $validation = $validator->validate($_POST, [
            'identificacion' => 'required|min:10|numeric',
            'primer_nombre' => 'required',
            'primer_apellido' => 'required',
            'numero_celular' => 'required|min:10',
            'email' => 'required|email',
        ]);
        if ($validation->fails()) return ['status' => false, "msg" => "Errores de Validacion", "errors" => $validation->errors()->toArray()];

        $this->padresRepository->create([
            'identificacion' => $_POST['identificacion'],
            'primer_nombre' => $_POST['primer_nombre'],
            'segundo_nombre' => $_POST['segundo_nombre'],
            'primer_apellido' => $_POST['primer_apellido'],
            'segundo_apellido' => $_POST['segundo_apellido'],
            'numero_celular' => $_POST['numero_celular'],
            'email' => $_POST['email'],
            'foto' => $_POST['foto'],
        ]);

        return array('status' => true, "msg" => "Padre creado correctamente");
    }

    public function update()
    {
        $padre = $this->padresRepository->getById($_POST['id']);
        if ($padre == null) return ['status' => false, "msg" => "Padre no encontrado"];

        $padre->update([
            'identificacion' => $_POST['identificacion'],
            'primer_nombre' => $_POST['primer_nombre'],
            'segundo_nombre' => $_POST['segundo_nombre'],
            'primer_apellido' => $_POST['primer_apellido'],
            'segundo_apellido' => $_POST['segundo_apellido'],
            'numero_celular' => $_POST['numero_celular'],
            'email' => $_POST['email'],
            'foto' => $_POST['foto'],
        ]);
        return array('status' => true, "msg" => "Padre actualizado correctamente");
    }

    public function delete()
    {
        $padre = $this->padresRepository->getById($_POST['id']);
        if ($padre == null) return ['status' => false, "msg" => "Padre no encontrado"];
        $padre->delete();
        return array('status' => true, "msg" => "Padre eliminado correctamente");
    }
}
