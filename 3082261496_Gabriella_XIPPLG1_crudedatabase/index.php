<?php
include 'config.php';

$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

$sql = "SELECT * FROM siswa 
        WHERE nama LIKE '%$search%' 
        OR sekolah LIKE '%$search%' 
        OR jurusan LIKE '%$search%'";
$result = $conn->query($sql);

// Hapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM siswa WHERE id = $id");
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f4f4f4; 
            margin: 0; 
            padding: 20px; 
        }
        h2 { 
            text-align: center; 
            color: #333; 
        }
        .container { 
            max-width: 1000px; 
            margin: 0 auto; 
            padding: 20px; 
            background: #fff; 
            border-radius: 5px; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0; 
            background-color: #fff; 
        }
        th, td { 
            padding: 12px; 
            text-align: left; 
            border-bottom: 1px solid #ddd; 
        }
        th { 
            background-color: #4CAF50; 
            color: white; 
        }
        tr:hover { 
            background-color: #f5f5f5; 
        }
        button { 
            padding: 6px 12px; 
            border: none; 
            border-radius: 4px; 
            background-color: #4CAF50; 
            color: white; 
            cursor: pointer; 
            margin: 0 5px; 
        }
        button:hover { 
            background-color: #45a049; 
        }
        .search-box { 
            margin-bottom: 15px; 
            display: flex; 
            gap: 10px; 
        }
        .search-box input[type="text"] { 
            flex: 1; 
            padding: 8px; 
        }
        .search-box input[type="submit"] { 
            padding: 8px 15px; 
            background-color: #4CAF50; 
            border: none; 
            color: #fff; 
            cursor: pointer; 
            border-radius: 4px; 
        }
        .search-box input[type="submit"]:hover { 
            background-color: #45a049; 
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Daftar Siswa</h2>

    <!-- Form Pencarian -->
    <form method="POST" action="" class="search-box">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari siswa..." required>
        <input type="submit" value="Cari">
    </form>

    <!-- Tabel Data -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Sekolah</th>
            <th>Jurusan</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["nama"] ?></td>
                    <td><?= $row["sekolah"] ?></td>
                    <td><?= $row["jurusan"] ?></td>
                    <td><?= $row["no_hp"] ?></td>
                    <td><?= $row["alamat"] ?></td>
                    <td>
                        <a href="update.php?id=<?= $row['id'] ?>"><button>Edit</button></a>
                        <a href="index.php?delete=<?= $row['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <button>Hapus</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
            <tr>
                <td colspan="7" style="text-align:center;">Tidak ada data</td>
            </tr>
        <?php endif; ?>
    </table>

    <a href="create.php"><button>Tambah Data Siswa</button></a>
</div>
</body>
</html>
<?php
$conn->close();
?>
