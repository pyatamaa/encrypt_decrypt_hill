<?php
// Informasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hill_cipher";

// Jumlah data yang akan ditampilkan per halaman
$per_page = 5;

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menghitung total jumlah data
$total_rows_sql = "SELECT COUNT(*) as count FROM hasil_hill_cipher";
$total_rows_result = $conn->query($total_rows_sql);
$total_rows = $total_rows_result->fetch_assoc()["count"];

// Menghitung jumlah halaman
$total_pages = ceil($total_rows / $per_page);

// Mengambil parameter halaman dari URL
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

// Menghitung offset
$offset = ($page - 1) * $per_page;

// Kueri SQL untuk mengambil data dari tabel dengan limit dan offset
$sql = "SELECT id, input_text, `key`, mode, result FROM hasil_hill_cipher LIMIT $per_page OFFSET $offset";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Data Hasil Hill Cipher</title>
    <link rel="stylesheet" href="style2.css"> <!--Ganti "styles.css" dengan nama berkas CSS Anda -->
</head>
<body>
    <h1>Data Hasil Hill Cipher</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Input Text</th>
            <th>Key</th>
            <th>Mode</th>
            <th>Result</th>
        </tr>

        <?php
        // Memeriksa apakah ada data yang ditemukan
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["input_text"] . "</td>";
                echo "<td>" . $row["key"] . "</td>";
                echo "<td>" . $row["mode"] . "</td>";
                echo "<td>" . $row["result"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data yang ditemukan.</td></tr>";
        }
        ?>
    </table>

    <div class="pagination">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }
        ?>
    </div>

    <a href="index.php" class="button">encrypt/decrypt</a>
</body>
</html>



<?php
// Menutup koneksi
$conn->close();
?>
