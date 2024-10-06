<?php
// Konfigurasi koneksi database
$host = 'localhost'; // Ganti dengan host database Anda
$dbname = 'database'; // Ganti dengan nama database Anda
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda

try {
    // Membuat koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mengambil data dari tabel data_nasbah
    $stmt = $pdo->query("SELECT IdNasabah, KodeCabang, NamaNasabah, Alamat, Kota, JenisKelamin, TempatLahir, TanggalLahir, Pekerjaan, TanggalInsert, TanggalUpdate FROM data_nasabah");
    $dataNasabah = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    exit();
}

// Fungsi untuk menampilkan tabel data_nasbah
function tampilkanTabelNasabah($dataNasabah) {
    echo "<table border='1'>";
    echo "<tr>
            <th>IdNasabah</th>
            <th>KodeCabang</th>
            <th>NamaNasabah</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>JenisKelamin</th>
            <th>TempatLahir</th>
            <th>TanggalLahir</th>
            <th>Pekerjaan</th>
            <th>TanggalInsert</th>
            <th>TanggalUpdate</th>
          </tr>";
    
    foreach ($dataNasabah as $nasabah) {
        echo "<tr>
                <td>{$nasabah['IdNasabah']}</td>
                <td>{$nasabah['KodeCabang']}</td>
                <td>{$nasabah['NamaNasabah']}</td>
                <td>{$nasabah['Alamat']}</td>
                <td>{$nasabah['Kota']}</td>
                <td>{$nasabah['JenisKelamin']}</td>
                <td>{$nasabah['TempatLahir']}</td>
                <td>{$nasabah['TanggalLahir']}</td>
                <td>{$nasabah['Pekerjaan']}</td>
                <td>{$nasabah['TanggalInsert']}</td>
                <td>{$nasabah['TanggalUpdate']}</td>
              </tr>";
    }
    
    echo "</table><br>";
}

// Tampilkan tabel data_nasbah
tampilkanTabelNasabah($dataNasabah);
?>