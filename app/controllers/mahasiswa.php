<?php

class Mahasiswa {

    public function index()
    {
        echo "<h1>Data Mahasiswa</h1>";
    }

    public function detail($nama = "Tidak ada")
    {
        echo "<h1>Detail Mahasiswa : $nama</h1>";
    }
}