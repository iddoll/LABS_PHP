<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Перевірка пароля</title>
</head>
<body>
    <h2>Введіть пароль</h2>
    <form method="post">
        <input type="password" name="password" placeholder="Ваш пароль">
        <button type="submit">Перевірити</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];

        if (strlen($password) < 8) {
            echo "<p style='color:red;'>Пароль має містити щонайменше 8 символів.</p>";
        } elseif (!preg_match('/\d/', $password)) {
            echo "<p style='color:red;'>Пароль має містити хоча б одну цифру.</p>";
        } else {
            echo "<p style='color:green;'>Пароль валідний.</p>";
        }
    }
    ?>
</body>
</html>
