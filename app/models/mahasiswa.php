<?php

class Mahasiswa
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    // ambil semua data
    public function getAll()
    {
        $query = "SELECT * FROM mahasiswa ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // cari berdasarkan id
    public function find($id)
    {
        $query = "SELECT * FROM mahasiswa WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // cari berdasarkan npm
    public function findByNpm($npm)
    {
        $query = "SELECT * FROM mahasiswa WHERE npm = :npm";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':npm', $npm);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // tambah data
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

    // update data
    public function update($id, $data)
    {
        $query = "
            UPDATE mahasiswa
            SET
                npm = :npm,
                nama_lengkap = :nama_lengkap,
                fakultas = :fakultas,
                jurusan = :jurusan,
                tempat_lahir = :tempat_lahir,
                tanggal_lahir = :tanggal_lahir,
                jenis_kelamin = :jenis_kelamin
            WHERE id = :id
        ";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':id' => $id,
            ':npm' => $data['npm'],
            ':nama_lengkap' => $data['nama_lengkap'],
            ':fakultas' => $data['fakultas'],
            ':jurusan' => $data['jurusan'],
            ':tempat_lahir' => $data['tempat_lahir'],
            ':tanggal_lahir' => $data['tanggal_lahir'],
            ':jenis_kelamin' => $data['jenis_kelamin']
        ]);
    }

    // hapus data
    public function delete($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    // search dan filter
    public function searchAndFilter($search = '', $jurusan = '')
    {
        $query = "SELECT * FROM mahasiswa";

        $conditions = [];

        $params = [];

        // search npm atau nama
        if (!empty($search)) {

            $conditions[] =
                "(npm LIKE :search OR nama_lengkap LIKE :search)";

            $params[':search'] = "%$search%";
        }

        // filter jurusan
        if (!empty($jurusan)) {

            $conditions[] = "jurusan = :jurusan";

            $params[':jurusan'] = $jurusan;
        }

        // gabungkan kondisi
        if (count($conditions) > 0) {

            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}