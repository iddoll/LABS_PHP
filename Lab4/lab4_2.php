<?php
function average($array) {
    if (count($array) == 0) {
        return 0; 
    }
    return array_sum($array) / count($array);
}

$numbers = range(1, 10);
$averageValue = average($numbers);

echo "Середнє значення чисел від 1 до 10: $averageValue";
?>