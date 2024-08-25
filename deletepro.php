<?php
include 'connectlocal.php';

if(isset($_GET['idpro']) && !empty($_GET['idpro'])) {
    $idpro = $_GET['idpro'];
    
    // สร้างคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM product WHERE idpro = $idpro";

    // ทำการลบข้อมูล
    $result = mysqli_query($conn, $sql);

    // ตรวจสอบว่าลบสำเร็จหรือไม่
    if($result) {
        $message = "Product deleted successfully";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        $message = "Error deleting product";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}

// Redirect to the same page or any other page after deletion.
header("Location: admin.php");
exit();
?>