<?php
include 'connectlocal.php';
//include 'connectserver.php';
session_start();
//unset($_SESSION["shopping_food"]);

// ตรวจสอบและดึง filter จาก URL
$filter = isset($_GET['filter']) ? mysqli_real_escape_string($conn, $_GET['filter']) : '';

// การกรองสินค้า
$filter_sql = '';
if ($filter) {
    $filter_sql = "WHERE namepro LIKE '%$filter%'";
}

// คำสั่ง SQL ที่ใช้ดึงข้อมูลสินค้า
$sqlpro = "SELECT * FROM product $filter_sql";
$resultpro = mysqli_query($conn, $sqlpro);

// ตรวจสอบข้อผิดพลาดของ SQL
if (!$resultpro) {
    die("Query failed: " . mysqli_error($conn));
}

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

// ปรับจำนวนสินค้า
if (isset($_GET['action'])) {
    if ($_GET['action'] == "increase") {
        foreach ($_SESSION["shopping_pro"] as $key => $value) {
            if ($value["idpro"] == $_GET["idpro"]) {
                $_SESSION["shopping_pro"][$key]["order_q"] += 1;
                header("Location: member1.php"); // เปลี่ยนเส้นทางเพื่อหลีกเลี่ยงการส่งซ้ำ
            }
        }
    } elseif ($_GET['action'] == "decrease") {
        foreach ($_SESSION["shopping_pro"] as $key => $value) {
            if ($value["idpro"] == $_GET["idpro"]) {
                if ($_SESSION["shopping_pro"][$key]["order_q"] > 1) {
                    $_SESSION["shopping_pro"][$key]["order_q"] -= 1;
                } else {
                    unset($_SESSION["shopping_pro"][$key]); // ลบสินค้าหากจำนวนเป็น 0
                }
                header("Location: member1.php");
            }
        }
    }
}

// สร้างัวแปร array จาก action=add_pro
if (isset($_POST["add_pro"])) {
    if (isset($_SESSION["shopping_pro"])) {
        $item_array_id = array_column($_SESSION["shopping_pro"], "idpro");

        if (in_array($_GET["idpro"], $item_array_id)) {
            // ถ้ามีสินค้าในตะกร้าแล้ว ให้เพิ่มจำนวนสินค้า
            foreach ($_SESSION["shopping_pro"] as $key => $value) {
                if ($value["idpro"] == $_GET["idpro"]) {
                    $_SESSION["shopping_pro"][$key]["order_q"] += $_POST['order_q']; // เพิ่มจำนวนสินค้า
                    $messageAddCart = "เพิ่มสินค้าลงตะกร้าสำเร็จแล้ว!";
                }
            }
        } else {
            // ถ้ายังไม่มีสินค้าในตะกร้า ให้เพิ่มสินค้าใหม่เข้าไป
            $count = count($_SESSION["shopping_pro"]);
            $item_array = array(
                'idpro' => $_GET['idpro'],
                'namepro' => $_POST['namepro'],
                'price' => $_POST['price'],
                'discount' => $_POST['discount'],
                'order_q' => $_POST['order_q']
            );

            $_SESSION["shopping_pro"][$count] = $item_array;
            $messageAddCart = "เพิ่มสินค้าลงตะกร้าสำเร็จแล้ว!";
        }
    } else {
        // ถ้าตะกร้ายังว่าง ให้เพิ่มสินค้าชิ้นแรก
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
    <title>Sports hub shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="member.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (!empty($messageAddCart)) { ?>
                alert('<?php echo $messageAddCart; ?>');
            <?php } ?>
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.sideber-search');
            const productItems = document.querySelectorAll('.product-items');

            searchInput.addEventListener('input', function() {
                const searchText = this.value.toLowerCase();

                productItems.forEach(function(item) {
                    const itemName = item.querySelector('p').textContent.toLowerCase();
                    if (itemName.includes(searchText)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>

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
                        <img src="picpro/user.png" class="navbar-brand">
                    </a>
                </div>

                <div>
                    <a class="nav-out" href="index1.php">Logout</a>
                </div>
            </div>

        </div>
    </nav>

    <div class="containertop text-center p-3 my-3 bg-black text-white">
        <img src="picpro/LOGO.png" style="width:150px;">
        <h1>Sports HUB Shop</h1>
        <p>ยินดีต้อนรับสู่ร้านค้า</p>
    </div>

    <div class="containerm">
        <div class="sidebar">
            <input type="text" class="sideber-search" placeholder="Search something...">

            <a href="member1.php?filter=" class="sidebar-item">
                ทั้งหมด
            </a>

            <a href="member1.php?filter=เสื้อ" class="sidebar-item">
                เสื้อ
            </a>

            <a href="member1.php?filter=กางเกง" class="sidebar-item">
                กางเกง
            </a>

            <a href="member1.php?filter=ถุงเท้า" class="sidebar-item">
                ถุงเท้า
            </a>

            <a href="member1.php?filter=รองเท้า" class="sidebar-item">
                รองเท้า
            </a>

        </div>

        <!-- แสดงสินค้า-->
        <div class="product">
            <?php if (mysqli_num_rows($resultpro) > 0) { ?>
                <?php while ($rowpro = mysqli_fetch_array($resultpro)) { ?>
                    <form method="post" action="member1.php?action=add_pro&idpro=<?php echo $rowpro["idpro"]; ?>">
                        <div class="product-items">
                            <img class="product-img" src="picpro/<?php echo $rowpro["picpro"]; ?>" alt="">
                            <p style="font-size: 1.2vw;">ชื่อสินค้า : <?php echo $rowpro["namepro"]; ?></p>
                            <p style="font-size: 1vw;">ราคาสินค้า : <?php echo $rowpro["price"]; ?> THB</p>

                            <input type="hidden" name="namepro" value="<?php echo $rowpro["namepro"]; ?>">
                            ส่วนลด : <?php echo $rowpro["discount"]; ?> เปอร์เซ็นต์
                            <input type="hidden" name="price" value="<?php echo $rowpro["price"]; ?>">
                            <input type="hidden" name="discount" value="<?php echo $rowpro["discount"]; ?>">

                            <input type="text" name="order_q" value="1">
                            <button type="submit" class="btn btn-buy" name="add_pro">Add Cart</button>
                        </div>
                    </form>
                <?php } ?>
            <?php } else { ?>
                <p>ไม่มีสินค้าตามที่ค้นหา</p>
            <?php } ?>
        </div>
    </div>

    <!-- ตะกร้าสินค้า-->

    <!-- <?php if (!empty($_SESSION["shopping_pro"])) { ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">ตะกร้าสินค้าของคุณ</h2>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคาต่อหน่วย (THB)</th>
                        <th>ราคารวม (THB)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION["shopping_pro"] as $key => $value) { ?>
                        <?php
                        $pricenew = $value["price"] - ($value["price"] * $value["discount"] / 100);
                        $subtotal = $pricenew * $value["order_q"];
                        $total += $subtotal;
                        ?>
                        <tr>
                            <td><?php echo $value["namepro"]; ?></td>
                            <td> -->
    <!-- Quantity Control -->
    <!-- <div class="d-flex justify-content-center align-items-center">
                                    <a href="member1.php?action=decrease&idpro=<?php echo $value['idpro']; ?>" class="btn btn-secondary btn-sm mx-1">-</a>
                                    <span><?php echo $value["order_q"]; ?></span>
                                    <a href="member1.php?action=increase&idpro=<?php echo $value['idpro']; ?>" class="btn btn-secondary btn-sm mx-1">+</a>
                                </div>
                            </td>
                            <td><?php echo number_format($pricenew, 2); ?></td>
                            <td><?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <a href="member1.php?action=delete&idpro=<?php echo $value['idpro']; ?>" class="btn btn-warning btn-sm">
                                    นำออก
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" class="text-right"><strong>ราคาทั้งหมด:</strong></td>
                        <td colspan="2"><strong><?php echo number_format($total, 2); ?> บาท</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-end">
            <form method="post" action="member1.php?action=order">
                <input type="hidden" name="money_order" value="<?php echo $total; ?>">
                <button type="submit" class="btn btn-success btn-lg">ยืนยันการสั่งซื้อ</button>
            </form>
        </div>
    </div>
<?php } ?> -->
    <!-- จบตะกร้าสินค้า-->

    <!-- แสดง session array -->
    <!-- <?php echo "<pre>" . print_r($_SESSION, true) . "</pre>"; ?> -->
    </div>

    <!-- โครงสร้าง Bootstrap Modal สำหรับตะกร้าสินค้า -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">ตะกร้าสินค้าของคุณ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- เริ่มแสดงข้อมูลตะกร้าสินค้า -->
                    <?php if (!empty($_SESSION["shopping_pro"])) { ?>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวน</th>
                                        <th>ราคาต่อหน่วย (THB)</th>
                                        <th>ราคารวม (THB)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0; ?>
                                    <?php foreach ($_SESSION["shopping_pro"] as $key => $value) { ?>
                                        <?php
                                        $pricenew = $value["price"] - ($value["price"] * $value["discount"] / 100);
                                        $subtotal = $pricenew * $value["order_q"];
                                        $total += $subtotal;
                                        ?>
                                        <tr>
                                            <td><?php echo $value["namepro"]; ?></td>
                                            <td>
                                                <!-- Quantity Control -->
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="member1.php?action=decrease&idpro=<?php echo $value['idpro']; ?>" class="btn btn-secondary btn-sm mx-1">-</a>
                                                    <span><?php echo $value["order_q"]; ?></span>
                                                    <a href="member1.php?action=increase&idpro=<?php echo $value['idpro']; ?>" class="btn btn-secondary btn-sm mx-1">+</a>
                                                </div>
                                            </td>
                                            <td><?php echo number_format($pricenew, 2); ?></td>
                                            <td><?php echo number_format($subtotal, 2); ?></td>
                                            <td>
                                                <a href="member1.php?action=delete&idpro=<?php echo $value['idpro']; ?>" class="btn btn-warning btn-sm">
                                                    นำออก
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>ราคาทั้งหมด:</strong></td>
                                        <td colspan="2"><strong><?php echo number_format($total, 2); ?> บาท</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end">
                            <form method="post" action="member1.php?action=order">
                                <input type="hidden" name="money_order" value="<?php echo $total; ?>">
                                <button type="submit" class="btn btn-success btn-lg">ยืนยันการสั่งซื้อ</button>
                            </form>
                        </div>
                    <?php } else { ?>
                        <p>ตะกร้าของคุณว่างเปล่า</p>
                    <?php } ?>
                    <!-- จบการแสดงข้อมูลตะกร้าสินค้า -->
                </div>
            </div>
        </div>
    </div>






</body>

</html>
