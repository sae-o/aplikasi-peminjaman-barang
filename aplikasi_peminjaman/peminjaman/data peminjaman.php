<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "peminjaman-barang");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data peminjaman
$sql = "SELECT * FROM peminjaman WHERE status_peminjaman != 'dikembalikan'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            height: 100vh;
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
            background-color: #fbbd5c;
            color: #000;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #555;
        }
        .edit-button { 
            background-color: #3498db;
            color: #fff; border: none; 
            padding: 5px 10px; 
            cursor: pointer; 
            text-decoration: none;
            border-radius: 5px; 
            } 
        .edit-button:hover { background-color: #2980b9; }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Dashboard</a>
        <a href="../barang/data_barang.php">Data Barang</a>
        <a href="../peminjaman/data peminjaman.php">Peminjaman Barang</a>
        <a href="../anggota/anggota.php">Anggota</a>
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
                            <th>No </th>
                            <th>Nama Barang</th>
                            <th>Nama Peminjam</th>
                            <th>Jenis Barang</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id_peminjam']; ?></td>
                                <td><?php echo $row['nama_barang']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['jenis_barang']; ?></td>
                                <td><?php echo $row['tgl_pinjam']; ?></td>
                                <td><a href="edit peminjaman.php?id=<?php echo $row['id_peminjam']; ?>" class="edit-button">Edit</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-data">Tidak ada data peminjaman.</p>
            <?php endif; ?>
            <?php $conn->close(); ?>
        </div>
    </div>
</body>
</html>
