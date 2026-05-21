<?php

class AuthController extends Controller
{
    // form login
    public function login()
    {
        // jika sudah login
        if (isset($_SESSION['user'])) {

            header(
                'Location: ' .
                BASEURL .
                '/mahasiswa/index'
            );

            exit;
        }

        $data['title'] = 'Login';

        $this->view('auth/login', $data);
    }

    // proses login
    public function processLogin()
    {
        // hanya POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {

            header(
                'Location: ' .
                BASEURL .
                '/auth/login'
            );

            exit;
        }

        // ambil input
        $username = isset($_POST['username'])
            ? trim($_POST['username'])
            : '';

        $password = isset($_POST['password'])
            ? trim($_POST['password'])
            : '';

        // validasi kosong
        if (empty($username) || empty($password)) {

            $_SESSION['flash'] = [

                'message' =>
                    'Username dan password wajib diisi',

                'type' => 'danger'
            ];

            header(
                'Location: ' .
                BASEURL .
                '/auth/login'
            );

            exit;
        }

        // model user
        $userModel = $this->model('User');

        // cari user
        $user = $userModel->findByUsername($username);

        // cek user ditemukan
        if (!$user) {

            $_SESSION['flash'] = [

                'message' =>
                    'Username tidak ditemukan',

                'type' => 'danger'
            ];

            header(
                'Location: ' .
                BASEURL .
                '/auth/login'
            );

            exit;
        }

        // cek password hash
        if (
            !password_verify(
                $password,
                $user['password']
            )
        ) {

            $_SESSION['flash'] = [

                'message' =>
                    'Password salah',

                'type' => 'danger'
            ];

            header(
                'Location: ' .
                BASEURL .
                '/auth/login'
            );

            exit;
        }

        // simpan session
        $_SESSION['user'] = [

            'id' => $user['id'],

            'username' => $user['username'],

            'role' => $user['role']
        ];

        // redirect
        header(
            'Location: ' .
            BASEURL .
            '/mahasiswa/index'
        );

        exit;
    }

    // logout
    public function logout()
    {
        // hapus session user
        unset($_SESSION['user']);

        // destroy session
        session_destroy();

        header(
            'Location: ' .
            BASEURL .
            '/auth/login'
        );

        exit;
    }
}