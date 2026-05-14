<?php 
require 'db.php'; 
$actor_id = $_GET['actor_id'] ?? 0;

$stmt = $pdo->prepare('SELECT * FROM actors WHERE id = ?');
$stmt->execute([$actor_id]);
$actor = $stmt->fetch();

if (!$actor) { die("<h2 style='color:#fff; text-align:center;'>Oyuncu bulunamadı.</h2>"); }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($actor['full_name']) ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">Mini<span>IMDb</span></a>
        <div class="nav-links">
            <a href="#" onclick="history.back()" class="btn btn-secondary">Geri Dön</a>
        </div>
    </nav>

    <div class="container">
        <div class="detail-box">
            <h1 style="color:#e50914; margin-top:0;"><?= htmlspecialchars($actor['full_name']) ?></h1>
            <p><strong>Doğum Tarihi:</strong> <span style="color:#8a8d9b;"><?= $actor['birth_date'] ?></span></p>
            <p style="line-height: 1.6; margin-top:20px;"><strong>Biyografi:</strong> <br> <?= nl2br(htmlspecialchars($actor['bio'])) ?></p>

            <h3 style="margin-top:40px; border-bottom: 1px solid #2a2d3a; padding-bottom:10px;">Oynadığı Filmler</h3>
            <ul style="list-style-type: none; padding: 0;">
            <?php
            $moviesStmt = $pdo->prepare('SELECT m.id, m.title, c.role_name 
                                         FROM casting c 
                                         JOIN movies m ON c.movie_id = m.id 
                                         WHERE c.actor_id = ?');
            $moviesStmt->execute([$actor_id]);
            
            while ($movie = $moviesStmt->fetch()) {
                echo "<li style='padding: 10px 0; border-bottom: 1px solid #2a2d3a;'>";
                echo "<a href='movie_detail.php?id=" . $movie['id'] . "' style='color:#fff; text-decoration:none; font-weight:600;'>" . htmlspecialchars($movie['title']) . "</a>";
                echo " <span style='color:#8a8d9b;'>filminde</span> <em style='color:#e50914;'>" . htmlspecialchars($movie['role_name']) . "</em> <span style='color:#8a8d9b;'>rolüyle</span>";
                echo "</li>";
            }
            ?>
            </ul>
        </div>
    </div>

</body>
</html>