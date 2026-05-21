<?php

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    // cari user berdasarkan username
    public function findByUsername($username)
    {
        $query =
            "SELECT * FROM users
             WHERE username = :username";

        $stmt =
            $this->conn->prepare($query);

        $stmt->bindParam(
            ':username',
            $username
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}