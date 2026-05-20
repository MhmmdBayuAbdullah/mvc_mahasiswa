<?php

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);

        require_once "../app/views/" . $view . ".php";
    }

    public function model($model)
    {
        require_once "../app/models/" . $model . ".php";

        return new $model;
    }

    public function formatTanggalIndonesia($tanggal)
    {
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $pecah = explode('-', $tanggal);

        return $pecah[2] . ' ' .
               $bulan[(int)$pecah[1]] . ' ' .
               $pecah[0];
    }

    // FLASH MESSAGE
    public function setFlash($message, $type = 'success')
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public function flash()
    {
        if (isset($_SESSION['flash'])) {

            $flash = $_SESSION['flash'];

            echo "
                <div style='
                    padding:10px;
                    margin-bottom:15px;
                    background-color:" .
                    ($flash['type'] == 'success' ? '#d4edda' : '#f8d7da') . ";
                    color:" .
                    ($flash['type'] == 'success' ? '#155724' : '#721c24') . ";
                '>
                    {$flash['message']}
                </div>
            ";

            unset($_SESSION['flash']);
        }
    }
}