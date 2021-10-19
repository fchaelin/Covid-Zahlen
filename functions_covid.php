<?php

function writeFile($areaName, $confirmed, $deaths)
{
    $template = file_get_contents("template.html");

    $template = str_replace("{Section1}", "<h2>Area: " . $areaName . "</h2>", $template);
    $template = str_replace("{Section2}", "<h3>Confirmed: " . $confirmed . "</h3>", $template);
    $template = str_replace("{Section3}", "<h3>Deaths: " . $deaths . "</h3>", $template);

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

function landKuerzel($country)
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

function landZahlen($land)
{
    if (!empty($land)) {
        $country = landKuerzel($land);
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
    printf("Confirmed: %d" . PHP_EOL, $confirmed);
    printf("Deaths: %d" . PHP_EOL, $deaths);
    writeFile($country, $confirmed, $deaths);
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

function landDatumZahlen($land)
{
    if (!empty($land)) {
        $country = landKuerzel($land);
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

    //$requestedCountry = readline("Land: ");
    $requestedDate = readline("Datum m(m)/d(d)/yyyy: ");

    $url = "https://covid2019-api.herokuapp.com/v2/timeseries/confirmed";
    $url2 = "https://covid2019-api.herokuapp.com/timeseries/deaths";

    $response = loadData($url);
    $response2 = loaata($url2);

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
    $deaths = $response2['deaths'][$countryNumber];
    printf("Confirmed: %d" . PHP_EOL, $confirmed);

    //writeFile($country, $requestedDate, $confirmed);
}

function globalDatumZahlen()
{
    echo "Test";
}
