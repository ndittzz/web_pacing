<?php
include 'php/db.php';

// Fungsi untuk mengambil data dari tabel dan mengembalikan array
function getData($konek, $table) {
    $result = $konek->query("SELECT * FROM $table");
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

// Ambil semua data dari tabel
$kelamin = getData($konek, "penduduk_kelamin");
$usia = getData($konek, "penduduk_usia");
$pekerjaan = getData($konek, "penduduk_pekerjaan");
$pendidikan = getData($konek, "penduduk_pendidikan");

// Siapkan data untuk chart gender
$genderData = [
    'labels' => ['Laki-laki', 'Perempuan'],
    'data' => [
        $kelamin[0]['laki_laki'] ?? 0,
        $kelamin[0]['perempuan'] ?? 0
    ],
    'total' => $kelamin[0]['total'] ?? 0
];

// Siapkan data untuk chart usia
$usiaLabels = [];
$usiaValues = [];
foreach($usia as $item) {
    $usiaLabels[] = $item['kategori'];
    $usiaValues[] = $item['total'];
}

// Siapkan data untuk chart pendidikan
$pendidikanLabels = [];
$pendidikanValues = [];
foreach($pendidikan as $item) {
    $pendidikanLabels[] = $item['kategori'];
    $pendidikanValues[] = $item['total'];
}

// Siapkan data untuk chart pekerjaan
$pekerjaanLabels = [];
$pekerjaanValues = [];
foreach($pekerjaan as $item) {
    $pekerjaanLabels[] = $item['kategori'];
    $pekerjaanValues[] = $item['total'];
}

// Format response JSON
$response = [
    'gender' => $genderData,
    'usia' => [
        'labels' => $usiaLabels,
        'data' => $usiaValues
    ],
    'pendidikan' => [
        'labels' => $pendidikanLabels,
        'data' => $pendidikanValues
    ],
    'pekerjaan' => [
        'labels' => $pekerjaanLabels,
        'data' => $pekerjaanValues
    ]
];

header('Content-Type: application/json');
echo json_encode($response);

$konek->close();
?>