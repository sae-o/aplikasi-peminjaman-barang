<?php 
session_start();

// require 'functions.php';
$conn = mysqli_connect("localhost",  "root" , "" , "peminjaman-barang" ); 
if (isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query( $conn, "SELECT * FROM anggota WHERE username = '$username'");

    /// cek username
    if (mysqli_num_rows($result) > 0) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["role"] = $row["role"];
            $_SESSION['username'] = $username;
            // header("Location: ../peminjaman.php");

            if ($row["role"] == "admin") {
                echo "<script> 
                alert('Selamat Anda berhasil login sebagai Admin');
                window.location.href = 'index.php';
                </script>";
            // echo "<script>
            // alert('Selamat anda berhasil login');
            // window.location.href = 'index.html';
            // </script>";
            } else {
                echo "<script> 
                alert('Selamat Anda berhasil login sebagai User'); 
                window.location.href = 'user/dashboard.php'; 
                </script>";
              
        }
        exit;
    } else 
    { echo "<script> 
        alert('Password salah'); 
        </script>"; }

    } else {
        echo "<script>
        alert('Username tidak ditemukan');
        </script>";
    }
    
    $erorr = true;
}
?>
<html>
 <head>
  <title>
   Login
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #0A4D4D;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 100%;
            height: 100%;
            background-color: #0A4D4D;
            display: flex;
            overflow: hidden;
        }
        .left {
            width: 50%;
            padding: 40px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .left img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .left h1 {
            margin: 0;
            font-size: 36px;
        }
        .left input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-bottom: 2px solid #FFC107;
            background: none;
            color: white;
            font-size: 16px;
        }
        .left input:focus {
            outline: none;
        }
        .left a {
            color: #FFC107;
            text-decoration: none;
            font-size: 14px;
            align-self: flex-end;
        }
        .left button {
            width: 100%;
            padding: 15px;
            margin: 20px 0;
            border: none;
            background-color: #FFC107;
            color: #0A4D4D;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .left .signup {
            background: none;
            color: #FFC107;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .right {
            width: 50%;
            background-color: #FFC107;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 100%);
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .left, .right {
                width: 100%;
            }
            .right {
                clip-path: none;
                height: 200px;
            }
        }
  </style>
 </head>
 <body>
  <div class="container">
   <div class="left">
    <img alt="User avatar" height="100" src="https://storage.googleapis.com/a1aa/image/xfssLTfLVGgkh0cyU67NSaMMjR2HAlaoE3pCfeOXhmy69fafE.jpg" width="100"/>
    <h1>
     LOGIN
    </h1>
    <form action="" method="POST">
    <input placeholder="username" type="text" name="username" id="username" required/>
    <input placeholder="password" type="password" name="password" id="password" required"/>
    <a href="#">
     Forgot Password?
    </a>
    <?php if( Isset($erorr)) : ?>
        <div class="pesan-erorr">
                <P style="color : red; font-style : italic; "> username/password salah </P>
        </div>
        
    <?php  endif; ?>
    <button type="submit" name="login">LOGIN</button>
    </form>
    <!-- <button class="signup"> <a href="signup.php">SIGNUP</a>
    </button> -->
   </div>
   <div class="right">
   </div>
  </div>
 </body>
</html>