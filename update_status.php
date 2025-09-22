<?php
require_once 'config.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = (int)$_GET['id'];
    $status = $_GET['status'];
    
    // Проверяем, что статус допустимый
    if (in_array($status, ['запланирован', 'завершен', 'отменен'])) {
        $stmt = $pdo->prepare("UPDATE visits SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }
}

header('Location: index.php');
exit;
?>