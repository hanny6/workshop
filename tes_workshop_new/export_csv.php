<?php
// export_csv.php

// Buat koneksi ke database
$conn = new mysqli("localhost", "root", "", "coba_absensi");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Escape dan dapatkan parameter id_user dan id_month dari URL
$id_user = mysqli_real_escape_string($conn, $_GET['id_user']);
$id_month = mysqli_real_escape_string($conn, $_GET['id_month']);

// Query untuk mendapatkan data absensi
$query_absen_csv = $conn->query("SELECT hari.nama_hri, tanggal.nama_tgl, bulan.nama_bln, data_absen.jam_msk, data_absen.st_jam_msk, data_absen.jam_klr, data_absen.st_jam_klr FROM data_absen NATURAL JOIN hari NATURAL JOIN tanggal NATURAL JOIN bulan WHERE id_bln='$id_month' AND id_user='$id_user'");

// Header untuk file CSV
$header = array('Hari, Tanggal', 'Jam Masuk', 'Status Masuk', 'Jam Pulang', 'Status Pulang');


$name = isset($_GET['name']) ? $_GET['name'] : '';
$month = isset($_GET['month']) ? $_GET['month'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

// Nama file CSV
$filename = 'data_absen_'.$name.'_'.$month.$year.'.csv';

// Buat file CSV dan tulis header
$file = fopen($filename, 'w');
fputcsv($file, $header);

// Tulis data absensi ke dalam file CSV
while ($get_absen_csv = $query_absen_csv->fetch_assoc()) {
    $date_csv = "$get_absen_csv[nama_hri], $get_absen_csv[nama_tgl] $get_absen_csv[nama_bln] ".date("Y");
    $time_in_csv = "$get_absen_csv[jam_msk]";
    $st_in_csv = "$get_absen_csv[st_jam_msk]";
    if ($get_absen_csv['jam_klr'] === "") {
        $time_out_csv = "-";
        $st_out_csv = "-";
    } else {
        $time_out_csv = "$get_absen_csv[jam_klr]";
        $st_out_csv = "$get_absen_csv[st_jam_klr]";
    }
    fputcsv($file, array($date_csv, $time_in_csv, $st_in_csv, $time_out_csv, $st_out_csv));
}

// Tutup file CSV
fclose($file);

// Set header untuk mengatur tipe konten dan nama file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename='.$filename);
header('Pragma: no-cache');
header('Expires: 0');

// Mengirimkan isi file ke output
readfile($filename);

// Hapus file CSV yang telah di-generate
unlink($filename);

// Tutup koneksi database
$conn->close();
