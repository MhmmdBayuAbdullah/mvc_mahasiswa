<?php

class MahasiswaController extends Controller
{
    // constructor
    public function __construct()
    {
        // cek login
        if (!isset($_SESSION['user'])) {

            header(
                'Location: ' .
                BASEURL .
                '/auth/login'
            );

            exit;
        }
    }

    // hanya admin
    private function onlyAdmin()
    {
        if ($_SESSION['user']['role'] != 'admin') {

            $_SESSION['flash'] = [
                'message' => 'Akses ditolak',
                'type' => 'danger'
            ];

            header(
                'Location: ' .
                BASEURL .
                '/mahasiswa/index'
            );

            exit;
        }
    }

    // tampil data + search filter
    public function index()
    {
        $mahasiswaModel = $this->model('Mahasiswa');

        // ambil GET
        $search = $_GET['search'] ?? '';

        $jurusan = $_GET['jurusan'] ?? '';

        // search/filter
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

        // kirim data filter ke view
        $data['search'] = $search;

        $data['jurusan'] = $jurusan;

        $this->view('mahasiswa/index', $data);
    }

    // form create
    public function create()
    {
        $this->onlyAdmin();

        $this->view('mahasiswa/create');
    }

    // simpan data
    public function store()
    {
        $this->onlyAdmin();

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

            // validasi
            if (empty($data['npm'])) {

                $this->setFlash(
                    'NPM wajib diisi',
                    'danger'
                );

                header(
                    'Location: ' .
                    BASEURL .
                    '/mahasiswa/create'
                );

                exit;
            }

            // cek npm sudah ada
            if (
                $mahasiswaModel->findByNpm(
                    $data['npm']
                )
            ) {

                $this->setFlash(
                    'NPM sudah digunakan',
                    'danger'
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
                    'danger'
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
        $this->onlyAdmin();

        $mahasiswaModel = $this->model('Mahasiswa');

        $data['mahasiswa'] =
            $mahasiswaModel->find($id);

        // cek data ada
        if (!$data['mahasiswa']) {

            $this->setFlash(
                'Data mahasiswa tidak ditemukan',
                'danger'
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
        $this->onlyAdmin();

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
            if (
                $mahasiswaModel->update(
                    $id,
                    $data
                )
            ) {

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
                    'danger'
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
        $this->onlyAdmin();

        $mahasiswaModel = $this->model('Mahasiswa');

        // hapus
        if ($mahasiswaModel->delete($id)) {

            $this->setFlash(
                'Data mahasiswa berhasil dihapus',
                'success'
            );

        } else {

            $this->setFlash(
                'Data mahasiswa gagal dihapus',
                'danger'
            );
        }

        header(
            'Location: ' .
            BASEURL .
            '/mahasiswa/index'
        );

        exit;
    }

    // export CSV
    public function exportCSV()
    {
        $mahasiswaModel = $this->model('Mahasiswa');

        $search = $_GET['search'] ?? '';

        $jurusan = $_GET['jurusan'] ?? '';

        // ambil data
        if ($search != '' || $jurusan != '') {

            $mahasiswa =
                $mahasiswaModel->searchAndFilter(
                    $search,
                    $jurusan
                );

        } else {

            $mahasiswa =
                $mahasiswaModel->getAll();
        }

        // header download
        header('Content-Type: text/csv');

        header(
            'Content-Disposition: attachment; filename="data_mahasiswa.csv"'
        );

        $output = fopen('php://output', 'w');

        // header kolom
        fputcsv($output, [

            'ID',
            'NPM',
            'Nama Lengkap',
            'Fakultas',
            'Jurusan',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Status'
        ]);

        // isi data
        foreach ($mahasiswa as $mhs) {

            fputcsv($output, [

                $mhs['id'],
                $mhs['npm'],
                $mhs['nama_lengkap'],
                $mhs['fakultas'],
                $mhs['jurusan'],
                $mhs['tempat_lahir'],
                $mhs['tanggal_lahir'],
                $mhs['jenis_kelamin'],

                ($mhs['status_id'] == 1)
                    ? 'Aktif'
                    : 'Nonaktif'
            ]);
        }

        fclose($output);

        exit;
    }

    // export PDF
    public function exportPDF()
    {
        require_once '../vendor/autoload.php';

        $mahasiswaModel = $this->model('Mahasiswa');

        $search = $_GET['search'] ?? '';

        $jurusan = $_GET['jurusan'] ?? '';

        // ambil data
        if ($search != '' || $jurusan != '') {

            $mahasiswa =
                $mahasiswaModel->searchAndFilter(
                    $search,
                    $jurusan
                );

        } else {

            $mahasiswa =
                $mahasiswaModel->getAll();
        }

        $html = '

        <h2 style="text-align:center;">
            Data Mahasiswa
        </h2>

        <table
            border="1"
            cellpadding="5"
            cellspacing="0"
            width="100%"
        >

            <tr>

                <th>No</th>
                <th>NPM</th>
                <th>Nama Lengkap</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>

            </tr>
        ';

        $no = 1;

        foreach ($mahasiswa as $mhs) {

            $status =
                ($mhs['status_id'] == 1)
                ? 'Aktif'
                : 'Nonaktif';

            $html .= '

            <tr>

                <td>' . $no++ . '</td>

                <td>' . $mhs['npm'] . '</td>

                <td>' . $mhs['nama_lengkap'] . '</td>

                <td>' . $mhs['fakultas'] . '</td>

                <td>' . $mhs['jurusan'] . '</td>

                <td>' . $mhs['tempat_lahir'] . '</td>

                <td>' . $mhs['tanggal_lahir'] . '</td>

                <td>' . $mhs['jenis_kelamin'] . '</td>

                <td>' . $status . '</td>

            </tr>
            ';
        }

        $html .= '</table>';

        $dompdf = new Dompdf\Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->setPaper(
            'A4',
            'landscape'
        );

        $dompdf->render();

        $dompdf->stream(
            'data_mahasiswa.pdf',
            ['Attachment' => false]
        );

        exit;
    }
}