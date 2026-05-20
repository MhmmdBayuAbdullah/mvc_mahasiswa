<?php

class MahasiswaController extends Controller
{
    // tampil data mahasiswa
    public function index()
    {
        $mahasiswaModel = $this->model('Mahasiswa');

        // ambil input search
        $search = isset($_POST['search'])
            ? trim($_POST['search'])
            : '';

        // ambil input jurusan
        $jurusan = isset($_POST['jurusan'])
            ? trim($_POST['jurusan'])
            : '';

        // cek search/filter
        if ($search != '' || $jurusan != '') {

            $data['mahasiswa'] =
                $mahasiswaModel->searchAndFilter(
                    $search,
                    $jurusan
                );

        } else {

            $data['mahasiswa'] =
                $mahasiswaModel->getAll();
        }

        // kirim data ke view
        $data['search'] = $search;

        $data['jurusan'] = $jurusan;

        $this->view('mahasiswa/index', $data);
    }

    // form tambah data
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

                'nama_lengkap' =>
                    trim($_POST['nama_lengkap']),

                'fakultas' =>
                    trim($_POST['fakultas']),

                'jurusan' =>
                    trim($_POST['jurusan']),

                'tempat_lahir' =>
                    trim($_POST['tempat_lahir']),

                'tanggal_lahir' =>
                    trim($_POST['tanggal_lahir']),

                'jenis_kelamin' =>
                    trim($_POST['jenis_kelamin'])
            ];

            $mahasiswaModel = $this->model('Mahasiswa');

            // validasi npm
            if (empty($data['npm'])) {

                $this->setFlash(
                    'NPM wajib diisi',
                    'error'
                );

                header(
                    'Location: ' .
                    BASEURL .
                    '/mahasiswa/create'
                );

                exit;
            }

            // cek npm unik
            if ($mahasiswaModel->findByNpm($data['npm'])) {

                $this->setFlash(
                    'NPM sudah digunakan',
                    'error'
                );

                header(
                    'Location: ' .
                    BASEURL .
                    '/mahasiswa/create'
                );

                exit;
            }

            // validasi nama
            if (empty($data['nama_lengkap'])) {

                $this->setFlash(
                    'Nama lengkap wajib diisi',
                    'error'
                );

                header(
                    'Location: ' .
                    BASEURL .
                    '/mahasiswa/create'
                );

                exit;
            }

            // simpan data
            if ($mahasiswaModel->create($data)) {

                $this->setFlash(
                    'Data mahasiswa berhasil ditambahkan',
                    'success'
                );

                header(
                    'Location: ' .
                    BASEURL .
                    '/mahasiswa/index'
                );

            } else {

                $this->setFlash(
                    'Data mahasiswa gagal ditambahkan',
                    'error'
                );

                header(
                    'Location: ' .
                    BASEURL .
                    '/mahasiswa/create'
                );
            }

            exit;
        }
    }

    // form edit
    public function edit($id)
    {
        $mahasiswaModel = $this->model('Mahasiswa');

        $data['mahasiswa'] =
            $mahasiswaModel->find($id);

        // cek data
        if (!$data['mahasiswa']) {

            $this->setFlash(
                'Data mahasiswa tidak ditemukan',
                'error'
            );

            header(
                'Location: ' .
                BASEURL .
                '/mahasiswa/index'
            );

            exit;
        }

        $this->view('mahasiswa/edit', $data);
    }

    // update data
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [

                'npm' => trim($_POST['npm']),

                'nama_lengkap' =>
                    trim($_POST['nama_lengkap']),

                'fakultas' =>
                    trim($_POST['fakultas']),

                'jurusan' =>
                    trim($_POST['jurusan']),

                'tempat_lahir' =>
                    trim($_POST['tempat_lahir']),

                'tanggal_lahir' =>
                    trim($_POST['tanggal_lahir']),

                'jenis_kelamin' =>
                    trim($_POST['jenis_kelamin'])
            ];

            $mahasiswaModel = $this->model('Mahasiswa');

            // update data
            if ($mahasiswaModel->update($id, $data)) {

                $this->setFlash(
                    'Data mahasiswa berhasil diupdate',
                    'success'
                );

                header(
                    'Location: ' .
                    BASEURL .
                    '/mahasiswa/index'
                );

            } else {

                $this->setFlash(
                    'Data mahasiswa gagal diupdate',
                    'error'
                );

                header(
                    'Location: ' .
                    BASEURL .
                    '/mahasiswa/edit/' . $id
                );
            }

            exit;
        }
    }

    // hapus data
    public function delete($id)
    {
        $mahasiswaModel = $this->model('Mahasiswa');

        // hapus data
        if ($mahasiswaModel->delete($id)) {

            $this->setFlash(
                'Data mahasiswa berhasil dihapus',
                'success'
            );

        } else {

            $this->setFlash(
                'Data mahasiswa gagal dihapus',
                'error'
            );
        }

        header(
            'Location: ' .
            BASEURL .
            '/mahasiswa/index'
        );

        exit;
    }
}