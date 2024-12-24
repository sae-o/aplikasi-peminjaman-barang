<?php
require '../functions.php';

// Query untuk mendapatkan data barang
$sql = "SELECT * FROM barang";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
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
        .main-content {
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
        .content h1 {
            font-size: 32px;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            display: inline-block;
        }
        .add-button {
            float: right;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            margin-top: 11px;
            /* margin-bottom: 5px; */
            border-radius: 5px;
            display: flex;
            align-items: center;
        }
        .add-button i {
            margin-right: 5px;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            width: calc(50% - 20px);
            box-sizing: border-box;
        }
        .card h2 {
            font-size: 24px;
            margin: 10px 0;
        }
        .card p {
            font-size: 18px;
            margin: 5px 0;
        }
        .card .actions {
            margin-top: 10px;
        }
        .card .actions a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: #fff;
            margin-right: 10px;
        }
        .card .actions .edit {
            background-color: #3498db;
        }
        .card .actions .delete {
            background-color: #e74c3c;
        }
        @media (max-width: 768px) {
            .card {
                width: 100%;
            }
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
    <div class="main-content">
        <div class="header">
            <h1>Data Barang</h1>
            <span>Hello Admin</span>  
            

        </div>
        <div class="content">
            <h1>     </h1>
            
            <a href="tambah_barang.php" class="add-button"><i class="fas fa-plus"></i> Tambah Barang</a>
            <div class="card-container">
                <?php
                if ($result->num_rows > 0) {
                    // Looping untuk menampilkan data barang
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card">';
                        echo '<h2><img src="uploads/' . $row['foto_barang'] . '" alt="' . $row['nama_barang'] . '" width="100"></h2>';
                        echo '<p><strong>Nama Barang:</strong> ' . $row['nama_barang'] . '</p>';
                        echo '<p><strong>Jenis Barang:</strong> ' . $row['jenis_barang'] . '</p>';
                        echo '<p><strong>Stok:</strong> ' . $row['stok_barang'] . '</p>';
                        echo '<div class="actions">';
                        echo '<a href="edit_barang.php?id=' . $row['id'] . '" class="edit"><i class="fas fa-edit"></i> Edit</a>';
                        echo '<a href="delete.php?id=' . $row['id'] . '" class="delete"><i class="fas fa-trash"></i> Hapus</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // Pesan jika tidak ada data barang
                    echo "<p>Tidak ada data barang.</p>";
                }

                // Tutup koneksi
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
