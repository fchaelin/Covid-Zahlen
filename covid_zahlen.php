<?php

include("functions_covid.php");

$auswahl = array(
    "Länder-Zahlen",
    "Globale-Zahlen"
);

echo PHP_EOL;
echo "Auswahl:";
echo PHP_EOL;
foreach ($auswahl as $index => $value) {
    printf('%d: %s', $index, $value);
    echo PHP_EOL;
}

$eingabe = readline('Ihre Wahl: ');
if (is_numeric($eingabe)) {
    if ($eingabe >= count($auswahl)) {
    } else {
        echo "Sie haben \"$auswahl[$eingabe]\" gewählt!";
        print PHP_EOL;
        print PHP_EOL;
        switch ($eingabe) {
            case '0':
                landZahlen();
                break;
            case '1':
                globaleZahlen();
                break;
            case '2':
                vergangenneZahlen();
                break;
            case '3':
                pass;
                break;
            default:
        }
        echo PHP_EOL;
    }
} else {
    print "Ungültige Eingabe ._.";
}
