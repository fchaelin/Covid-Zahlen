<?php



print PHP_EOL;

echo 'Themenauswahl';
print PHP_EOL;
echo '*************';
print PHP_EOL;
echo '1 Upper-Lower Covid';
print PHP_EOL;
echo '2 Flaggenquiz';
print PHP_EOL;
echo '3 Denis Secret';
print PHP_EOL;


$auswahl = readline('Auswahl: ');

switch ($auswahl) {
    case 1:
        echo "Sie haben das \"Upper-Lower Covid\" gewählt!";
        include ("higherlower/HigherLower_programm.php");
        break;
    case 2:
        echo "Sie haben das \"Flaggenquiz\" gewählt!";
        break;
    case 3:
        echo "Sie haben das \"Denis Secret\" gewählt!";
        break;
    default:
        echo "Dieses Modul gibt es nicht!";
}

print PHP_EOL;
print PHP_EOL;
