<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "peminjaman-barang");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan ID barang dari URL
$id = $_GET['id'];

// Query untuk menghapus data barang berdasarkan ID
$sql = "DELETE FROM barang WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil dihapus!'); window.location.href='data_barang.php';</script>";
} else {
    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.location.href='data_barang.php';</script>";
}

$conn->close();
?>
