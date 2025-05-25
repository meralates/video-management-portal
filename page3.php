<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id']) && !empty($_POST['link']) && !empty($_POST['desc'])) {
        $id = trim($_POST['id']);
        $link = trim($_POST['link']);
        $desc = trim($_POST['desc']);
        $date = date('Y-m-d H:i');
        $line = "$id|$link|$desc|$date|0\n";
        file_put_contents('Video.csv', $line, FILE_APPEND);
        header('Location: page2.php');
        exit;
    } else {
        $error = "Tüm alanları doldurmalısınız!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Video Ekle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Yeni Video Ekle</h2>
    <form method="POST">
        <input type="text" name="id" placeholder="Video ID (örn: rUWxSEwctFU)" required>
        <input type="text" name="link" placeholder="YouTube Linki" required>
        <input type="text" name="desc" placeholder="Açıklama" required>
        <button type="submit">Kaydet</button>
        <a href="page2.php"><button type="button">Vazgeç</button></a>
    </form>
    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
</body>
</html>
