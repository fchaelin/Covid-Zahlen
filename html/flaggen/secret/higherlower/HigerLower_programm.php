<?php

echo "Hier musst du raten welches Land mehr Coronafälle hat";
PHP_EOL;
$ready = readline("Bereit? (j/n) > ");

if ($ready == "j" or "J"){
    include('functions_HigherLower.php');
    system('clear');
    whichIsHigherFrage();
} elseif ($ready == "n" or "N"){
    PHP_EOL;
    echo "Ok";
} else {
    echo "ungültige eingabe";
}
