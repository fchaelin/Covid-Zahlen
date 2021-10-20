<?php

chdir("/opt/code/covid/");

include("functions_covid.php");

if (!empty($argv[1])) {
    if ($argv[1] == 0) {
        $eingabe = $argv[1];
    } elseif ($argv[1] == 1) {
        $eingabe = $argv[1];
    } elseif ($argv[1] == 2) {
        $eingabe = $argv[1];
    } elseif ($argv[1] == 3) {
        $eingabe = $argv[1];
    } elseif ($argv[1] == 1234567890) {
        $eingabe = $argv[1];
    } else {
        $eingabe = readline("Welches Programm 0-3: ");
    }
} else {
    $eingabe = readline("Welches Programm: ");
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
        //globalDatumZahlen();
        break;
    case '1234567890':
        include("secret/functions_covid.php");

    default:
}
