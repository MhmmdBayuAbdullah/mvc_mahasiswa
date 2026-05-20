<?php

class Mahasiswa
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM mahasiswa ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // cek npm
    public function findByNpm($npm)
    {
        $query = "SELECT * FROM mahasiswa WHERE npm = :npm";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':npm', $npm);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // create data
    public function create($data)
    {
        $query = "
            INSERT INTO mahasiswa
            (
                status_id,
                npm,
                nama_lengkap,
                fakultas,
                jurusan,
                tempat_lahir,
                tanggal_lahir,
                jenis_kelamin
            )
            VALUES
            (
                :status_id,
                :npm,
                :nama_lengkap,
                :fakultas,
                :jurusan,
                :tempat_lahir,
                :tanggal_lahir,
                :jenis_kelamin
            )
        ";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':status_id' => 1,
            ':npm' => $data['npm'],
            ':nama_lengkap' => $data['nama_lengkap'],
            ':fakultas' => $data['fakultas'],
            ':jurusan' => $data['jurusan'],
            ':tempat_lahir' => $data['tempat_lahir'],
            ':tanggal_lahir' => $data['tanggal_lahir'],
            ':jenis_kelamin' => $data['jenis_kelamin']
        ]);
    }
}