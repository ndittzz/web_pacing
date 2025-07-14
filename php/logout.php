<?php
// di logout.php
session_start();

$_SESSION['alert'] = [
    'type' => 'success',
    'title' => 'Logout Berhasil',
    'text' => 'Anda telah keluar dari sistem',
    'redirect' => '../index.php'
];

session_destroy();
header("Location: ../php/handle_notification.php");
exit();
