<?php
include "../session.php";
include "../db.php";
include "../header.php";
include "../left.php";

if (isset($_GET['id'])){
    $id = $_GET['id'];
}

$sql = "DELETE FROM group_student WHERE id=$id";
if ($conn->exec($sql)){
    $host = 'http://' . $_SERVER['HTTP_HOST'] . '/group_student/index.php';
    echo "<script> window.location.replace('$host') </script>";
    die();
} else {
    print_r($conn->errorInfo());
    die();
}

?>



