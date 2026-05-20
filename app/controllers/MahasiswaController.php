<?php

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswaModel = $this->model('Mahasiswa');

        $data['mahasiswa'] = $mahasiswaModel->getAll();

        $this->view('mahasiswa/index', $data);
    }

    // tampil form create
    public function create()
    {
        $this->view('mahasiswa/create');
    }

    // simpan data
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'npm' => trim($_POST['npm']),
                'nama_lengkap' => trim($_POST['nama_lengkap']),
                'fakultas' => trim($_POST['fakultas']),
                'jurusan' => trim($_POST['jurusan']),
                'tempat_lahir' => trim($_POST['tempat_lahir']),
                'tanggal_lahir' => trim($_POST['tanggal_lahir']),
                'jenis_kelamin' => trim($_POST['jenis_kelamin'])
            ];

            $mahasiswaModel = $this->model('Mahasiswa');

            // VALIDASI
            if (empty($data['npm'])) {

                $this->setFlash('NPM wajib diisi', 'error');

                header('Location: ' . BASEURL . '/mahasiswa/create');
                exit;
            }

            if ($mahasiswaModel->findByNpm($data['npm'])) {

                $this->setFlash('NPM sudah digunakan', 'error');

                header('Location: ' . BASEURL . '/mahasiswa/create');
                exit;
            }

            if (empty($data['nama_lengkap'])) {

                $this->setFlash('Nama lengkap wajib diisi', 'error');

                header('Location: ' . BASEURL . '/mahasiswa/create');
                exit;
            }

            $jurusanValid = [
                'Teknik Informatika',
                'Sistem Informasi'
            ];

            if (!in_array($data['jurusan'], $jurusanValid)) {

                $this->setFlash('Jurusan tidak valid', 'error');

                header('Location: ' . BASEURL . '/mahasiswa/create');
                exit;
            }

            $jkValid = [
                'Laki-laki',
                'Perempuan'
            ];

            if (!in_array($data['jenis_kelamin'], $jkValid)) {

                $this->setFlash('Jenis kelamin tidak valid', 'error');

                header('Location: ' . BASEURL . '/mahasiswa/create');
                exit;
            }

            // simpan
            if ($mahasiswaModel->create($data)) {

                $this->setFlash(
                    'Data mahasiswa berhasil ditambahkan',
                    'success'
                );

                header('Location: ' . BASEURL . '/mahasiswa/index');

            } else {

                $this->setFlash(
                    'Data mahasiswa gagal ditambahkan',
                    'error'
                );

                header('Location: ' . BASEURL . '/mahasiswa/create');
            }

            exit;
        }
    }
}