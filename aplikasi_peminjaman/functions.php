<?php
 $conn = mysqli_connect("localhost",  "root" , "" , "peminjaman-barang" ); 
function signup($data): bool|int|string {
   global $conn; 

 
   $username = strtolower ( stripslashes( $data["username"]));
   $password = mysqli_real_escape_string(  $conn,  $data["password"]);
//    $email = ($data["email"]);


    //cek username sudah ada / tidak
    //  $result = mysqli_query( $conn, "SELECT username FROM anggota WHERE username = '$username'");

    //  if(mysqli_fetch_assoc( $result)){
    //     echo "<script>
    //     alert('username sudah terdaftar!')
    //     </script>";
    //     return false;
    //  }

    //   $result = mysqli_query( $conn, "SELECT email FROM anggota WHERE  = '$email'");

    //  if(mysqli_fetch_assoc( $result)){
    //     echo "<script>
    //     alert('email sudah terdaftar!')
    //     </script>";
    //     return false;
    //  }

    //enkripsi password
    $password = password_hash( $password, PASSWORD_DEFAULT);


    //tambahkan user baru ke database
    // mysqli_query($conn,  "INSERT INTO users VALUES('', '$username', '$password','$email')");

     return mysqli_affected_rows($conn);
}
function loginAdmin($username, $password): bool {
   global $conn;

   // Query untuk memeriksa username dan memastikan role adalah admin
   $result = mysqli_query($conn, "SELECT * FROM admins WHERE username = '$username' AND role = 'admin'");

   // Cek apakah username ditemukan dan role adalah admin
   if (mysqli_num_rows($result) > 0) {
       $row = mysqli_fetch_assoc($result);

       // Verifikasi password
       if (password_verify($password, $row["password"])) {
           // Set session
           session_start();
           $_SESSION["login"] = true;
           $_SESSION["role"] = $row["role"];
           $_SESSION["username"] = $row["username"];

           return true;
       } 
       else {
           echo "<script>
         //   alert('Password salah!');
           window.location.href = 'index.html';
           </script>";
           return false;
       }
   } else {
       echo "<script>
       alert('Username tidak ditemukan atau Anda bukan admin!');
       </script>";
       return false;
   }
}
?>
