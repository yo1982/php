<!DOCTYPE html>
<html>
<head>
    <title>Course Management</title>
</head>
<body>
    <h1>Course Management System</h1>

    <h2>Add Course</h2>
    <form method="POST" action="add_course.php">
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" required>
        <br>
        <button type="submit">Add Course</button>
    </form>

    <h2>Upload File/Media</h2>
    <form method="POST" action="upload.php" enctype="multipart/form-data">
        <label for="file">Select File/Media:</label>
        <input type="file" id="file" name="file" required>
        <br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
<?php require_once __DIR__ . '/vendor/autoload.php';
