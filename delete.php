<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $stmt = $pdo->prepare("DELETE FROM visits WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;
?>