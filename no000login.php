<?php
    include'connectlocal.php';
    //include 'connectserver.php';
    if(isset($_POST) && !empty($_POST)){
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $sql="SELECT * FROM admin
        WHERE useradmin='$user' AND passadmin='$pass'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $num = mysqli_num_rows($result);
        if($num > 0){
            //echo "ถูกต้อง";
            header("location:admin.php");
        }else{
            //echo "ไม่ถูกต้อง";{
            echo"<script type='text/javascript'>alert('ลองใหม่อีกครั้ง');</script>";  
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
    <title>Admin Login</title>
    <style>
        body {
            background:none;
            background-image: url('picpro/bg/bas2.jpg');
            color: #000000;
            text-align: center;
            animation: changeColor 15s linear infinite;
        }

        @keyframes changeColor {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        .center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .logo {
            max-width: 20%;
            height: auto;
            border-radius: 150%;
            margin-bottom: 20px;
            display: inline-block;  
        }

        h2 {
            font-family: 'Garamond', sans-serif;
            background: linear-gradient(to right, #ff0000, #FC6600, #f5a400, #FC6600, #ff0000);
            -webkit-background-clip: text;
            color: transparent;
            animation: changeTextColor 10s linear infinite;
            margin: 10px 0;
        }

        @keyframes changeTextColor {
            0%, 100% {
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
        .btn-back {
            color: #ffffff; /* กำหนดสีตัวอักษรเป็นสีขาว */
            transition: color 0.3s, background-color 0.3s, transform 0.3s;
        }
        .btn-back:hover {
            color: #ffffff; /* กำหนดสีตัวอักษรเป็นสีดำ เมื่อ hover */
            background-color: #ff0000; /* กำหนดสีพื้นหลังเป็นสีแดง เมื่อ hover */
            transform: scale(1.1); /* ปรับขนาดเมื่อ hover */
        }
    </style>
</head>
<body>

    <div class="center">
        <img src="picpro/LOGO.png" alt="Admin Logo" class="logo">
        <h2>Admin Login</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">User:</label>
                <input type="text" class="form-control" id="" placeholder="Enter user" name="user">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="" placeholder="Enter password" name="pass">
            </div>
            <a href="index1.php" class="btn btn-back">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>