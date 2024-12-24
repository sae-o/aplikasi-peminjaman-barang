<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "peminjaman-barang");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan username anggota dari URL
$username = $_GET['username'];

// Query untuk menghapus data anggota berdasarkan username
$sql = "DELETE FROM anggota WHERE username = '$username'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data anggota berhasil dihapus!'); window.location.href='anggota.php';</script>";
} else {
    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.location.href='anggota.php';</script>";
}

$conn->close();
?>
