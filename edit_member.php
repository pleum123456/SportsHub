<?php
include 'connectlocal.php';
session_start();

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // ดึงข้อมูลสมาชิกจากฐานข้อมูล
    $sql = "SELECT * FROM member WHERE idmember='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // ตรวจสอบว่ามีข้อมูลสมาชิกหรือไม่
    if(!$row) {
        echo "Member not found";
        exit();
    }
} else {
    echo "ID not specified";
    exit();
}

// หากมีการส่งข้อมูลมาจากฟอร์ม
if(isset($_POST['submit'])) {
    // ดึงข้อมูลจากฟอร์ม
    $name = $_POST['name'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];

    // อัปเดตข้อมูลสมาชิก
    $update_sql = "UPDATE member SET namemember='$name', addressmember='$address', telmember='$tel' WHERE idmember='$id'";
    if(mysqli_query($conn, $update_sql)) {
        header("Location: editmember.php");
        exit();
    } else {
        echo "Error updating member: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
        <h2>Edit Member</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['namemember']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" ><?php echo $row['addressmember']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Telephone</label>
                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $row['telmember']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
