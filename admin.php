<?php

    include 'connectlocal.php';
    //include 'connectserver.php';
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


    if(($namepro != "") AND ($detailpro!= "") AND ($price!= "") AND ($discount!= "") AND ($numberpro!= "")) {
    $sql = "INSERT INTO product(namepro,detailpro,price,discount,picpro,numberpro)
            VALUES('$namepro','$detailpro','$price',' $discount','$image_name','$numberpro')";
    $result = mysqli_query($conn,$sql);

    move_uploaded_file($image_tmp,$image_location);

        if ($result) {
            $message = "insert complete";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="member.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        /* เพิ่มส่วน CSS นี้เพื่อปรับ Navbar บนสุด */
        .navbar-top {
            background-color: #212529;
            padding: 10px;
            text-align: center;
        }

        .navbar-top img {
            max-height: 100px;
        }

        /* เพิ่มส่วน CSS นี้เพื่อปรับ Navbar หลัก */
        .navbar {
            background-color: #0056b3; /* สีพื้นหลัง Navbar หลัก */
        }

        .navbar-nav .nav-link {
            color: #ffffff !important; /* สีข้อความของ Navbar หลัก */
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107 !important; /* สีข้อความเมื่อ Hover ที่ Navbar หลัก */
        }

        /* ... (ส่วน CSS อื่น ๆ ที่คุณได้เพิ่มมาแล้ว) ... */
    </style>  
</head>
<body>

    <nav>
        <div class="nav-container">
            <a href="#">
                <img src="picpro/Sports_HUB.png" class="logonav">
            </a>

            <div class="nav-profile">
                <div>
                    <a class="nav-out" href="index1.php">Logout</a>
                </div>
            </div>

        </div>
    </nav>

<div class="container mt-3">
  <h2>Member Part</h2>
  <div class="mt-2 p-2">
    <button type="button" class="btn btn-dark w-10" onclick="document.location='editmember.php'"><a class="navbar-brand" href="saledetail.php">
                        <img src="picpro/network.png" alt="Logo" style="width:40px;">
                    </a>Edit Member</button>

<div class="container mt-3">
  <h2>Advertising product form</h2>
<form action="" method="post" enctype="multipart/form-data">
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">ชื่อสินค้า:</label>
    <input type="text" class="form-control" name="namepro">
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">รายละเอียด:</label>
    <input type="text" class="form-control" name="detailpro">
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">จำนวนสินค้า:</label>
    <input type="text" class="form-control" name="numberpro">
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">ราคา: (บาท)</label>
    <input type="text" class="form-control" name="price">
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">ส่วนลด: (เปอร์เซ็นต์)</label>
    <input type="text" class="form-control" name="discount">
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">รูปสินค้า</label>
    <input type="file" class="form-control" name="profile_image">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<?php
$sqlpro = "SELECT * FROM product";
$resultpro = mysqli_query($conn,$sqlpro);
$rowpro = mysqli_fetch_array($resultpro);
?>
<div class="container mt-3">
  <div class="row">
  <?php foreach($resultpro as $rowpro) { ?>
  <div class="col-md-3">
  <div class="card" style="width:300px">
    <img class="card-img-top" src="picpro/<?php echo $rowpro["picpro"]; ?>" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">ชื่อสินค้า : <?php echo $rowpro["namepro"]; ?></h4>
      <p class="card-text">รายละเอียด : <?php echo $rowpro["detailpro"]; ?></p>
      <p class="card-text">ราคา : <?php echo $rowpro["price"]; ?></p>
      <p class="card-text">ส่วนลด : <?php echo $rowpro["discount"]; ?></p>
      <p class="card-text">จำนวนสินค้า : <?php echo $rowpro["numberpro"]; ?></p>
      <a href="editpro.php?idpro=<?php echo $rowpro["idpro"]; ?>" class="btn btn-primary">Edit Product</a>
      <a href="deletepro.php?idpro=<?php echo $rowpro["idpro"]; ?>" class="btn btn-danger">Delete Product</a>
    </div>
    </div>
    </div>
  <?php } ?>
  <br>
</div>
</div>
</body>
</html>
