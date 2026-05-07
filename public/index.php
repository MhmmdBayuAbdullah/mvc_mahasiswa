<?php

// BASE URL
define('BASEURL', 'http://localhost/mvc_mahasiswa/public');

// koneksi database
require_once '../config/database.php';

// ambil parameter url
$url = isset($_GET['url']) ? $_GET['url'] : 'Home/index';

// pecah url menjadi array
$url = explode('/', $url);

// controller
$controllerName = $url[0];

// method
$methodName = isset($url[1]) ? $url[1] : 'index';

// parameter
$params = array_slice($url, 2);

// panggil file controller
require_once "../app/controllers/$controllerName.php";

// buat object controller
$controller = new $controllerName;

// cek method ada atau tidak
if (method_exists($controller, $methodName)) {

    call_user_func_array(
        [$controller, $methodName],
        $params
    );

} else {

    echo "Method tidak ditemukan!";
}