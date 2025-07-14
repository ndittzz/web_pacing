<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:../index.php?pesan=belum_login");
}
?>
<html>

<head>
    <title>Halaman Session</title>
</head>

<body>
    <?php
    echo $_SESSION['username'];
    echo $_SESSION['id_admin'];
    ?>
    <br>
    <a href="logout.php">Logout</a>
</body>

</html>