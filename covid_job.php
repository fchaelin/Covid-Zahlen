<?php

chdir("/opt/code/covid/");

include("functions_covid.php");

$eingabe = $argv[1];

switch ($eingabe) {
    case '0':
        $land = $argv[2];
        landZahlen($land);
        break;
    case '1':
        globaleZahlen();
        break;
    case '2':
        $land = $argv[2];
        vergangeneZahlen($land);
        break;
    case '3':
        pass;
        break;
    default:
}
