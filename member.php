<?php
include 'connectlocal.php';
//include 'connectserver.php';
session_start();
//unset($_SESSION["shopping_food"]);

// ปุ่มนำออกจากตะกร้าสินค้า
if (isset($_GET['action'])) {
    if ($_GET['action'] == "delete") {
        foreach ($_SESSION["shopping_pro"] as $key => $value) {
            if ($value["idpro"] == $_GET["idpro"]) {
                unset($_SESSION["shopping_pro"][$key]);
                $messageDelete = "นำออกตะกร้าแล้ว";
                echo "<script type = 'text/javascript'>alert('$messageDelete')</script>";
            }
        }
    }
}
// ปุ่มนำออกจากตะกร้าสินค้า

// สร้างัวแปร array จาก action=add_pro
if (isset($_POST["add_pro"])) {
    //$select = 1;
    if (isset($_SESSION["shopping_pro"])) {
        $item_array_id = array_column($_SESSION["shopping_pro"], "idpro");
        if (!in_array($_GET["idpro"], $item_array_id)) {
            $count = count($_SESSION["shopping_pro"]);
            $item_array = array(
                'idpro' => $_GET['idpro'],
                'namepro' => $_POST['namepro'],
                'price' => $_POST['price'],
                'discount' => $_POST['discount'],
                'order_q' => $_POST['order_q']
            );

            $_SESSION["shopping_pro"][$count] = $item_array;
        } else {
            $messageAdd = "ใส่ตะกร้าแล้ว";
            echo "<script type = 'text/javascript'>alert('$messageAdd')</script>";
        }
    } else {
        $item_array = array(
            'idpro' => $_GET['idpro'],
            'namepro' => $_POST['namepro'],
            'price' => $_POST['price'],
            'discount' => $_POST['discount'],
            'order_q' => $_POST['order_q']
        );

        $_SESSION["shopping_pro"][0] = $item_array;
    }
}
// สร้างัวแปร array จาก action=add_pro

// การยืนยันการสั่งสินค้า
if (isset($_GET['action'])) {
    if ($_GET['action'] == "order") {
        $sum = $_POST["money_order"];
        $idmember = $_SESSION["idmember"];

        $date = new DateTime;
        $date->setTimeZone(new DateTimeZone('Asia/Bangkok'));
        $dayorder = date("Y-m-d H:i:s");
        // echo $dayorder;
        // list($date, $time) = explode(" ", $date);
        // list($year, $month, $day) = explode("-", $date);
        // $strDate = explode("-", $date);
        // $year_order = $strDate[0];
        // $month_order = $strDate[1];
        // $day_order = $strDate[2];
        //echo $day_order."/".$month_order."/".$year_order;

        $sqlorder = "INSERT INTO sale(sum,dayorder,idmember)
      VALUES('$sum','$dayorder','$idmember')";
        $resultorder = mysqli_query($conn, $sqlorder);

        if ($resultorder) {
            $idsale = mysqli_insert_id($conn);
            foreach ($_SESSION["shopping_pro"] as $key => $value) {
                $idpro = $value["idpro"];
                $order_q = $value["order_q"];

                $sqldetail = "INSERT INTO saledetail(idsale,idpro,numbersale)
              VALUES('$idsale','$idpro','$order_q')";
                $resultdetail = mysqli_query($conn, $sqldetail);

                if ($resultdetail) {
                    unset($_SESSION["shopping_pro"]);
                    $messageOrder = "สั่งซื้อแล้ว";
                    echo "<script type = 'text/javascript'>alert('$messageOrder')</script>";
                }
            }
        }
    }
}
// การยืนยันการสั่งสินค้า

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>P&D Sports Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
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
            background-color: #ff1493;
            /* เปลี่ยนสีของ Navbar เป็นสีชมพู */
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
            /* สีข้อความของ Navbar หลัก */
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
            /* สีข้อความเมื่อ Hover ที่ Navbar หลัก */
        }

        .hn {
            font-size: 18px;
            color: black;
            font-family: "Noto Sans Thai", sans-serif;

        }
    </style>

<body>
    <nav class="navbar navbar-expand-sm bg-black navbar-dark sticky-top">
        <a class="navbar-brand" href="member.php">
            <img src="picpro/LOGO.png" alt="Logo" style="width:50px;">
        </a>
        <div class="container-fluid">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a class="nav-link active" href="">
                        <h2><?php echo $_SESSION["namemember"]; ?></h2>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="saledetail.php">
                        <img src="picpro/user.png" alt="Logo" style="width:40px;">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index1.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container text-center img-fluid p-3 my-3 bg-black text-white">
        <img src="picpro/LOGO.png" class="img-fluid" alt="" style="width:10px;">
        <h1>Sports HUB Shop</h1>
        <p>ยินดีต้อนรับสู่ร้านค้า</p>
    </div>


    <!-- แสดงสินค้า-->
    <?php
    $sqlpro = "SELECT * FROM product";
    $resultpro = mysqli_query($conn, $sqlpro);
    $rowpro = mysqli_fetch_array($resultpro);
    ?>

    <div class="container p-3 my-3 ">
        <?php foreach ($resultpro as $rowpro) {  ?>
            <form method="post" action="member.php?action=add_pro&idpro=<?php echo $rowpro["idpro"]; ?>">
                <div class="row">
                    <div class="col-md-10 mt-2 p-2">
                        <img src="picpro/<?php echo $rowpro["picpro"]; ?>" style="width:250px; height:250px;" class="img-thumbnail" class="img-responsive">
                        <span class="hn"> ชื่อสินค้า : <?php echo $rowpro["namepro"]; ?>


                            <input type="hidden" name="namepro" value="<?php echo $rowpro["namepro"]; ?>">
                            ราคาสินค้า : <?php echo $rowpro["price"]; ?> บาท
                            ส่วนลด : <?php echo $rowpro["discount"]; ?> เปอร์เซ็นต์</span>
                        <input type="hidden" name="price" value="<?php echo $rowpro["price"]; ?>">
                        <input type="hidden" name="discount" value="<?php echo $rowpro["discount"]; ?>">
                        <!--<button type ="button" class = "btn btn-info">+</button>-->
                        <input type="text" name="order_q" value="1">
                        <!--<button type ="button" class = "btn btn-info">-</button>-->
                        <button type="submit" class="btn btn-primary" name="add_pro">Add Cart</button>
                    </div>
                </div>
            </form>
        <?php  } ?>
    </div>
    <!-- แสดงสินค้า-->

    <!-- ตะกล้าสินค้า-->
    <?php if (!empty($_SESSION["shopping_pro"])) { ?>
        <div class="container mt-2 p-2">
            <?php $total = 0;
            foreach ($_SESSION["shopping_pro"] as $key => $value) { ?>
                <div class="row justify-content-center hn">
                    <div class="col-md-2 ">
                        ชื่อสินค้า : <?php echo $value["namepro"]; ?>
                    </div>
                    <div class="col-md-2 ">
                        จำนวน : <?php echo $value["order_q"]; ?>
                    </div>
                    <?php
                    $pricenew = $value["price"] - ($value["price"] * $value["discount"] / 100);
                    $total = $total + ($pricenew * $value["order_q"]);
                    ?>
                    <div class="col-md-2 ">
                        ราคา : <?php echo number_format($pricenew, 2); ?> บาท
                    </div>
                    <div class="col-md-2 ">
                        ราคารวม : <?php echo $pricenew * $value["order_q"]; ?> บาท
                    </div>
                    <div class="col-md-2 ">
                        <a href="member.php?action=delete&idpro=<?php echo $value['idpro']; ?>">
                            <button type="button" class="btn btn-warning w-100">นำออก</button>
                        </a>
                    </div>
                </div>
                <br>
            <?php } ?>
            <div class="row justify-content-center">
                <div class="col-md-8 hn">
                    <hr class="featurette-divider">
                    <h5>ราคาทั้งหมด : <?php echo number_format($total, 2); ?> บาท</h5>
                </div>
                <div class="col-md-2 hn">
                    <form method="post" action="member.php?action=order">
                        <input type="hidden" name="money_order" value="<?php echo $total; ?>">
                        <button type="submit" class="btn btn-primary btn-lg w-100">ยืนยัน</button>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- ตะกล้าสินค้า-->

    <!-- แสดง session array -->
    <!-- <?php echo "<pre>" . print_r($_SESSION, true) . "</pre>"; ?> -->

</body>

</html>