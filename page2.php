<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: page1.php');
    exit;
}

$videos = [];

if (($file = fopen('Video.csv', 'r')) !== false) {
    while (($line = fgetcsv($file, 0, '|')) !== false) {
        if ($line[4] == '0') { // is_deleted = 0
            $videos[] = $line;
        }
    }
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Video Listesi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Merhaba <?= $_SESSION['user'] ?>, Video Listesi</h2>
    <a href="page3.php"><button>Yeni Video Ekle</button></a>
    <div class="video-container">
        <?php foreach ($videos as $video): 
            $id = $video[0];
            $link = $video[1];
            $desc = $video[2];
            $thumb = "https://img.youtube.com/vi/{$id}/default.jpg";
        ?>
            <div class="video-card">
                <a href="<?= $link ?>" target="_blank">
                    <img src="<?= $thumb ?>" alt="thumbnail">
                </a>
                <p><?= htmlspecialchars($desc) ?></p>
                <a href="page4.php?id=<?= $id ?>"><button>Güncelle</button></a>
                <a href="delete.php?id=<?= $id ?>"><button class="delete-btn">Sil</button></a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
