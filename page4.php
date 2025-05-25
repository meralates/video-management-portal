<?php
$id = $_GET['id'] ?? '';
$video = null;

if ($id) {
    $lines = file('Video.csv');
    foreach ($lines as $line) {
        $parts = explode('|', trim($line));
        if ($parts[0] === $id) {
            $video = $parts;
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id']) && !empty($_POST['link']) && !empty($_POST['desc'])) {
        $newLines = [];
        foreach ($lines as $line) {
            $parts = explode('|', trim($line));
            if ($parts[0] === $_POST['id']) {
                $parts[1] = $_POST['link'];
                $parts[2] = $_POST['desc'];
                // date_added ve is_deleted alanları değişmeyecek
                $line = implode('|', $parts) . "\n";
            }
            $newLines[] = $line;
        }
        file_put_contents('Video.csv', implode('', $newLines));
        header('Location: page2.php');
        exit;
    } else {
        $error = "Tüm alanlar doldurulmalı!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Video Güncelle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Videoyu Güncelle</h2>

    <?php if ($video): ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($video[0]) ?>">
            <input type="text" name="link" value="<?= htmlspecialchars($video[1]) ?>" required>
            <input type="text" name="desc" value="<?= htmlspecialchars($video[2]) ?>" required>
            <button type="submit">Kaydet</button>
            <a href="page2.php"><button type="button">Vazgeç</button></a>
        </form>
    <?php else: ?>
        <p class="error">Video bulunamadı.</p>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
</body>
</html>
