<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $bidang = $_POST['bidang'];
    $foto_anggota = $_FILES['foto']['name'];
    
    // Upload Foto
    $target_dir = "upload/"; 
    $target_file = $target_dir . basename($foto_anggota); 
    if (move_uploaded_file($_FILES['foto']['tmp_name'],$target_file)) 
    { echo "File berhasil diunggah.";
     } 
     else 
     { echo "Terjadi kesalahan saat mengunggah file."; }
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "peminjaman-barang");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO anggota (username, password, bidang, foto_anggota) 
            VALUES ('$username', '$hashed_password', '$bidang', '$foto_anggota')";
    
    if ($conn->query($sql) === TRUE) {
     echo "<script>alert('anggota berhasil ditambahkan!');</script>";
    }
     else
    { echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>"; 
    }
    
    $conn->close();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f5f5f5;
        }
        .sidebar {
            width: 20%;
            background-color: #fff;
            padding: 20px;
            box-sizing: border-box;
            border-right: 1px solid #ddd;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar a {
            display: block;
            color: black;
            text-decoration: none;
            margin: 20px 0;
            font-size: 18px;
        }
        .sidebar a:hover {
            color: #fbbd5c;
        }
        .content {
            flex: 1;
            background-color: #fdf6d1;
            padding: 20px;
            box-sizing: border-box;
        }
        .header {
            background-color: #fbbd5c;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 36px;
            color: #000;
        }
        .form-container {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .form-container hr {
            border: 0;
            border-top: 1px solid #000;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], 
        .form-group input[type="password"],
        .form-group input[type="file"],
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            background-color: #e0e0e0;
        }
        .form-group-inline {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }
        .form-group-inline .form-group {
            flex: 1;
            margin-bottom: 0;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .form-actions button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .form-actions .back-button {
            background-color: #e67e22;
            color: #fff;
        }
        .form-actions .add-button {
            background-color: #3498db;
            color: #fff;
            display: flex;
            align-items: center;
        }
        .form-actions .add-button i {
            margin-right: 5px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                box-shadow: none;
            }
            .content {
                width: 100%;
            }
            .form-group-inline {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Dashboard</a>
        <a href="../data_barang.php">Data Barang</a>
        <a href="../peminjaman/data peminjaman.php">Peminjaman Barang</a>
        <a href="anggota.php">Anggota</a>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="content">
        <div class="header">
            <h1>Tambah Anggota</h1>
        </div>
        <div class="form-container">
            <h1>Tambah Anggota</h1>
            <hr>
            <form action="tambah anggota.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama :</label>
                    <input type="text" id="nama" name="username" placeholder="nama anggota...">
                </div>
                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" id="password" name="password" placeholder="password...">
                </div>
                <div class="form-group">
                    <label for="unit">Unit Bidang :</label>
                    <input type="text" id="unit" name="bidang" placeholder="bidang...">
                </div>
                <div class="form-group">
                    <label for="foto">Foto :</label>
                    <input type="file" name="foto" id="foto">
                </div>
                <div class="form-actions">
                    <button type="button" class="back-button">Back</button>
                    <button type="submit" class="add-button"><i class="fas fa-plus"></i> Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
