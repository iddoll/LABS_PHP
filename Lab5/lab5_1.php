<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Довжина імені</title>
</head>
<body>
    <h2>Введіть ім’я</h2>
    <form method="get">
        <input type="text" name="name" placeholder="Ваше ім’я">
        <button type="submit">Визначити довжину</button>
    </form>

    <?php
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $length = mb_strlen($name, 'UTF-8');
        echo "<p>Довжина імені \"$name\" становить $length символів.</p>";
    }
    ?>
</body>
</html>
