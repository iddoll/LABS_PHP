<form method="post">
    Ім'я студента: <input type="text" name="name"><br>
    Email: <input type="email" name="email"><br>
    <input type="submit" value="Додати">
</form>

<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $conn->query("INSERT INTO Students (name, email) VALUES ('$name', '$email')");
    echo "Студента додано!";
}
?>
