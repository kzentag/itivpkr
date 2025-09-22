<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor_name = htmlspecialchars($_POST['doctor_name']);
    $visit_date = $_POST['visit_date'];
    $patient_name = htmlspecialchars($_POST['patient_name']);
    $status = $_POST['status'];
    
    $stmt = $pdo->prepare("INSERT INTO visits (doctor_name, visit_date, patient_name, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$doctor_name, $visit_date, $patient_name, $status]);
    
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Добавить запись</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 500px; }
        input, select { width: 100%; padding: 8px; margin: 5px 0 15px 0; }
        label { font-weight: bold; }
        .buttons { margin-top: 20px; }
        .buttons input, .buttons a { margin-right: 10px; padding: 10px 20px; }
    </style>
</head>
<body>
    <h1>Добавить новую запись</h1>
    
    <form method="POST">
        <p>
            <label>Имя врача:</label>
            <input type="text" name="doctor_name" required>
        </p>
        <p>
            <label>Имя пациента:</label>
            <input type="text" name="patient_name" required>
        </p>
        <p>
            <label>Дата и время посещения:</label>
            <input type="datetime-local" name="visit_date" required>
        </p>
        <p>
            <label>Статус:</label>
            <select name="status">
                <option value="запланирован">Запланирован</option>
                <option value="завершен">Завершен</option>
                <option value="отменен">Отменен</option>
            </select>
        </p>
        <p class="buttons">
            <input type="submit" value="Добавить">
            <a href="index.php">Отмена</a>
        </p>
    </form>
</body>
</html>