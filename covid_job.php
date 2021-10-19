<?php

chdir("/opt/code/covid/");

include("functions_covid.php");

$eingabe = $argv[1];
$land = $argv[2];
switch ($eingabe) {
    case '0':
        landZahlen($land);
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
