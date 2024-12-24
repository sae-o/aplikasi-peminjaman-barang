<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "peminjaman-barang");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan ID peminjaman dari URL
$id_peminjam = $_GET['id'];

// Query untuk mendapatkan data peminjaman berdasarkan ID
$sql = "SELECT * FROM peminjaman WHERE id_peminjam = $id_peminjam";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}

// Menangani update data peminjaman
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $username = $_POST['username'];
    $jenis_barang = $_POST['jenis_barang'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $status_peminjaman = $_POST['status_peminjaman'];
    
    if ($status_peminjaman == 'dikembalikan') { 
        $update_stok_sql = "UPDATE barang SET stok_barang = stok_barang + 1 WHERE nama_barang = '$nama_barang'"; 
        $conn->query($update_stok_sql);}
    $update_sql = "UPDATE peminjaman SET 
                    nama_barang = '$nama_barang', 
                    username = '$username', 
                    jenis_barang = '$jenis_barang', 
                    tgl_pinjam = '$tgl_pinjam', 
                    status_peminjaman = '$status_peminjaman' 
                    WHERE id_peminjam = $id_peminjam";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Data peminjaman berhasil diperbarui!'); window.location.href='data peminjaman.php';</script>";
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Peminjaman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
            background-color: #fdfde3;
        }
        .header {
            background-color: #e67e22;
            color: white;
            padding: 10px;
            text-align: right;
            font-size: 18px;
        }
        .sidebar {
            width: 200px;
            background-color: #fff;
            padding: 20px;
            position: fixed;
            height: 100%;
            border-right: 1px solid #ddd;
        }
        .sidebar a {
            display: block;
            color: black;
            padding: 10px 0;
            text-decoration: none;
            font-size: 18px;
        }
        .sidebar a:hover {
            background-color: #f1f1f1;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        .content h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .content hr {
            border: 0;
            border-top: 1px solid black;
            margin-bottom: 20px;
        }
        .form-container {
            background-color: #f0f8ff;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-container input, .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container .btn-back {
            background-color: #e74c3c;
            color: white;
        }
        .form-container .btn-save {
            background-color: #3498db;
            color: white;
            float: right;
        }
    </style>
</head>
<body>
    <div class="header">
        Hello Admin
    </div>
    <div class="sidebar">
        <a href="index.php">Dashboard</a>
        <a href="../barang/data_barang.php">Data Barang</a>
        <a href="../peminjaman/data peminjaman.php">Peminjaman Barang</a>
        <a href="anggota/anggota.php">Anggota</a>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="content">
        <h1>Edit Peminjaman</h1>
        <hr>
        <div class="form-container">
            <form action="" method="POST">
                <label for="nama-barang">Nama Barang</label>
                <input type="text" id="nama-barang" name="nama_barang" value="<?php echo $row['nama_barang']; ?>">
                
                <label for="nama-peminjam">Nama Peminjam</label>
                <input type="text" id="nama-peminjam" name="username" value="<?php echo $row['username']; ?>">
                
                <label for="jenis-barang">Jenis Barang</label>
                <input type="text" id="jenis-barang" name="jenis_barang" value="<?php echo $row['jenis_barang']; ?>">
                
                <label for="tanggal-pinjam">Tanggal Pinjam</label>
                <input type="text" id="tanggal-pinjam" name="tgl_pinjam" value="<?php echo $row['tgl_pinjam']; ?>">
                
                <label for="status-peminjaman">Status Peminjaman</label>
                <select id="status-peminjaman" name="status_peminjaman">
                    <option value="dipinjam" <?php if ($row['status_peminjaman'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
                    <option value="dikembalikan" <?php if ($row['status_peminjaman'] == 'dikembalikan') echo 'selected'; ?>>Dikembalikan</option>
                </select>
                
                <button type="button" class="btn-back" onclick="window.location.href='data_peminjaman.php'">Back</button>
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
