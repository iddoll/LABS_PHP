<!DOCTYPE html>
<html>
<head>
    <title>Пошук книг</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { margin-top: 20px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"] { width: 300px; padding: 8px; margin-bottom: 10px; }
        input[type="submit"] { padding: 10px 15px; background-color: #008CBA; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #007bb5; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .message { margin-top: 20px; color: green; }
        .error { margin-top: 20px; color: red; }
    </style>
</head>
<body>

    <h2>Пошук книг за назвою</h2>

    <form method="GET" action="">
        <label for="search_title">Введіть назву або частину назви книги:</label>
        <input type="text" id="search_title" name="search_title" value="<?php echo isset($_GET['search_title']) ? htmlspecialchars($_GET['search_title']) : ''; ?>"><br>
        <input type="submit" value="Шукати">
    </form>

    <?php
    $servername = "localhost";
    $username = "root"; // Замініть на ім'я вашого користувача бази даних
    $password = "";     // Замініть на ваш пароль до бази даних
    $dbname = "BookStore";

    // Створення з'єднання
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Перевірка з'єднання
    if ($conn->connect_error) {
        die("<div class='error'>Помилка з'єднання: " . $conn->connect_error . "</div>");
    }

    if (isset($_GET['search_title']) && !empty($_GET['search_title'])) {
        $search_title = '%' . $_GET['search_title'] . '%';
        $sql = "SELECT id, title, author, price, publication_year FROM Books WHERE title LIKE ?";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("<div class='error'>Помилка підготовки запиту: " . $conn->error . "</div>");
        }

        $stmt->bind_param("s", $search_title);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h3>Результати пошуку:</h3>";
            echo "<table>";
            echo "<thead><tr><th>ID</th><th>Назва</th><th>Автор</th><th>Ціна</th><th>Рік публікації</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                echo "<td>" . htmlspecialchars($row['publication_year']) . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<div class='message'>За вашим запитом книг не знайдено.</div>";
        }
        $stmt->close();
    } else if (isset($_GET['search_title']) && empty($_GET['search_title'])) {
        echo "<div class='message'>Будь ласка, введіть назву для пошуку.</div>";
    }

    $conn->close();
    ?>

</body>
</html>