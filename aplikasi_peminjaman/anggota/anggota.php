<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "peminjaman-barang");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data anggota
$sql = "SELECT id_anggota, username, password, bidang, foto_anggota FROM anggota";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Anggota</title>
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
        .title {
            font-size: 36px;
            margin: 20px 0;
            border-bottom: 1px solid black;
            padding-bottom: 10px;
        }
        .button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            font-size: 16px;
        }
        .button i {
            margin-right: 10px;
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
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Dashboard</a>
        <a href="../barang/data_barang.php">Data Barang</a>
        <a href="../peminjaman/data peminjaman.php">Peminjaman Barang</a>
        <a href="anggota.php">Anggota</a>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="content">
        <div class="header">
            <h1>Anggota</h1>
        </div>
        <div class="container">
            <!-- <div class="title">
            
            </div> -->
            <a href="tambah anggota.php" class="button"><i class="fas fa-plus"></i>Tambah Anggota</a>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Bidang</th>
                        <th>Foto</th>
                        <!-- <th>aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Tampilkan data anggota
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id_anggota"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                            echo "<td>" . $row["bidang"] . "</td>";
                            echo "<td><img src='upload/" . $row["foto_anggota"] . "' alt='Foto' width='50'></td>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data anggota</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
