<form method="post">
    Назва курсу: <input type="text" name="course_name"><br>
    <input type="submit" value="Додати курс">
</form>

<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = $_POST['course_name'];
    $conn->query("INSERT INTO Courses (course_name) VALUES ('$course')");
    echo "Курс додано!";
}
?>
