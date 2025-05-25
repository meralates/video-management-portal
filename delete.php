<?php
if (!isset($_GET['id'])) {
    header('Location: page2.php');
    exit;
}

$id = $_GET['id'];

$lines = file('Video.csv');
$new_lines = [];

foreach ($lines as $line) {
    $parts = explode('|', trim($line));
    if ($parts[0] === $id) {
        $parts[4] = '1'; // is_deleted = 1
        $line = implode('|', $parts) . "\n";
    }
    $new_lines[] = $line;
}

file_put_contents('Video.csv', implode('', $new_lines));
header('Location: page2.php');
exit;
