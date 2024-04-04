<?php

require_once '../config/database.php';

class UsuarioModel extends Database
{
    public function getUserById($id)
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
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


    public function getUserByEmail($email)
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email LIKE :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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

    public function create($identificacion, $nombre, $segundo_nombre, $apellido, $segundo_apellido, $telefono, $email, $hashedPassword)
    {
        try {
            $pdo = self::connect();

            $stmt = $pdo->prepare("INSERT INTO usuarios (identificacion, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, numero_celular, email, password, rol_id) VALUES (:identificacion, :nombre, :segundo_nombre, :apellido, :segundo_apellido, :telefono, :email, :password, 2)");



            $stmt->bindParam(':identificacion', $identificacion, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':segundo_nombre', $segundo_nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $stmt->bindParam(':segundo_apellido', $segundo_apellido, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al ejecutar la consulta: ' . $e->getMessage());
        }

        $stmt->closeCursor();
        $pdo = null;

        return $stmt->rowCount() > 0;
    }
    public function update($id, $identificacion, $nombre, $segundo_nombre, $apellido, $segundo_apellido, $telefono, $email)
    {
        try {
            $pdo = self::connect();

            $stmt = $pdo->prepare("UPDATE usuarios SET identificacion = :identificacion, primer_nombre = :nombre, segundo_nombre = :segundo_nombre, primer_apellido = :apellido, segundo_apellido = :segundo_apellido, numero_celular = :telefono, email = :email WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':segundo_nombre', $segundo_nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $stmt->bindParam(':segundo_apellido', $segundo_apellido, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':identificacion', $identificacion, PDO::PARAM_INT);


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

            $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");

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
