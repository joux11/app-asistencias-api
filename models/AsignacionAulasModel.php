<?php
require_once '../config/database.php';

class AsignacionAulasModel extends Database
{
    public function getAll()
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->query("SELECT CONCAT(u.primer_nombre, ' ', u.primer_apellido) AS nombre_usuario, u.id as usuario_id , a.nombre AS nombre_aula, au.aula_id 
FROM usuarios u
JOIN aula_usuario au ON u.id = au.usuario_id
JOIN aulas a ON au.aula_id = a.id;");
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

    public function create($aulaId, $usuarioId)
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("INSERT INTO aula_usuario (aula_id, usuario_id) VALUES (:aulaId, :usuarioId)");

            $stmt->bindParam(':aulaId', $aulaId, PDO::PARAM_INT);
            $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al ejecutar la consulta: ' . $e->getMessage());
        }

        $rowCount = $stmt->rowCount();
        $stmt->closeCursor();
        $pdo = null;

        return $rowCount > 0;
    }
}
