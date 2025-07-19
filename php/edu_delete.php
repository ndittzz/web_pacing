<?php
include 'db.php'; // koneksi database

// Hapus data jika ada parameter id
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (!$konek->query("DELETE FROM penduduk_pendidikan WHERE id=$id")) {
        echo 'Gagal menghapus data: ' . $konek->error;
    } else {
        header('Location: ../admin/penduduk.php');
        exit();
    }
}
?>
