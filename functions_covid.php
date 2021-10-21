<?php

function writeFile($areaName, $confirmed, $deaths)
{
    $template = file_get_contents("template.html");

    $filename = $areaName . ".html";

    $template = str_replace("{Section1}", "<h2>Area: " . $areaName . "</h2>", $template);
    $template = str_replace("{Section2}", "<h3>Confirmed: " . $confirmed . "</h3>", $template);
    $template = str_replace("{Section3}", "<h3>Deaths: " . $deaths . "</h3>", $template);
    $template = str_replace("{Section4}", "", $template);

    chdir("/opt/code/covid/html/");

    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile, $template);
    fclose($myfile);
}

function writeFile2($areaName, $confirmed, $deaths, $photo)
{
    $template = file_get_contents("template.html");

    $template = str_replace("{Section1}", "<h2>Area: " . $areaName . "</h2>", $template);
    $template = str_replace("{Section2}", "<h3>Confirmed: " . $confirmed . "</h3>", $template);
    $template = str_replace("{Section3}", "<h3>Deaths: " . $deaths . "</h3>", $template);

    $template = str_replace("{Section4}", "<img src='" . $photo . "' alt='asdfd'>", $template);

    $filename = $areaName . ".html";

    chdir("/opt/code/covid/html/");

    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile, $template);
    fclose($myfile);
}

function loadData($url)
{
    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($code == 200) {
        $response = json_decode($response, true);
    } else {
        $response = "fail";
    }
    return $response;
}

function landLang($country)
{
    $url = "https://api.first.org/data/v1/countries?pretty=true&limit=400";
    $response = loadData($url);
    $country = strtoupper($country);
    $response2 = $response['data'];

    foreach ($response2 as $index => $value) {
        if (strcmp($index, $country) == 0) {
            $country = $response['data'][$country]['country'];
            break;
        }
    }

    return $country;
}

function landKurz($land)
{
    $url = "https://api.first.org/data/v1/countries?pretty=true&limit=400";
    $response = loadData($url);
    $land = strtolower($land);
    $country = ucfirst($land);
    $response2 = $response['data'];

    foreach ($response2 as $index => $value) {
        if (strcmp($response2[$index]['country'], $country) == 0) {
            $countryKurz = $index;
            break;
        }
    }
    $countrykurz = ucfirst($countryKurz);
    return $countryKurz;
}

function landZahlen($land, $cache = true)
{
    if (!empty($land)) {
        $country = landLang($land);
    } else {
        $country = readline("Land: ");
    }

    switch ($country) {
        case "usa":
            $country = "us";
            break;
        case "america":
            $country = "us";
            break;
        case "united states of america":
            $country = "us";
            break;
        default:
            $country = $country;
    }

    $url = "https://covid2019-api.herokuapp.com/v2/country/";
    $url .= $country;
    $response = loadData($url);

    $confirmed = $response['data']['confirmed'];
    $deaths = $response['data']['deaths'];
    $photo = landBild($country);
    if ($cache) {
        printf("Confirmed: %d" . PHP_EOL, $confirmed);
        printf("Deaths: %d" . PHP_EOL, $deaths);
        writeFile2($country, $confirmed, $deaths, $photo);
    } else {
        return array($confirmed, $deaths, $photo);
    }
}

function globaleZahlen()
{
    $url = "https://covid2019-api.herokuapp.com/v2/total";
    $response = loadData($url);
    $confirmed = $response['data']['confirmed'];
    $deaths = $response['data']['deaths'];
    printf("Total confirmed: %d" . PHP_EOL, $confirmed);
    printf("Total deaths: %d" . PHP_EOL, $deaths);
    writeFile("global", $confirmed, $deaths);
}

function landDatumZahlen($land, $requestedDate)
{
    if (!empty($land)) {
        $country = landLang($land);
    } else {
        $country = readline("Land: ");
    }

    if ($requestedDate == 0) {
        $requestedDate = readline("Datum m(m)/d(d)/yy: ");
    }

    switch ($country) {
        case "usa":
            $country = "us";
            break;
        case "america":
            $country = "us";
            break;
        case "united states of america":
            $country = "us";
            break;
        default:
            $country = $country;
    }

    //$requestedCountry = readline("Land: ");


    $url = "https://covid2019-api.herokuapp.com/v2/timeseries/confirmed";
    $url2 = "https://covid2019-api.herokuapp.com/timeseries/deaths";

    $response = loadData($url);
    $response2 = loadData($url2);

    $country = strtolower($country);
    $country = ucfirst($country);

    //strcmp($index, $country) == 0

    foreach ($response['data'] as $index => $value) {
        $countryName = $value['Country_Region'];

        if (strcmp($country, $countryName) == 0) {
            $countryNumber = $index;
            break;
        }
    }

    foreach ($response['data'][$countryNumber]['TimeSeries'] as $index => $value) {
        $dateName = $value['date'];

        if (strcmp($requestedDate, $dateName) == 0) {
            $dateNumber = $index;
            break;
        }
    }

    $confirmed = $response['data'][$countryNumber]['TimeSeries'][$dateNumber]['value'];
    $deaths = $response2['deaths'][$countryNumber][$requestedDate];
    printf("Confirmed: %d" . PHP_EOL, $confirmed);
    printf("Deaths: %d" . PHP_EOL, $deaths);

    echo PHP_EOL;
    echo PHP_EOL;

    //writeFile($country, $requestedDate, $confirmed);
}

function globalDatumZahlen($requestedDate)
{
    if ($requestedDate == 0) {
        $requestedDate = readline("Datum m(m)/d(d)/yy: ");
    }
    $url = "https://covid2019-api.herokuapp.com/v2/timeseries/confirmed";

    $response = loadData($url);


    $summeConfirmed = 0;

    foreach ($response['data'] as $index => $value) {
        foreach ($value['TimeSeries'] as $index2 => $value2) {
            $dateName = $value2['date'];

            if (strcmp($requestedDate, $dateName) == 0) {
                $summeConfirmed += $value2['value'];

            }
        }
    }

    printf("Confirmed: %d" . PHP_EOL, $summeConfirmed);
}

function landBild($country)
{
    if (strlen($country) != 2){
        $country = landKurz($country);
    } else {
        $country = $country;
    }
    $countryKurz = strtolower($country);

    $photo = "https://www.countryflags.io/" . $countryKurz . "/shiny/64.png";
    // echo $photo;
    return $photo;
}
