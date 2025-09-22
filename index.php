<?php
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM visits ORDER BY visit_date DESC");
$visits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Журнал посещений врача</title>
    <meta charset="UTF-8">
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .actions a { margin-right: 10px; }
        body { font-family: Arial, sans-serif; margin: 20px; }
    </style>
</head>
<body>
    <h1>Журнал посещений врача</h1>
    <a href="add.php">Добавить новую запись</a>
    
    <?php if (empty($visits)): ?>
        <p>Нет записей о посещениях.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Врач</th>
                <th>Пациент</th>
                <th>Дата посещения</th>
                <th>Статус</th>
                <th>Дата создания</th>
                <th>Действия</th>
            </tr>
            <?php foreach($visits as $visit): ?>
            <tr>
                <td><?= htmlspecialchars($visit['doctor_name']) ?></td>
                <td><?= htmlspecialchars($visit['patient_name']) ?></td>
                <td><?= date('d.m.Y H:i', strtotime($visit['visit_date'])) ?></td>
                <td><?= $visit['status'] ?></td>
                <td><?= date('d.m.Y H:i', strtotime($visit['created_at'])) ?></td>
                <td class="actions">
                    <a href="edit.php?id=<?= $visit['id'] ?>">Редактировать</a>
                    <?php if ($visit['status'] != 'завершен'): ?>
                        <a href="update_status.php?id=<?= $visit['id'] ?>&status=завершен">Завершить</a>
                    <?php endif; ?>
                    <a href="delete.php?id=<?= $visit['id'] ?>" onclick="return confirm('Удалить запись?')">Удалить</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>