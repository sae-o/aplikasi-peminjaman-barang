<?php
session_start();

$conn = new mysqli("localhost", "root", "", "peminjaman-barang");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $jenis_barang = $_POST['jenis_barang'];
    $tgl_pinjam = date('Y-m-d');
    $nama_peminjam = $_SESSION['username']; // Nama peminjam dari sesi login

    $sql = "SELECT * FROM peminjaman WHERE status_peminjaman != 'dikembalikan'";
    $result = $conn->query($sql);

    // Mengurangi stok barang 
    $update_stok_sql = "UPDATE barang SET stok_barang = stok_barang - 1 WHERE nama_barang = '$nama_barang'"; 
    $conn->query($update_stok_sql);

    $sql = "SELECT * FROM peminjaman WHERE status_peminjaman != 'dikembalikan'";
    $result = $conn->query($sql);

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data peminjaman berhasil ditambahkan!'); window.location.href='data pinjam.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}
$nama_peminjam = $_SESSION['username']; 
$sql = "SELECT * FROM peminjaman WHERE username = '$nama_peminjam' AND status_peminjaman != 'dikembalikan'"; 
$result = $conn->query($sql);
 ?>


<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
        }
        .sidebar {
            width: 200px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            height: 100vh;
            position: fixed;
        }
        .sidebar a {
            display: block;
            margin: 20px 0;
            text-decoration: none;
            color: #000;
            font-size: 18px;
        }
        .sidebar a:hover {
            color: #f4a261;
        }
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 220px;
        }
        .header {
            background-color: #f4a261;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 36px;
            color: #fff;
        }
        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4a261;
            color: #000;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #555;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }
        .buttons .back-btn {
            background-color: #5cb85c;
        }
        .footer {
            background-color: #f4a261;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="peminjaman.php">Pinjam Barang</a>
        <a href="data pinjam.php">daftar pinjam</a>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="content">
        <div class="header">
            <h1>Data Peminjaman</h1>
        </div>
        <div class="container">
            <h2>DATA PEMINJAMAN</h2>
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Nama Peminjam</th>
                            <th>Jenis Barang</th>
                            <th>Tanggal Pinjam</th>
                            <th>status </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['nama_barang']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['jenis_barang']; ?></td>
                                <td><?php echo $row['tgl_pinjam']; ?></td>
                                <td><?php echo $row['status_peminjaman']; ?></td>
                                
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-data">Tidak ada data peminjaman.</p>
            <?php endif; ?>
            <?php $conn->close(); ?>
            <div class="buttons">
                <button class="back-btn">Back</button>
            </div>
           
        </div> <div class="footer">
        </div>
    </div>
</body>
</html>
