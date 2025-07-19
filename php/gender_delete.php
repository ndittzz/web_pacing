<?php
include 'db.php'; // koneksi database

// Hapus data jika ada request delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if (!$konek->query("DELETE FROM penduduk_kelamin WHERE id=$id")) {
        $error = 'Gagal menghapus data: ' . $konek->error;
    } else {
        header('Location: ../admin/penduduk.php');
        exit();
    }
}
?>
