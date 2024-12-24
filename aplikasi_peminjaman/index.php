<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "peminjaman-barang");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan jumlah anggota 
$sql_anggota = "SELECT COUNT(*) AS jumlah_anggota FROM anggota"; 
$result_anggota = $conn->query($sql_anggota); 
$row_anggota = $result_anggota->fetch_assoc(); 
$jumlah_anggota = $row_anggota['jumlah_anggota']; 

// Query untuk mendapatkan jumlah barang yang sedang dipinjam 
$sql_sedang_pinjam = "SELECT COUNT(*) AS jumlah_sedang_pinjam FROM peminjaman 
WHERE status_peminjaman = 'dipinjam'"; 
$result_sedang_pinjam = $conn->query($sql_sedang_pinjam); 
$row_sedang_pinjam = $result_sedang_pinjam->fetch_assoc(); 
$jumlah_sedang_pinjam = $row_sedang_pinjam['jumlah_sedang_pinjam']; 

// Query untuk mendapatkan jumlah barang yang dikembalikan 
$sql_dikembalikan = "SELECT COUNT(*) AS jumlah_dikembalikan FROM peminjaman WHERE status_peminjaman = 'dikembalikan'";
 $result_dikembalikan = $conn->query($sql_dikembalikan); 
 $row_dikembalikan = $result_dikembalikan->fetch_assoc(); 
 $jumlah_dikembalikan = $row_dikembalikan['jumlah_dikembalikan'];
 
// Query untuk mendapatkan data peminjaman
$sql = "SELECT * FROM peminjaman WHERE status_peminjaman != 'dikembalikan'";
$data_peminjaman = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
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
        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .stat-box {
            background-color: white;
            padding: 20px;
            width: 30%;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .stat-box img {
            width: 50px;
            height: 50px;
        }
        .stat-box h2 {
            margin: 10px 0;
        }
        .data-section {
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
        <a href="index.php">Dashboard</a>
        <a href="barang/data_barang.php">Data Barang</a>
        <a href="peminjaman/data peminjaman.php">Peminjaman Barang</a>
        <a href="anggota/anggota.php">Anggota</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <div class="header">
            <h1>Dashboard</h1>
            <span>Hello Admin</span>
        </div>
        <div class="main-content">
            <div class="stats">
                <div class="stat-box">
                <img alt="Icon of a person" height="50" src="https://storage.googleapis.com/a1aa/image/tna7JwC2KobxPxX3sDQgWOt4DFvH2lZ1RC5g2oDYwuUtnEfJA.jpg" width="50"/> 
                <h2>Anggota</h2> <p><?php echo $jumlah_anggota;
                ?></p>
             </div>
             <div class="stat-box">
                 <img alt="Icon of a cloud with a checkmark" height="50" src="https://storage.googleapis.com/a1aa/image/GDanN7Xf9j0HE6lHgH2RxUGI08BdHydJPnZMgWyrskbcPJeTA.jpg" width="50"/>
                <h2>Sedang Pinjam</h2> <p><?php echo $jumlah_sedang_pinjam; 
                ?></p> 
            </div> 
            <div class="stat-box">
                 <img alt="Icon of a laptop" height="50" src="https://storage.googleapis.com/a1aa/image/eOYlbzeUMSnHE0ysnR3fbf6lNHB6c5YPLTw7yfYDrfu5tnEfJA.jpg" width="50"/> 
                 <h2>Pengembalian</h2> 
                 <p><?php echo $jumlah_dikembalikan;
                 ?></p>
                </div>
            </div>
            <div class="data-section">
                <h2>Data Transaksi Sedang Pinjam</h2>
                <?php if ($data_peminjaman->num_rows > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>peminjam</th>
                                <th>Tgl. Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $data_peminjaman->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['nama_barang']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
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
    </div>
</body>
</html>
