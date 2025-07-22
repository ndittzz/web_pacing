<?php
session_start();

include "../php/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = new mysqli('localhost', 'root', '', 'desa_pacing');
    if ($query->connect_error) {
        die("Connection failed: " . $query->connect_error);
    }

    $username = $query->real_escape_string($_POST['username']);
    $password = md5($_POST['password']); // Hash MD5

    $stmt = $query->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $_SESSION['username'] = $username;
        $_SESSION['id_admin'] = $row['id_admin'];
        $_SESSION['status'] = "login";
        
        // Set session untuk notifikasi
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Login Berhasil',
            'text' => 'Selamat datang, ' . $username,
            'redirect' => '../admin/dashboard.php'
        ];
        
        header("Location: ../php/handle_notification.php");
        exit();
    } else {
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Login Gagal',
            'text' => 'Username atau password salah',
            'redirect' => '../admin/login.php'
        ];
        
        header("Location: ../php/handle_notification.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin - Desa Pacing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    
    <link href="../css/style.css" rel="stylesheet" />
    <link rel="icon" href="../assets/klaten-removebg.png" type="image/png">
    <style>
      * Animasi untuk popup */
      .swal2-popup {
        animation: fadeIn 0.3s;
      }
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
      }
      body {
        font-family: "Inter", sans-serif;
      }
    </style>
  </head>
  <body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md mx-auto bg-white rounded-xl shadow-lg p-8">
      <div class="flex flex-col items-center mb-6">
        <img
          src="../assets/klaten-removebg.png"
          alt="Logo Desa Pacing"
          class="w-12 h-12 rounded-full mb-2"
        />
        <h1 class="text-2xl font-bold text-red-800 mb-1">Login Admin</h1>
        <span class="text-gray-500 text-sm">Pemerintah Desa Pacing</span>
      </div>
      <form autocomplete="off" id="loginForm" method="POST" action="">
        <div class="mb-4">
          <label
            for="username"
            class="block text-sm font-semibold text-gray-700 mb-1"
            >Username</label
          >
          <input
            id="username"
            name="username"
            type="text"
            required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-700"
            placeholder="Masukkan username"
          />
        </div>
        <div class="mb-6">
          <label
            for="password"
            class="block text-sm font-semibold text-gray-700 mb-1"
            >Password</label
          >
          <input
            id="password"
            name="password"
            type="password"
            required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-700"
            placeholder="Masukkan password"
          />
        </div>
        <button
          type="submit"
          value="LOGIN"
          class="w-full py-2 bg-red-700 text-white font-semibold rounded-md hover:bg-red-800 transition"
        >
          Login
        </button>
      </form>
      <div class="mt-6 text-center">
        <a href="../index.php" class="text-sm text-red-700 hover:underline"
          >&larr; Kembali ke Beranda</a
        >
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Cek notifikasi dari cookie
        if (document.cookie.includes('alert_notification')) {
            const cookieValue = document.cookie
                .split('; ')
                .find(row => row.startsWith('alert_notification='))
                .split('=')[1];
                
            const alertData = JSON.parse(decodeURIComponent(cookieValue));
            
            // Hapus cookie
            document.cookie = 'alert_notification=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            
            Swal.fire({
                icon: alertData.type,
                title: alertData.title,
                text: alertData.text,
                showConfirmButton: alertData.type === 'error',
                timer: alertData.type === 'success' ? 2000 : undefined,
                willClose: () => {
                    if (alertData.type === 'success') {
                        window.location.href = alertData.redirect;
                    }
                }
            });
        }
        
        // Untuk logout notification
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('pesan') === 'logout') {
            Swal.fire({
                icon: 'success',
                title: 'Logout Berhasil',
                text: 'Anda telah keluar dari sistem',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }
    });
    </script>
    <!-- <script>
      document
        .getElementById("loginForm")
        .addEventListener("submit", function (e) {
          e.preventDefault();
          window.location.href = "dashboard.php";
        });
    </script> -->
  

  </body>
</html>
