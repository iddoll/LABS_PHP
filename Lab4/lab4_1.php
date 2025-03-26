<?php
$names = ["Олександр", "Марія", "Іван", "Анна"];
$ages = [25, 30, 22, 28];

$combinedArray = array_combine($names, $ages);

echo "Об'єднаний асоціативний масив:<br>";
print_r($combinedArray);
echo "<br><br>";
?>