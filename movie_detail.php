<?php 
require 'db.php'; 
$movie_id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare('SELECT m.*, d.full_name as director, g.name as genre 
                       FROM movies m 
                       LEFT JOIN directors d ON m.director_id = d.id 
                       LEFT JOIN genres g ON m.genre_id = g.id 
                       WHERE m.id = ?');
$stmt->execute([$movie_id]);
$movie = $stmt->fetch();

if (!$movie) { die("<h2 style='color:#fff; text-align:center;'>Film bulunamadı.</h2>"); }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($movie['title']) ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">Mini<span>IMDb</span></a>
        <div class="nav-links">
            <a href="index.php" class="btn btn-secondary">Geri Dön</a>
        </div>
    </nav>

    <div class="container">
       <div class="detail-box">
            <div class="detail-content">
                <!-- Sol Taraf: Afiş -->
                <?php $poster = !empty($movie['poster_url']) ? $movie['poster_url'] : 'https://via.placeholder.com/300x450?text=Afis+Yok'; ?>
                <img src="<?= htmlspecialchars($poster) ?>" class="detail-poster" alt="Afiş">

                <!-- Sağ Taraf: Film Bilgileri -->
                <div class="detail-info">
                    <h1 style="color:#e50914; margin-top:0;"><?= htmlspecialchars($movie['title']) ?> <span style="color:#8a8d9b; font-size:20px;">(<?= $movie['release_year'] ?>)</span></h1>
                    <p><strong>Tür:</strong> <?= htmlspecialchars($movie['genre']) ?></p>
                    <p><strong>Yönetmen:</strong> <?= htmlspecialchars($movie['director']) ?></p>
                    <p style="line-height: 1.6; margin-top:20px;"><strong>Özet:</strong> <?= htmlspecialchars($movie['summary']) ?></p>

                    <h3 style="margin-top:40px; border-bottom: 1px solid #2a2d3a; padding-bottom:10px;">Oyuncu Kadrosu</h3>
                    <ul style="list-style-type: none; padding: 0;">
                    <?php
                    $castStmt = $pdo->prepare('SELECT a.id, a.full_name, c.role_name 
                                               FROM casting c 
                                               JOIN actors a ON c.actor_id = a.id 
                                               WHERE c.movie_id = ?');
                    $castStmt->execute([$movie_id]);
                    
                    while ($cast = $castStmt->fetch()) {
                        echo "<li style='padding: 10px 0; border-bottom: 1px solid #2a2d3a;'>";
                        echo "<a href='actor_profile.php?actor_id=" . $cast['id'] . "' style='color:#fff; text-decoration:none; font-weight:600;'>" . htmlspecialchars($cast['full_name']) . "</a> ";
                        echo "<span style='color:#8a8d9b;'>-</span> <em style='color:#e50914;'>" . htmlspecialchars($cast['role_name']) . "</em> <span style='color:#8a8d9b;'>rolünde</span>";
                        echo "</li>";
                    }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>
</html>