<?php
$db = new PDO('mysql:host=localhost;dbname=universidad;charset=utf8', 'root', '');
try {
    $db = new PDO('mysql:host=localhost;dbname=universidad;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>
