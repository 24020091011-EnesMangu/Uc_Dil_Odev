<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mini IMDb - Vitrin</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <nav class="navbar">
        <a href="index.php" class="logo">Mini<span>IMDb</span></a>
        
        <div class="nav-links" style="display: flex; align-items: center;">
            <span style="color: #f39c12; font-weight: 600; margin-right: 10px;">Kategoriler:</span>
            
            <?php
            // Veritabanındaki tüm türleri (genres) çekiyoruz
            $genreStmt = $pdo->query('SELECT id, name FROM genres');
            while ($g = $genreStmt->fetch()) {
                echo "<a href='category.php?genre_id=" . $g['id'] . "' style='margin: 0 8px;'>" . htmlspecialchars($g['name']) . "</a>";
            }
            ?>
            
            <a href="manage_movies.php" class="btn" style="margin-left: 20px;">Filmleri Yönet</a>
        </div>
    </nav>

    <div class="container">
        <h2 style="margin-bottom: 30px; border-left: 4px solid #e50914; padding-left: 15px;">Popüler Filmler</h2>
        <div class="movie-grid">
            <?php
           $stmt = $pdo->query('SELECT m.id, m.title, m.release_year, m.poster_url, g.name AS genre FROM movies m LEFT JOIN genres g ON m.genre_id = g.id');
            while ($row = $stmt->fetch())
            {
                // Eğer veritabanında afiş yoksa varsayılan boş bir resim göster
                $poster = !empty($row['poster_url']) ? $row['poster_url'] : 'https://via.placeholder.com/300x450?text=Afis+Yok';
                
                echo "<div class='movie-card'>";
                echo "<a href='movie_detail.php?id=" . $row['id'] . "'><img src='" . htmlspecialchars($poster) . "' class='movie-poster' alt='Afiş'></a>";
                echo "<h3><a href='movie_detail.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></h3>";
                echo "<p><strong>Yıl:</strong> " . $row['release_year'] . "</p>";
                echo "<p><strong>Tür:</strong> <span style='color:#e50914;'>" . htmlspecialchars($row['genre']) . "</span></p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

</body>
</html>