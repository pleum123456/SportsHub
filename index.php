<?php
include 'connectlocal.php';
//include 'connectserver.php';
session_start();
if (isset($_POST) && !empty($_POST)) {
    $user = &$_POST["user"];
    $pass = &$_POST["pass"];
    $sql = "SELECT * FROM member WHERE namemember='$user'AND telmember ='$pass'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if ($num > 0) {
        $_SESSION["idmember"] = $row["idmember"];
        $_SESSION["namemember"] = $row["namemember"];
        $_SESSION["addressmember"] = $row["addressmember"];
        $_SESSION[" "] = $row["telmember"];
        header("location:member1.php");
    } else {
        $message = "Who are you? Try again";
        echo "<script type='text/javascript'>alert('$message')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>000-SPORTS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: none;
            background-image: url('picpro/bg/289380.jpg');
            background-size: cover;
            color: #000000;
            text-align: center;
            animation: changeColor 5s linear infinite;
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
            max-width: 20%;
            height: auto;
            border-radius: 150%;
            margin: 50px auto;
            display: inline-block;
        }

        h2 {
            font-family: 'Garamond', sans-serif;
            background: linear-gradient(to right, #000000, #ff0000, #ff0000, #ff0000, #000000);
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
            color: #000000;
            display: flex;
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
            /* เปลี่ยนสีเมื่อ hover */
            transform: scale(1.1);
            /* ปรับขนาดเมื่อ hover */
        }
    </style>
    <style>
        .btn-admin {
            color: #ffffff;
            /* กำหนดสีตัวอักษรเป็นสีขาว */
            transition: color 0.3s, background-color 0.3s, transform 0.3s;
        }

        .btn-admin:hover {
            color: #ffffff;
            /* กำหนดสีตัวอักษรเป็นสีดำ เมื่อ hover */
            background-color: #ff0000;
            /* กำหนดสีพื้นหลังเป็นสีแดง เมื่อ hover */
            transform: scale(1.1);
            /* ปรับขนาดเมื่อ hover */
        }
    </style>
</head>

<body>

    <div class="container mt-3">
        <div class="logo-container">
            <img src="picpro/LOGO.png" alt="Logo" class="logo">
            <h2>SPORTS HUB</h2>
        </div>

        <div class="mb-3 mt-3">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="email" class="form-label">User :</label>
                <input type="text" class="form-control" id="" placeholder="Enter user name" name="user" required>
                <br>
                <label for="pwd" class="form-label">Password :</label>
                <input type="password" class="form-control" id="" placeholder="Enter password" name="pass" required>
        </div>
        <a href="no000login.php" class="btn btn-admin">Admin</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;
        <button type="submit" class="btn btn-primary">Login</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;
        <a href="register.php" class="btn btn-primary">Register</a>

        </form>

    </div>
</body>

</html>