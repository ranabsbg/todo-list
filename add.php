<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $priority = (int)$_POST["priority"]; 
    
    $sql = "INSERT INTO tasks (title, priority, status) VALUES ('$title', '$priority', 0)";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>
