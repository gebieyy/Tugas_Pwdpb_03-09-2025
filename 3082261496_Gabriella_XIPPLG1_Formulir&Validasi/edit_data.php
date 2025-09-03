<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // biar aman, convert ke integer
    $query = "SELECT * FROM siswa WHERE id = $id";
    $result = $koneksi->query($query);

    if (!$result) {
        die("Query error: " . $koneksi->error);
    }

    if ($result->num_rows == 0) {
        echo "Data dengan ID $id tidak ditemukan!";
        exit;
    }

    $data = $result->fetch_assoc();
} else {
    echo "ID tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
</head>
<body>
    <h2>Edit Data Siswa</h2>
    <form action="proses_edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
        
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required><br><br>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required><?php echo htmlspecialchars($data['alamat']); ?></textarea><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
