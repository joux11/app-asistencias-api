<?php

require_once '../config/database.php';

class AulasModel extends Database
{
    public function getAll()
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->query("SELECT * FROM aulas");
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $pdo = null;
            return $res;
        } catch (PDOException $e) {
            error_log("Error de base de datos: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return null;
        }
    }
    public function create($nombre, $descripcion)
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("INSERT INTO aulas (nombre, descripcion) VALUES (:nombre, :descripcion)");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $lastInsertedId = $pdo->lastInsertId();
            $pdo = null;
            return $lastInsertedId;
        } catch (PDOException $e) {
            error_log("Error de base de datos: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return null;
        }
    }
    public function getById($aulaId)
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM aulas WHERE id = :aulaId");
            $stmt->bindParam(':aulaId', $aulaId, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $pdo = null;
            return $res;
        } catch (PDOException $e) {
            error_log("Error de base de datos: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return null;
        }
    }
    public function delete($aulaId)
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("DELETE FROM aulas WHERE id = :aulaId");
            $stmt->bindParam(':aulaId', $aulaId, PDO::PARAM_INT);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            $pdo = null;
            return $rowCount;
        } catch (PDOException $e) {
            error_log("Error de base de datos: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return null;
        }
    }
    public function getAllAulasNoAsignadas()
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->query("SELECT id, nombre, descripcion
FROM aulas
WHERE id NOT IN (SELECT DISTINCT aula_id FROM aula_usuario);
");
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $pdo = null;
            return $res;
        } catch (PDOException $e) {
            error_log("Error de base de datos: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return null;
        }
    }
}
