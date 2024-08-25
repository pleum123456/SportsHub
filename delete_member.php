<?php
include 'connectlocal.php';
session_start();

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // ลบข้อมูลสมาชิก
    $delete_sql = "DELETE FROM member WHERE idmember='$id'";
    if(mysqli_query($conn, $delete_sql)) {
        header("Location: editmember.php");
        exit();
    } else {
        echo "Error deleting member: " . mysqli_error($conn);
    }
} else {
    echo "ID not specified";
    exit();
}
?>
