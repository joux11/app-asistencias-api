<?php
require_once '../config/database.php';

class AsistenciaModel extends Database
{
    public function getAll()
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->query("SELECT * FROM asistencias");
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
            $stmt = $pdo->prepare("SELECT * FROM asistencias WHERE id = :id");
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

    public function getByDateAndId($date, $id)
    {

        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM asistencias WHERE fecha_marcacion = :date AND usuario_id = :id");
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
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
    public function getByUserId($id)
    {

        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM asistencias WHERE usuario_id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
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

    public function create($fechaMarcacion, $horaEntrada, $estado, $latitud, $longitud, $usuarioId)
    {
        try {
            $pdo = self::connect();

            $stmt = $pdo->prepare("INSERT INTO asistencias (fecha_marcacion, hora_entrada,  estado, latitud, longitud, usuario_id) VALUES (:fechaMarcacion, :horaEntrada, :estado, :latitud, :longitud, :usuarioId)");

            $stmt->bindParam(':fechaMarcacion', $fechaMarcacion, PDO::PARAM_STR);
            $stmt->bindParam(':horaEntrada', $horaEntrada, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':latitud', $latitud, PDO::PARAM_STR);
            $stmt->bindParam(':longitud', $longitud, PDO::PARAM_STR);
            $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al ejecutar la consulta: ' . $e->getMessage());
        }

        $stmt->closeCursor();
        $pdo = null;

        return $stmt->rowCount() > 0;
    }

    public function update($id, $horaSalida)
    {
        try {
            $pdo = self::connect();

            $stmt = $pdo->prepare("UPDATE asistencias SET  hora_salida = :horaSalida WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->bindParam(':horaSalida', $horaSalida, PDO::PARAM_STR);


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

            $stmt = $pdo->prepare("DELETE FROM asistencias WHERE id = :id");

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
