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

  <link rel="stylesheet" href="member.css">

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

    /* ปรับ Navbar บนสุด */
    .navbar-top {
        background-color: #292121;
        padding: 10px;
        text-align: center;
    }

    .navbar-top img {
        max-height: 100px;
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
    

</style>

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

<!-- แสดงข้อมูลMember -->
<div class="container text-center img-fluid p-3 my-3 bg-black text-white">
<h2>Member </h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">idmember</th>
                <th scope="col">namemember</th>
                <th scope="col">addressmember</th>
                <th scope="col">telmember</th>
                <th scope="col">statusmember</th>
                <th scope="col">Editmember</th>
                <!-- <th scope="col">รายละเอียด</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $idmember = $_SESSION["idmember"];
            $sql = "SELECT * FROM member";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['idmember']}</td>";
                echo "<td>{$row['namemember']}</td>";
                echo "<td>{$row['addressmember']}</td>";
                echo "<td>{$row['telmember']}</td>";
                echo "<td>{$row['statusmember']}</td>";
                echo "<td>";
                echo "<a href='edit_member.php?id={$row['idmember']}' class='btn btn-warning'>Edit</a>&nbsp;";
                echo "<a href='delete_member.php?id={$row['idmember']}' class='btn btn-danger'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="admin.php" class="btn btn-back">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>



<!-- แสดง session array -->
<!-- <?php echo "<pre>". print_r($_SESSION, true) . "</pre>"; ?> -->
</body>
</html>
