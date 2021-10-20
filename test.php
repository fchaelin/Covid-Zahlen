<?php

include("functions_covid.php");

$template = file_get_contents("template.html");

$areaName = $_GET['name'];

if (empty($areaName)) {
    echo "You need to provide an area name!";
} else {
    list($confirmed, $deaths, $photo) = landZahlen($areaName, false);
    $template = str_replace("{Section1}", "<h2>Area: " . $areaName . "</h2>", $template);
    $template = str_replace("{Section2}", "<h3>Confirmed: " . $confirmed . "</h3>", $template);
    $template = str_replace("{Section3}", "<h3>Deaths: " . $deaths . "</h3>", $template);
    $template = str_replace("{Section4}", "<img width='100%' height='100%' src=' " . $photo . " '/>", $template);
    echo $template;
}
