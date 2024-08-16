<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    $stmt = $pdo->prepare('SELECT * FROM students WHERE name = ? AND subject = ?');
    $stmt->execute([$name, $subject]);
    $student = $stmt->fetch();

    if ($student) {
        $newMarks = $student['marks'] + $marks;
        $stmt = $pdo->prepare('UPDATE students SET marks = ? WHERE id = ?');
        $stmt->execute([$newMarks, $student['id']]);
    } else {
        $stmt = $pdo->prepare('INSERT INTO students (name, subject, marks) VALUES (?, ?, ?)');
        $stmt->execute([$name, $subject, $marks]);
    }

    header('Location: index.php');
    exit;
}
?>
