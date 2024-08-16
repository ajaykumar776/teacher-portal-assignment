<?php
session_start();
require 'db.php';

if (!isset($_SESSION['teacher_id'])) {
    header('Location: login.php');
    exit;
}

$students = $pdo->query('SELECT * FROM students')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include './templates/header.php'; ?>

    <div class="container mt-4">
        <h1>Student Listing</h1>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addStudentModal">Add New Student</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td contenteditable="true" onBlur="saveToDatabase(this, 'name', '<?php echo $student['id']; ?>')"><?php echo htmlspecialchars($student['name']); ?></td>
                    <td contenteditable="true" onBlur="saveToDatabase(this, 'subject', '<?php echo $student['id']; ?>')"><?php echo htmlspecialchars($student['subject']); ?></td>
                    <td contenteditable="true" onBlur="saveToDatabase(this, 'marks', '<?php echo $student['id']; ?>')"><?php echo htmlspecialchars($student['marks']); ?></td>
                    <td><a href="delete_student.php?id=<?php echo $student['id']; ?>" class="btn btn-danger">Delete</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="addStudentModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addStudentForm" method="POST" action="add_student.php">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="marks">Marks</label>
                                <input type="number" class="form-control" id="marks" name="marks" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
