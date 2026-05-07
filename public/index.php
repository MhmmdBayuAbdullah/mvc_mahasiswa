<?php

define('BASEURL', 'http://localhost/mvc_mahasiswa/public');

// require core
require_once "../core/Controller.php";
require_once "../core/Router.php";
require_once "../core/Database.php";

// jalankan router
$router = new Router();

$router->run();