<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "akilli_todo_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Bağlantı hatası");
}
?>