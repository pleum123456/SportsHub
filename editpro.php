<?php

    include 'connectlocal.php';
    //include 'connectserver.php';
    $idpro = $_GET["idpro"];
    if(isset($_POST) && !empty($_POST)){
        $namepro = $_POST["namepro"];
        $detailpro = $_POST["detailpro"];
        $price = $_POST["price"];
        $discount = $_POST["discount"];
        $numberpro = $_POST["numberpro"];

        $image_name = $_FILES['profile_image']['name'];
        $image_tmp = $_FILES['profile_image']['tmp_name'];
        $folder = 'picpro/';
        $image_location = $folder . $image_name;
        // if($image_name=="") {
        //     $message = "insert picture";
        //     echo "<script type='text/javascript'>alert('$message');</script>";
        // }
        $sqlupdate = "UPDATE product SET namepro='$namepro',detailpro='$detailpro' ,price='$price' ,
                     discount='$discount' ,numberpro='$numberpro', picpro='$image_name'
                     WHERE idpro='$idpro'";
        $resultupdate = mysqli_query($conn, $sqlupdate);
        move_uploaded_file($image_tmp,$image_location);
        if ($resultupdate) {
            header("location:admin.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    
<div class="container">

        <div class="mb-3 mt-3">
            <h2>แก้ไขข้อมูลสินค้า</h2>
            <?php
                $idpro = $_GET["idpro"];
                $sql = "SELECT * FROM product WHERE idpro = '$idpro'";
                $result = mysqli_query($conn , $sql);
                $row = mysqli_fetch_assoc($result);
            ?>
        <form  action="" method="post" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label >ชื่อสินค้า :</label>
            <input type="text" class="form-control" name="namepro" value="<?php echo $row["namepro"] ?>">
        </div>

        <form  action="" method="post">
        <div class="mb-3 mt-3">
            <label >รายละเอียดสินค้า :</label>
            <textarea class="form-control" name="detailpro" ><?php echo $row["detailpro"] ?></textarea>
        </div>
        <form  action="" method="post">
        <div class="mb-3 mt-3">
            <label >จำนวนสินค้า :</label>
            <input type="text" class="form-control" name="numberpro" value="<?php echo $row["numberpro"] ?>">
        </div>   
        <div class="mb-3 mt-3">
            <label >ราคา :</label>
            <input type="text" class="form-control" name="price" value="<?php echo $row["price"] ?>">
        </div>
        <form  action="" method="post">
        <div class="mb-3 mt-3">
            <label >ส่วนลด:(เปอร์เซ็น)</label>
            <input type="text" class="form-control" name="discount" value="<?php echo $row["discount"] ?>">
        </div>    
        <div class="mb-3 mt-3">
            <label >รูปสินค้า</label>
            <input type="file" class="form-control" name="profile_image">
        </div> 
		<button type="submit" class="btn btn-primary"><hc>Confrim</hc></button>
        <a href="admin.php" class="btn btn-primary"><hc>Back</hc></a>
        </div>
    </div>
        
</body>
</html>