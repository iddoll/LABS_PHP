<form method="post">
    ID студента: <input type="number" name="student_id"><br>
    ID курсу: <input type="number" name="course_id"><br>
    Оцінка: <input type="number" step="0.1" name="grade"><br>
    <input type="submit" value="Додати оцінку">
</form>

<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sid = $_POST['student_id'];
    $cid = $_POST['course_id'];
    $grade = $_POST['grade'];
    $conn->query("INSERT INTO Grades (student_id, course_id, grade) VALUES ($sid, $cid, $grade)");
    echo "Оцінку додано!";
}
?>
