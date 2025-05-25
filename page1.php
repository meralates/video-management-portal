<!-- page1.php -->
<?php
session_start();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $file = fopen('User.csv', 'r');
    $valid = false;

    while (($line = fgetcsv($file, 0, '|')) !== false) {
        if ($line[0] === $username && $line[1] === $password) {
            $valid = true;
            break;
        }
    }
    fclose($file);

    if ($valid) {
        $_SESSION['user'] = $username;
        header('Location: page2.php');
        exit;
    } else {
        $error = 'Hatalı kullanıcı adı veya şifre!';
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Video Portalı - Giriş Yap</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
        </form>
        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
