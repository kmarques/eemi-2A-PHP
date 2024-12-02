<?php

echo "Exo1" . PHP_EOL;

//$content = file_get_contents("./number.txt");
//$numbers = explode(PHP_EOL, $content);
$numbers = file("./number.txt", FILE_IGNORE_NEW_LINES);

rsort($numbers);

$total = 0;
$nbItems = count($numbers);
$median = $numbers[$nbItems - 1];
foreach ($numbers as $index => $number) {
    $total += intval($number);
    if ($index < $nbItems / 2) {
        $median = $number;
    }
}

echo "Moyenne: " . ($total / $nbItems).PHP_EOL;
echo "Medianne: {$median}" . PHP_EOL;
echo "Somme: {$total}" . PHP_EOL;
//echo "Somme: " . array_sum($numbers) . PHP_EOL;
echo "Values: " . implode(", ", $numbers) . PHP_EOL;
