<?php
require 'db.php';

if (isset($_GET['delete_id'])) {
    $delStmt = $pdo->prepare('DELETE FROM movies WHERE id = ?');
    $delStmt->execute([$_GET['delete_id']]);
    header("Location: manage_movies.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Film Yönetimi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">Mini<span>IMDb</span> Yönetim</a>
        <div class="nav-links">
            <a href="index.php" class="btn btn-secondary">Vitrini Gör</a>
        </div>
    </nav>

    <div class="container">
        <h2 style="margin-bottom: 20px;">Filmleri Yönet</h2>
        <table>
            <tr>
                <th>Film Adı</th>
                <th>Yayın Yılı</th>
                <th>İşlemler</th>
            </tr>
            <?php
            $stmt = $pdo->query('SELECT id, title, release_year FROM movies');
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td><strong>" . htmlspecialchars($row['title']) . "</strong></td>";
                echo "<td>" . $row['release_year'] . "</td>";
                echo "<td>
                        <a href='edit_movie.php?id=" . $row['id'] . "' class='btn btn-secondary' style='padding: 5px 10px; font-size:12px;'>Güncelle</a> 
                        <a href='manage_movies.php?delete_id=" . $row['id'] . "' class='btn' style='padding: 5px 10px; font-size:12px;' onclick='return confirm(\"Bu filmi silmek istediğine emin misin?\")'>Sil</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>