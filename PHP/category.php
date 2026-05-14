<?php 
require 'db.php'; 
$genre_id = $_GET['genre_id'] ?? 0;

// Önce kategorinin adını çekelim ki başlığa yazabilelim
$gStmt = $pdo->prepare('SELECT name FROM genres WHERE id = ?');
$gStmt->execute([$genre_id]);
$genre = $gStmt->fetch();
$genreName = $genre ? $genre['name'] : 'Bilinmeyen Kategori';

// Şimdi bu kategoriye ait filmleri çekelim
$stmt = $pdo->prepare('SELECT id, title, release_year FROM movies WHERE genre_id = ?');
$stmt->execute([$genre_id]);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($genreName) ?> Filmleri</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">Mini<span>IMDb</span></a>
        <div class="nav-links">
            <a href="index.php" class="btn btn-secondary">Ana Sayfaya Dön</a>
        </div>
    </nav>

    <div class="container">
        <h2 style="margin-bottom: 30px; border-left: 4px solid #e50914; padding-left: 15px;">
            <?= htmlspecialchars($genreName) ?> Filmleri
        </h2>
        
        <div class="movie-grid">
            <?php
            $hasMovies = false;
            while ($row = $stmt->fetch()) {
                $hasMovies = true;
                echo "<div class='movie-card'>";
                echo "<h3><a href='movie_detail.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></h3>";
                echo "<p><strong>Yıl:</strong> " . $row['release_year'] . "</p>";
                echo "</div>";
            }
            
            if (!$hasMovies) {
                echo "<p style='color:#8a8d9b;'>Bu kategoride henüz film bulunmuyor.</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>