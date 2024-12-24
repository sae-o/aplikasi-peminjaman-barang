<!DOCTYPE html>
<html>
<head>
    <title>Peminjaman</title>
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
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 220px;
        }
        .header {
            background-color: #f4a261;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 36px;
            font-weight: bold;
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
        .item img {
            width: 150px;
            height: 150px;
            background-color: #ccc;
            margin-bottom: 10px;
        }
        button.button-proses {
            background-color: #3498db;
            color: #fff; border: none; 
            padding: 5px 10px; 
            cursor: pointer; 
            text-decoration: none;
            border-radius: 5px;
        }
        button.button-proses:hover { background-color: #2980b9; }
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
            PEMINJAMAN
        </div>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Memulai sesi
                    session_start();

                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "peminjaman-barang");
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Query untuk mendapatkan data barang
                    $sql = "SELECT * FROM barang";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Looping untuk menampilkan data barang
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td><img src="../uploads/' . $row['foto_barang'] . '" alt="' . $row['nama_barang'] . '" width="150" height="150"></td>';
                            echo '<td>' . $row['nama_barang'] . '</td>';
                            echo '<td>' . $row['jenis_barang'] . '</td>';
                            echo '<td>' . $row['stok_barang'] . '</td>';
                            echo '<td><form action="data pinjam.php" method="POST">';
                            echo '<input type="hidden" name="nama_barang" value="' . $row['nama_barang'] . '">';
                            echo '<input type="hidden" name="jenis_barang" value="' . $row['jenis_barang'] . '">';
                            echo '<input type="hidden" name="tgl_pinjam" value="' . date('Y-m-d') . '">';
                            echo '<button type="submit" class="button-proses">Pinjam</button>';
                            echo '</form></td>';
                            echo '</tr>';
                        }
                    } else {
                        // Pesan jika tidak ada data barang
                        echo "<tr><td colspan='5'>Tidak ada data barang.</td></tr>";
                    }

                    // Tutup koneksi
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="footer">
        </div>
    </div>
</body>
</html>
