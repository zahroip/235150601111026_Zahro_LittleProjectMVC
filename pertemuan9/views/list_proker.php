<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login_view.php");
    exit();
}
include_once '../controllers/ProgramKerja.php';
$controller = new ProgramKerjaController();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nomor'])) {
    $controller->deleteProker();
}
$programList = $controller->programModel->fetchAllProgramKerja();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Program Kerja</title>
</head>

<body>
    <div style="display: flex; align-items: center; gap: 20px;">
        <h2>Daftar Program Kerja</h2>
    </div>
    <table border="1">
        <tr>
            <th>Nomor Program</th>
            <th>Nama Program</th>
            <th>Surat Keterangan</th>
            <th>Aksi</th>
        </tr>
        <?php

        foreach ($programList as $program): ?>
            <tr>
                <td><?= htmlspecialchars($program['nomor']) ?></td>
                <td><?= htmlspecialchars($program['nama']) ?></td>
                <td><?= htmlspecialchars($program['surat_keterangan']) ?></td>
                <td>
                    <a href="edit_proker.php?nomor=<?= $program['nomor'] ?>">Edit</a>
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="nomor" value="<?= $program['nomor'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
    unset($programList);
    ?>
<br><br>
<button>
            <a href="add_proker.php" style="text-decoration: none;">Add Program Kerja</a>
        </button>
        <button>
            <a href="../logout.php" style="text-decoration: none;">Logout</a>
        </button>
</body>

</html>