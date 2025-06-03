<?php
$servername = "localhost";
$username = "Illia"; 
$password = "123456789";     
$dbname = "BookStore";

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
    echo "Помилка створення бази даних: " . $conn->error;
}

// Використання бази даних
$conn->select_db($dbname);

// Створення таблиці
$sql = "CREATE TABLE IF NOT EXISTS Books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    price FLOAT,
    publication_year INT
)";
if ($conn->query($sql) === TRUE) {
    echo "Таблиця 'Books' створена успішно<br>";
} else {
    echo "Помилка створення таблиці: " . $conn->error;
}

// Додавання даних (для прикладу)
$sql = "INSERT INTO Books (id, title, author, price, publication_year) VALUES
    ('The Hobbit', 'J.R.R. Tolkien', 15.99, 1937),
    ('1984', 'George Orwell', 12.50, 1949),
    ('Pride and Prejudice', 'Jane Austen', 10.00, 1813)";

if ($conn->query($sql) === TRUE) {
    echo "Початкові дані успішно додані<br>";
} else {
    echo "Помилка додавання даних: " . $conn->error;
}

$conn->close();
?>