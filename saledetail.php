<?php
include 'connectlocal.php';
//include 'connectserver.php';
session_start();
//unset($_SESSION["shopping_food"]);



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!-- เพิ่ม CSS นี้เพื่อปรับแต่งพื้นหลัง -->
  <style>
    /* เพิ่มส่วนนี้เพื่อปรับพื้นหลัง */
    body {
        background-image: url('picpro');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    /* ปรับรูปแบบ Container */
    .container {
        background: rgba(0, 0, 0, 0.3);
        padding: 20px;
        margin-top: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn {
            background-color: #000000;
            border: 2px solid #ffffff;
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.3s;
    }
    
    /* ปรับสีของปุ่มและลิงก์ */
    .btn-primary {
        background-color: #000000 !important;
    }

    .btn-primary:hover {
        background-color: #0056b3 !important;
    }

    .btn-warning {
        background-color: #ffffff !important;
    }

    .btn-warning:hover {
        background-color: #ff0000 !important;
    }

    .btn-back {
            color: #ffffff; /* กำหนดสีตัวอักษรเป็นสีขาว */
            transition: color 0.3s, background-color 0.3s, transform 0.3s;
        }
    .btn-back:hover {
            color: #ffffff; /* กำหนดสีตัวอักษรเป็นสีดำ เมื่อ hover */
            background-color: #ff0000; /* กำหนดสีพื้นหลังเป็นสีแดง เมื่อ hover */
            transform: scale(1.1); /* ปรับขนาดเมื่อ hover */
    }


    /* ปรับ Navbar หลัก */
    .navbar {
        background-color: #ff1493; /* เปลี่ยนสีของ Navbar เป็นสีชมพู */
    }

    .navbar-nav .nav-link {
        color: #ffffff !important; /* สีข้อความของ Navbar หลัก */
    }

    .navbar-nav .nav-link:hover {
        color: #ffc107 !important; /* สีข้อความเมื่อ Hover ที่ Navbar หลัก */
    }


    nav {
    width: 100%;
    height: 7vw;
    background: linear-gradient(125deg, #e61b36, #9c1032) ;
    }
    .nav-container {
        margin-bottom: 20px;
        max-width: 90vw;
        height: 100%;
        margin:0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        

    }
    .logonav {
        width: 15vw;
        object-fit: contain;
    }
    .nav-profile {
        display: flex;
        align-items: center;
    }
    .nav-profile-name {  
        color: #ffffff;
        font-size: 2vw;
        margin-right: 30px;
    }
    .fa-cart-shopping {
        color: #ffffff;
        font-size: 2vw;
    }
    .nav-profile-cart {
        position: relative;

    }
    .cartcount {
        position: absolute;
        top: -15px;
        right: -13px;
        width: 1.7vw;
        height: 1.7vw;
        background: red;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #ffffff;
    }
    .navbar-brand {
        width: 3.5vw;
        object-fit: contain;
        position: relative;
        margin-left: 30px;
    }
    .nav-out {
        color: #fff;
        font-size: 1.2vw;
        text-decoration: none;
        margin-left: 30px;
    }

</style>

<body>
<nav>
        <div class="nav-container">
            <a href="member1.php">
                <img src="picpro/Sports_HUB.png" class="logonav">
            </a>

            <div class="nav-profile">
                <p class="nav-profile-name"><?php echo $_SESSION["namemember"]; ?></p>
                <div class="nav-profile-cart">
                <i class="fas fa-cart-shopping" data-bs-toggle="modal" data-bs-target="#cartModal"></i>
                    <div class="cartcount">
                    <?php echo isset($_SESSION["shopping_pro"]) ? count($_SESSION["shopping_pro"]) : 0; ?>
                    </div>
                </div>

                <div>
                    <a class="navbar-brand" href="saledetail.php">
                        <img src="picpro/user.png" class="navbar-brand" >
                    </a>
                </div>

                <div>
                    <a class="nav-out" href="index1.php">Logout</a>
                </div>
            </div>

        </div>
    </nav>

<!-- แสดงข้อมูลการสั่งซื้อจากฐานข้อมูล sale -->
<div class="container text-center img-fluid p-3 my-3 bg-black text-white">
<h2>รายการสั่งซื้อของ <?php echo $_SESSION["namemember"]; ?></h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">เลขที่การสั่งซื้อ</th>
                <th scope="col">วันที่</th>
                <th scope="col">ยอดรวม</th>
                <!-- <th scope="col">รายละเอียด</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $idmember = $_SESSION["idmember"];
            $sql = "SELECT * FROM sale WHERE idmember = '$idmember'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['idsale']}</td>";
                echo "<td>{$row['dayorder']}</td>";
                echo "<td>{$row['sum']}</td>";
                // echo "<td><a href='sale_detail.php?idsale=" . $row["idsale"] . "'>ดูรายละเอียด</a></td>"; // ลิงก์ไปยังหน้ารายละเอียดการสั่งซื้อ
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="member1.php" class="btn btn-back">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>



<!-- แสดง session array -->
<!-- <?php echo "<pre>". print_r($_SESSION, true) . "</pre>"; ?> -->


</body>
</html>
