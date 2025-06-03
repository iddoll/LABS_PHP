<?php
$servername = "localhost";
$username = "Illia";
$password = "123456789";
$dbname = "bookstore";

// Створення з'єднання
$conn = new mysqli($servername, $username, $password);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}

// Створення бази даних
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "База даних '$dbname' створена успішно<br>";
} else {
    die("Помилка створення бази даних: " . $conn->error);
}

// Вибір бази даних
$conn->select_db($dbname);

// Створення таблиці
$sql = "CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    price FLOAT,
    publication_year INT,
    UNIQUE KEY unique_title (title)
)";
if ($conn->query($sql) === TRUE) {
    echo "Таблиця 'books' створена або вже існує<br>";
} else {
    die("Помилка створення таблиці: " . $conn->error);
}

// Очищення таблиці перед вставкою
$conn->query("DELETE FROM books");

// Масив книг
$books = [
    ['The Hobbit', 'J.R.R. Tolkien', 15.99, 1937],
    ['1984', 'George Orwell', 12.50, 1949],
    ['Pride and Prejudice', 'Jane Austen', 10.00, 1813]
];

// Формування SQL-запиту
$values = [];
foreach ($books as $b) {
    $title = $conn->real_escape_string($b[0]);
    $author = $conn->real_escape_string($b[1]);
    $price = (float)$b[2];
    $year = (int)$b[3];
    $values[] = "('$title', '$author', $price, $year)";
}

$sql = "INSERT INTO books (title, author, price, publication_year) VALUES " . implode(',', $values);

// Вивід SQL-запиту для перевірки
echo "<pre>SQL-запит: $sql</pre>";

if ($conn->query($sql) === TRUE) {
    echo "Додано " . $conn->affected_rows . " книг<br>";
} else {
    echo "Помилка додавання книг: " . $conn->error;
}

$conn->close();
?>
