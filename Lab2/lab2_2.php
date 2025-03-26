<?php
$variable = "12.8"; 
echo "Початкове значення: $variable (тип: " . gettype($variable) . ")<br>";

$converted = (int)$variable; 
echo "Перетворене значення: $converted (тип: " . gettype($converted) . ")<br>";
?>