<?php

function writeFile($areaName, $confirmed, $deaths)
{
    $template = file_get_contents("template.html");

    $template = str_replace("{Section1}", "<h2>Area: " . $areaName . "</h2>", $template);
    $template = str_replace("{Section2}", "<h2>Confirmed: " . $confirmed . "</h2>", $template);
    $template = str_replace("{Section3}", "<h2>Deaths: " . $deaths . "</h2>", $template);

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
    $response = array_change_key_case($response, CASE_UPPER);
    $country = strtoupper($country);

    if (in_array($country, $response['DATA'])) {
        if (strlen($country) == 2) {
            $country = $response['DATA'][$country]['COUNTRY'];
            echo "if strlen erfolgreich";
        }
        echo "if in array erfolgreich";
    }
    echo $country;
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


function vergangeneZahlen()
{

    $requestedCountry = readline("Land: ");
    $requestedDate = readline("Datum m(m)/d(d)/yyyy: ");

    $urlConfirmed = "https://covid2019-api.herokuapp.com/v2/timeseries/confirmed";

    $responseConfirmed = loadData($urlconfirmed);
    $responseDeaths = loadData($urldeaths);

    $confirmedDate = $responseConfirmed['data']['TimeSeries'];
    printf("Confirmed: %d" . PHP_EOL, $responseConfirmed);
    printf("Deaths: %d" . PHP_EOL, $responseDeaths);

    writeFile($requestedCountry, $confirmedDate, $deathsConfirmed);

}


