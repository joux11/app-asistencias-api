<?php

require_once '../config/database.php';

class ChildModel extends Database
{
    public function getAll()
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->query("SELECT * FROM niños order by primer_apellido asc");
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $pdo = null;
            return $res;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return null;
        }
    }
    public function getAllByAula($aulaId)
    {
        try {


            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM niños WHERE aula_id = :aulaid ORDER BY primer_apellido ASC");
            $stmt->bindParam(':aulaid', $aulaId, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $pdo = null;

            return $res;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return null;
        }
    }

    public function getById($id)
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM niños WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $pdo = null;
            return $res;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return null;
        }
    }
    public function getByCedula($id)
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM niños WHERE identificacion = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $pdo = null;
            return $res;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return null;
        }
    }
    public function create($identificacion, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $genero, $aula_id)
    {
        try {
            $pdo = self::connect();

            $stmt = $pdo->prepare("INSERT INTO niños (identificacion, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, genero, aula_id) VALUES (:identificacion, :primerNombre, :segundoNombre, :primerApellido, :segundoApellido, :fechaNacimiento, :genero, :aula_id)");

            $stmt->bindParam(':identificacion', $identificacion, PDO::PARAM_STR);
            $stmt->bindParam(':primerNombre', $primerNombre, PDO::PARAM_STR);
            $stmt->bindParam(':segundoNombre', $segundoNombre, PDO::PARAM_STR);
            $stmt->bindParam(':primerApellido', $primerApellido, PDO::PARAM_STR);
            $stmt->bindParam(':segundoApellido', $segundoApellido, PDO::PARAM_STR);
            $stmt->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
            $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
            $stmt->bindParam(':aula_id', $aula_id, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al ejecutar la consulta: ' . $e->getMessage());
        }

        $stmt->closeCursor();
        $pdo = null;

        return $stmt->rowCount() > 0;
    }
    public function update($id, $identificacion, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $genero)
    {
        try {
            $pdo = self::connect();

            $stmt = $pdo->prepare("UPDATE niños SET identificacion = :identificacion, primer_nombre = :primerNombre, segundo_nombre = :segundoNombre, primer_apellido = :primerApellido, segundo_apellido = :segundoApellido, fecha_nacimiento = :fechaNacimiento, genero = :genero WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':primerNombre', $primerNombre, PDO::PARAM_STR);
            $stmt->bindParam(':segundoNombre', $segundoNombre, PDO::PARAM_STR);
            $stmt->bindParam(':primerApellido', $primerApellido, PDO::PARAM_STR);
            $stmt->bindParam(':segundoApellido', $segundoApellido, PDO::PARAM_STR);
            $stmt->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
            $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
            $stmt->bindParam(':identificacion', $identificacion, PDO::PARAM_STR);

            $res = $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al ejecutar la consulta: ' . $e->getMessage());
        }

        $stmt->closeCursor();
        $pdo = null;

        return $res;
    }
    public function delete($id)
    {
        try {
            $pdo = self::connect();

            $stmt = $pdo->prepare("DELETE FROM niños WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $res = $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al ejecutar la consulta: ' . $e->getMessage());
        }

        $stmt->closeCursor();
        $pdo = null;

        return $res;
    }
}
