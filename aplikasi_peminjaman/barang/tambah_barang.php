<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jenis_barang = $_POST['jenis_barang'];
    $stok_barang = $_POST['stok_barang'];
    $foto_barang = $_FILES['foto']['name'];
    
    // Upload Foto
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto_barang);
    move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
    
    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "peminjaman-barang");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO barang (kode_barang, nama_barang, jenis_barang, stok_barang, foto_barang) 
            VALUES ('$kode_barang', '$nama_barang', '$jenis_barang', $stok_barang, '$foto_barang')";
    
    if ($conn->query($sql) === TRUE) {
       
         echo "<script>alert('Data berhasil ditambahkan!');</script>";
         }
          else
         { echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>"; 
    }
    
    $conn->close();
}
?>

<html>
<head>
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 200px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar a {
            display: block;
            color: #000;
            text-decoration: none;
            margin: 20px 0;
            font-size: 18px;
        }
        .content {
            flex: 1;
            background-color: #fdf5d6;
            padding: 20px;
            position: relative;
        }
        .header {
            background-color: #e67e22;
            color: #fff;
            padding: 10px 20px;
            text-align: right;
        }
        .form-container {
            margin-top: 20px;
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
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group .file-info {
            display: inline-block;
            margin-left: 10px;
            font-size: 16px;
            color: #888;
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
            border-radius: 4px;
            cursor: pointer;
        }
        .form-actions .back-button {
            background-color: #e67e22;
            color: #fff;
        }
        .form-actions .submit-button {
            background-color: #3498db;
            color: #fff;
            display: flex;
            align-items: center;
        }
        .form-actions .submit-button i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Dashboard</a>
        <a href="data_barang.php">Data Barang</a>
        <a href="../peminjaman/data peminjaman.php">Peminjaman Barang</a>
        <a href="../anggota/anggota.php">Anggota</a>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="content">
        <div class="header">
            Hello Admin
        </div>
        <div class="form-container">
            <h1>Tambah Barang</h1>
            <hr>
            <form action="tambah_barang.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="kode-barang">Kode Barang :</label>
        <input type="text" id="kode-barang" name="kode_barang" placeholder="Kode Barang...">
    </div>
    <div class="form-group">
        <label for="nama-barang">Nama Barang :</label>
        <input type="text" id="nama-barang" name="nama_barang" placeholder="Nama Barang...">
    </div>
    <div class="form-group">
        <label for="jenis-barang">Jenis Barang :</label>
        <input type="text" id="jenis-barang" name="jenis_barang" placeholder="Jenis Barang...">
    </div>
    <div class="form-group">
        <label for="stok-barang">Stok Barang :</label>
        <input type="text" id="stok-barang" name="stok_barang" placeholder="Stok Barang...">
    </div>
    <div class="form-group">
        <label for="foto">Foto :</label>
        <input type="file" id="foto" name="foto">
    </div>
    <div class="form-actions">
        <button type="button" class="back-button">Back</button>
        <button type="submit" class="submit-button"><i class="fas fa-plus"></i> Tambah Data</button>
    </div>
</form>
            </form>
            </div>
        </div>
    </div>
</body>
</html>