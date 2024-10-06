<?php
// Konfigurasi koneksi database
$host = 'localhost'; // Ganti dengan host database Anda
$dbname = 'database'; // Ganti dengan nama database Anda
$username = 'root'; // Apakah sudah benar untuk username?
$password = ''; // Apakah sudah benar untuk password?

try {
    // Membuat koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mengambil data dari tabel data_cabang
    $stmt = $pdo->query("SELECT id, nama FROM data_cabang");
    $dataCabang = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    exit();
}

// Kategori cakbor
$cakbor = [
    'Kantor Cabang Utama',
    'Kantor Cabang Koordinator Surakarta',
    'Kantor Cabang Koordinator Purwokerto',
    'Kantor Cabang Koordinator Tegal',
    'Kantor Cabang Koordinator Magelang',
    'Kantor Cabang Koordinator Pati',
    'Kantor Cabang Koordinator Semarang'
];

// Kategori cabang
$cabang = [
    'Kantor Cabang Utama' => ['Jakarta', 'Yogyakarta'],
    'Kantor Cabang Koordinator Surakarta' => ['Surakarta', 'Sukoharjo', 'Klaten', 'Boyolali', 'Karanganyar', 'Wonogiri', 'Sragen'],
    'Kantor Cabang Koordinator Purwokerto' => ['Purwokerto', 'Cilacap', 'Banjarnegara', 'Purbalingga'],
    'Kantor Cabang Koordinator Tegal' => ['Tegal', 'Pemalang', 'Brebes', 'Pekalongan', 'Batang', 'Slawi', 'Kajen'],
    'Kantor Cabang Koordinator Magelang' => ['Magelang', 'Kebumen', 'Temanggung', 'Purworejo', 'Wonosobo', 'Mungkid'],
    'Kantor Cabang Koordinator Pati' => ['Pati', 'Rembang', 'Kudus', 'Jepara', 'Blora'],
    'Kantor Cabang Koordinator Semarang' => ['Semarang', 'Ungaran', 'Purwodadi', 'Kendal', 'Salatiga', 'Demak']
];

// Kategori unit kerja sama dengan cabang
$unitKerja = $cabang;

// Fungsi untuk menampilkan tabel dengan format baru
function tampilkanTabelBaru($cakbor, $cabang) {
    echo "<table border='1'>";
    echo "<tr><th>Cakbor</th><th>Cabang Meliputi</th><th>Unit Kerja</th></tr>";
    
    foreach ($cakbor as $key => $value) {
        echo "<tr>";
        echo "<td>$value</td>";
        
        // Menampilkan cabang meliputi
        if (isset($cabang[$value])) {
            echo "<td>" . implode(', ', $cabang[$value]) . "</td>";
        } else {
            echo "<td>induk (36)</td>"; // Default value for 'Kantor Cabang Utama'
        }
        
        // Menampilkan unit kerja
        if (isset($cabang[$value])) {
            echo "<td>" . implode(', ', $cabang[$value]) . "</td>";
        } else {
            echo "<td>induk (36)</td>"; // Default value for 'Kantor Cabang Utama'
        }
        
        echo "</tr>";
    }
    
    echo "</table><br>";
}

// Tampilkan tabel dengan format baru
tampilkanTabelBaru($cakbor, $cabang);

// Fungsi untuk menampilkan tabel
function tampilkanTabel($kategori, $data) {
    echo "<table border='1'>";
    echo "<tr><th>Kategori</th><th>ID</th></tr>";
    foreach ($data as $item) {
        if (in_array($item['nama'], $kategori)) {
            echo "<tr><td>{$item['nama']}</td><td>{$item['id']}</td></tr>";
        }
    }
    echo "</table><br>";
}

// Tampilkan tabel untuk masing-masing kategori
echo "<h2>Cakbor</h2>";
tampilkanTabel($cakbor, $dataCabang);

echo "<h2>Cabang</h2>";
foreach ($cabang as $key => $value) {
    echo "<h3>$key</h3>";
    echo "<ul>";
    foreach ($value as $area) {
        echo "<li>$area</li>";
    }
    echo "</ul>";
}

echo "<h2>Unit Kerja</h2>";
foreach ($unitKerja as $key => $value) {
    echo "<h3>$key</h3>";
    echo "<ul>";
    foreach ($value as $area) {
        echo "<li>$area</li>";
    }
    echo "</ul>";
}
?>