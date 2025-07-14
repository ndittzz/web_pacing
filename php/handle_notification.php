<?php
session_start();

if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
    
    // Simpan notifikasi dalam cookie untuk dibaca oleh JavaScript
    setcookie('alert_notification', json_encode($alert), time() + 60, '/');
    
    header("Location: " . $alert['redirect']);
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
?>