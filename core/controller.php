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
}