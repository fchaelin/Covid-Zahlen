<?php

function secret()
{



    print PHP_EOL;

    echo 'Secretauswahl';
    print PHP_EOL;
    echo '*************';
    print PHP_EOL;
    echo '1 Higher-Lower Covid';
    print PHP_EOL;
    echo '2 Flaggen zu Länder';
    print PHP_EOL;
    echo '3 Denis Secret';
    print PHP_EOL;

    chdir("/opt/code/covid/html/flaggen/secret/");


    $auswahl = readline('Auswahl: ');

    switch ($auswahl) {
        case 1:
            echo "Sie haben das \"Upper-Lower Covid\" gewählt!";
            include ("higherlower/HigerLower_programm.php");
            break;
        case 2:
            echo "Sie haben das \"Flaggen zu Länder\" gewählt!";
            include ("flaggenzuland/index.php");
            break;
        case 3:
            echo "Sie haben das \"Denis Secret\" gewählt!";
            break;
        default:
            echo "Dieses Secret gibt es nicht!";
    }

    print PHP_EOL;
    print PHP_EOL;
}