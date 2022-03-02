<?php

//➁
echo 'Hello World 2' . PHP_EOL;

$trueA = 'A';

//➂
if ($trueA === 'A') {
    echo 'Hello World 3' . PHP_EOL;
} elseif ($trueA === 'B') {
    echo 'Miss World' . PHP_EOL;
}

//➃
for ($treeTimes = 1; $treeTimes <= 3; $treeTimes++) {
    echo 'Hello World 4_1' . PHP_EOL;
}

$firstNum = 1;
while ($firstNum <= 2) {
    echo 'Hello World 4_2' . PHP_EOL;
    $firstNum++;
}
