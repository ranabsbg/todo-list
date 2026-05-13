<?php
include "db.php";

$id = $_GET["id"];

$sql = "UPDATE tasks SET status = 1 WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: index.php");
?>