<?php
include "db.php";

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "UPDATE tasks SET status = 1 - status WHERE id = $id";
    mysqli_query($conn, $sql);
}

header("Location: index.php");
?>
