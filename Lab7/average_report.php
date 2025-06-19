<?php
include 'db.php';

$sql = "SELECT Courses.course_name, AVG(Grades.grade) as average_grade
        FROM Grades
        JOIN Courses ON Grades.course_id = Courses.id
        GROUP BY course_id";

$result = $conn->query($sql);

echo "<h2>Середній бал по кожному курсу:</h2>";
echo "<table border='1'><tr><th>Курс</th><th>Середній бал</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['course_name']}</td><td>{$row['average_grade']}</td></tr>";
}
echo "</table>";
?>
