<?php

require_once "../config/database.php";

$db = new Database();

$conn = $db->getConnection();

if ($conn) {

    echo "Koneksi berhasil";

} else {

    echo "Koneksi gagal";
}