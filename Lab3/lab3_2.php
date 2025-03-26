<?php
$a = 12;
$b = 25;
$c = 7;

$max = $a; 

if ($b > $max) {
    $max = $b;
}
if ($c > $max) {
    $max = $c;
}

echo "Найбільше число серед ($a, $b, $c): $max";
?>