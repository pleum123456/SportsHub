<?php
include 'connectlocal.php';
//include 'connectserver.php';
session_start();

if (isset($_POST) && !empty($_POST)) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    // ตรวจสอบว่ามี user นี้ในฐานข้อมูลหรือไม่
    $checkUserSql = "SELECT * FROM member WHERE namemember='$user' AND telmember ='$pass'";
    $checkUserResult = mysqli_query($conn, $checkUserSql);
    $num = mysqli_num_rows($checkUserResult);

    if ($num > 0) {
        // ถ้ามี user อยู่แล้วในฐานข้อมูล
        header("location:regis.php"); // ส่งกลับไปหน้า Register
    } else {
        // ถ้ายังไม่มี user ในฐานข้อมูล
        $insertSql = "INSERT INTO member (namemember, telmember) VALUES ('$user', '$pass')";
        $insertResult = mysqli_query($conn, $insertSql);

        if ($insertResult) {
            // บันทึกสำเร็จ
            $_SESSION["idmember"] = mysqli_insert_id($conn); // รหัสสมาชิกที่เพิ่มล่าสุด
            $_SESSION["namemember"] = $user;
            $_SESSION["telmember"] = $pass;
            header("location:member1.php"); // ส่งไปที่หน้า Member
        } else {
            // บันทึกไม่สำเร็จ
            header("location:regis.php"); // ส่งกลับไปหน้า Register
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {

            background: none;
            color: #000000;
            text-align: center;
            animation: changeColor 10s linear infinite;

        }

        @keyframes changeColor {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        .container {
            animation: fadeIn 1.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo {
            max-width: 15%;
            height: auto;
            border-radius: 150%;
            margin: 50px auto;
            display: inline-block;
        }

        h2 {
            font-family: 'Garamond', sans-serif;
            /* background: linear-gradient(to right, #ff6f00, #ff8f00, #ffa000, #ffb300, #ffc107); */
            background: linear-gradient(to right, #ffffff, #ffffff, #ffffff, #ffffff, #ffffff);
            -webkit-background-clip: text;
            color: transparent;
            animation: changeTextColor 10s linear infinite;
            margin: 10px 0;
        }

        @keyframes changeTextColor {

            0%,
            100% {
                background-position: 0% 50%;
            }

            25% {
                background-position: 25% 50%;
            }

            50% {
                background-position: 50% 50%;
            }

            75% {
                background-position: 75% 50%;
            }
        }

        .mb-3 {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .form-label {
            width: 100px;
            margin-right: 20px;
            text-align: right;
            font-family: 'Times New Roman', sans-serif;
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
        }

        .form-control {
            flex: 1;
            border-radius: 10px;
            margin-right: 20px;
            padding: 10px;
        }

        .btn {
            background-color: #000000;
            border: 2px solid #ffffff;
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #00FFFF;
            transform: scale(1.1);
        }

        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            /* Set the width to 100% of the viewport */
            height: 100%;
            /* Set the height to 100% of the viewport */
            overflow: hidden;
            z-index: -1;
        }

        .video {
            width: 100%;
            /* Make the video width 100% of its container */
            height: 100%;
            /* Make the video height 100% of its container */
            object-fit: cover;
            /* Maintain aspect ratio while covering the container */
        }

        .btn-back {
            color: #ffffff;
            /* กำหนดสีตัวอักษรเป็นสีขาว */
            transition: color 0.3s, background-color 0.3s, transform 0.3s;
        }

        .btn-back:hover {
            color: #ffffff;
            /* กำหนดสีตัวอักษรเป็นสีดำ เมื่อ hover */
            background-color: #ff0000;
            /* กำหนดสีพื้นหลังเป็นสีแดง เมื่อ hover */
            transform: scale(1.1);
            /* ปรับขนาดเมื่อ hover */
        }
    </style>
    <title>Register Page</title>
</head>

<body>
    <!-- Background Video -->
    <div class="video-container">
        <video autoplay loop muted class="video">
            <source src="video/NIKE.mp4" type="video/mp4">
            Provide fallback content here
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="container mt-1">
        <div class="logo-container">
            <img src="picpro/LOGO.png" alt="Logo" class="logo">
            <h2>Register</h2>
        </div>

        <div class="mb-3 mt-3">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="email" class="form-label">User :</label>
                <input type="text" class="form-control" id="" placeholder="Enter user name" name="user" required>
                <br>
                <label for="pass" class="form-label">Password :</label>
                <input type="password" class="form-control" id="" placeholder="Enter password" name="pass" required>
                <br>
                <label for="pass" class="form-label">Confirm Password :</label>
                <input type="password" class="form-control" id="" placeholder="Confirm password" name="confirm_pswd" required>
        </div>
        <a href="index1.php" class="btn btn-back">Back</a>&nbsp;&nbsp;
        <button type="submit" class="btn btn-primary">Register</button>&nbsp;&nbsp;
        </form>
    </div>
</body>

</html>