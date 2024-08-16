<?php
header('Content-Type: application/json');
require 'db.php';

$column = $_POST['column'];
$value = $_POST['value'];
$id = $_POST['id'];

try {
    $stmt = $pdo->prepare("UPDATE students SET $column = :value WHERE id = :id");
    $stmt->execute(['value' => $value, 'id' => $id]);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
