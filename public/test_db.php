<?php

require_once "../core/Database.php";

$conn = Database::getConnection();

if ($conn) {

    echo "Koneksi berhasil";

} else {

    echo "Koneksi gagal";
}