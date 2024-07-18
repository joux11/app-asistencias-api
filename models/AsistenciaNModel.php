<?php
require_once '../config/database.php';

class AsistenciaNModel extends Database
{
    public function getAll()
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->query("SELECT * FROM asistencia_niños");
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
            $stmt = $pdo->prepare("SELECT * FROM asistencia_niños WHERE id = :id");
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
            $stmt = $pdo->prepare("SELECT * FROM asistencia_niños WHERE fecha_marcacion = :date AND niño_id = :id");
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
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
    public function getByDate($date)
    {

        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM asistencia_niños WHERE fecha_marcacion = :date");
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);

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

    public function create($fechaMarcacion, $horaEntrada, $estado, $observacion_entrada, $niñoId)
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("INSERT INTO asistencia_niños(fecha_marcacion, hora_entrada,  estado, observacion_entrada, niño_id) VALUES (:fechaMarcacion, :horaEntrada, :estado, :observacion_entrada, :nId)");

            $stmt->bindParam(':fechaMarcacion', $fechaMarcacion, PDO::PARAM_STR);
            $stmt->bindParam(':horaEntrada', $horaEntrada, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':observacion_entrada', $observacion_entrada, PDO::PARAM_STR);
            $stmt->bindParam(':nId', $niñoId, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al ejecutar la consultas: ' . $e->getMessage());
        }

        $stmt->closeCursor();
        $pdo = null;

        return $stmt->rowCount() > 0;
    }

    public function update($id, $horaSalida,  $observacion_salida)
    {
        try {
            $pdo = self::connect();

            $stmt = $pdo->prepare("UPDATE asistencia_niños SET  hora_salida = :horaSalida, observacion_salida = :observacion_salida WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->bindParam(':horaSalida', $horaSalida, PDO::PARAM_STR);

            $stmt->bindParam(':observacion_salida', $observacion_salida, PDO::PARAM_STR);

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

            $stmt = $pdo->prepare("DELETE FROM asistencia_niños WHERE id = :id");

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
