<!DOCTYPE html>
<html>
<head>
    <title>Оновлення даних книги</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { margin-top: 20px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="number"] { width: 300px; padding: 8px; margin-bottom: 10px; }
        input[type="submit"] { padding: 10px 15px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
        .message { margin-top: 20px; color: green; }
        .error { margin-top: 20px; color: red; }
    </style>
</head>
<body>

    <h2>Оновлення даних книги</h2>

    <form method="POST" action="">
        <label for="book_id">ID Книги:</label>
        <input type="number" id="book_id" name="book_id" required><br>

        <label for="new_price">Нова Ціна (необов'язково):</label>
        <input type="number" step="0.01" id="new_price" name="new_price"><br>

        <label for="new_publication_year">Новий Рік Публікації (необов'язково):</label>
        <input type="number" id="new_publication_year" name="new_publication_year"><br>

        <input type="submit" value="Оновити дані">
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $book_id = $_POST['book_id'];
        $new_price = isset($_POST['new_price']) && $_POST['new_price'] !== '' ? (float)$_POST['new_price'] : null;
        $new_publication_year = isset($_POST['new_publication_year']) && $_POST['new_publication_year'] !== '' ? (int)$_POST['new_publication_year'] : null;

        if (!$book_id) {
            echo "<div class='error'>Будь ласка, введіть ID книги.</div>";
        } else {
            $update_fields = [];
            $bind_params = [];
            $param_types = "";

            if ($new_price !== null) {
                $update_fields[] = "price = ?";
                $bind_params[] = $new_price;
                $param_types .= "d";
            }
            if ($new_publication_year !== null) {
                $update_fields[] = "publication_year = ?";
                $bind_params[] = $new_publication_year;
                $param_types .= "i";
            }

            if (empty($update_fields)) {
                echo "<div class='error'>Будь ласка, введіть нову ціну або рік публікації для оновлення.</div>";
            } else {
                $sql = "UPDATE Books SET " . implode(", ", $update_fields) . " WHERE id = ?";
                $param_types .= "i"; // Add type for book_id
                $bind_params[] = $book_id; // Add book_id to parameters

                $stmt = $conn->prepare($sql);

                if ($stmt === false) {
                    die("<div class='error'>Помилка підготовки запиту: " . $conn->error . "</div>");
                }

                // Use call_user_func_array to bind parameters dynamically
                call_user_func_array([$stmt, 'bind_param'], array_merge([$param_types], refValues($bind_params)));

                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        echo "<div class='message'>Дані книги з ID: $book_id оновлено успішно!</div>";
                    } else {
                        echo "<div class='message'>Книгу з ID: $book_id не знайдено або дані не змінилися.</div>";
                    }
                } else {
                    echo "<div class='error'>Помилка оновлення: " . $stmt->error . "</div>";
                }
                $stmt->close();
            }
        }
    }

    $conn->close();

    // Helper function for bind_param
    function refValues($arr){
        if (strnatcmp(phpversion(),'5.3') >= 0) // PHP 5.3+
        {
            $refs = array();
            foreach($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }
    ?>
</body>
</html>