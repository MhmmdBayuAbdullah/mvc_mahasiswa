<?php

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswaModel = $this->model('Mahasiswa');

        $data['mahasiswa'] = $mahasiswaModel->getAll();

        $this->view('mahasiswa/index', $data);
    }
}