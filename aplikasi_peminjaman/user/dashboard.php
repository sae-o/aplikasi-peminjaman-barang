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

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f5f5f5;
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
        .main-content {
            margin-left: 220px;
            width: calc(100% - 220px);
            padding: 20px;
        }
        .header {
            width: 100%;
            background-color: #f4a261;
            text-align: center;
            padding: 20px 0;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header h1 {
            margin: 0;
            font-size: 36px;
            color: #fff;
        }
        .transactions {
            text-align: center;
            margin: 20px;
        }
        .transactions h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        .transactions table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .transactions th, .transactions td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .transactions th {
            font-size: 18px;
            background-color: #f4a261;
            color: #fff;
        }
        .transactions td {
            font-size: 16px;
            background-color: #fff;
        }
        .transactions button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .transactions button:hover {
            background-color: #0056b3;
        }
        .footer {
            width: 100%;
            background-color: #f4a261;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            border-radius: 5px;
            box-shadow: 0 -4px 8px rgba(0,0,0,0.1);
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
    <div class="main-content">
        <div class="header">
            <h1>DASHBOARD</h1>
        </div>
        <div class="transactions">
            <h2>Data Transaksi Sedang Pinjam</h2>
            <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Tgl. Pinjam</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                     <tr>
                                <td><?php echo $row['nama_barang']; ?></td>
                                <td><?php echo $row['tgl_pinjam']; ?></td>
                     </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-data">Tidak ada data peminjaman.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer">
        <!-- <p>&copy; 2024 Peminjaman Barang. All rights reserved.</p> -->
    </div>
</body>
</html>
