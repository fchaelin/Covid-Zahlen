<?php

chdir("/opt/code/covid/");

include("functions_covid.php");

if (empty($argv[1])) {
    print PHP_EOL;

    echo 'Programmauswahl';
    print PHP_EOL;
    echo '***************';
    print PHP_EOL;
    echo '0 Länder-Gesamtzahlen';
    print PHP_EOL;
    echo '1 Global-Zahlen';
    print PHP_EOL;
    echo '2 Länder-Datumszahlen';
    print PHP_EOL;
    echo '3 Globale-Datumszahlen';
    print PHP_EOL;

    $eingabe = readline('Auswahl: ');

    print PHP_EOL;
    print PHP_EOL;
} else {
    if ($argv[1] == 0) {
        $eingabe = $argv[1];
    } elseif ($argv[1] == 1) {
        $eingabe = $argv[1];
    } elseif ($argv[1] == 2) {
        $eingabe = $argv[1];
    } elseif ($argv[1] == 3) {
        $eingabe = $argv[1];
    } else {
        print PHP_EOL;

        echo 'Programmauswahl:';
        print PHP_EOL;
        echo '***************';
        print PHP_EOL;
        echo '0 Länder-Gesamtzahlen';
        print PHP_EOL;
        echo '1 Global-Zahlen';
        print PHP_EOL;
        echo '2 Länder-Datumszahlen';
        print PHP_EOL;
        echo '3 Globale-Datumszahlen';
        print PHP_EOL;

        $eingabe = readline('Auswahl: ');

        print PHP_EOL;
        print PHP_EOL;
    }
}


switch ($eingabe) {
    case '0':
        if (!empty($argv[2])) {
            $land = $argv[2];
        } else {
            $land = readline("Land: ");;
        }
        landZahlen($land);
        break;
    case '1':
        globaleZahlen();
        break;
    case '2':
        if (!empty($argv[2])) {
            $land = $argv[2];
        } else {
            $land = readline("Land: ");;
        }

        if (!empty($argv[3])) {
            $requestedDate = $argv[3];
        } else {
            $requestedDate = readline("Datum m(m)/d(d)/yy: ");
        }
        landDatumZahlen($land, $requestedDate);
        break;
    case '3':
        if (!empty($argv[2])) {
            $requestedDate = $argv[2];
        } else {
            $requestedDate = readline("Datum m(m)/d(d)/yy: ");
        }
        globalDatumZahlen($requestedDate);
        break;
    default:
}
