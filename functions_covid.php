<?php

function writeFile($filename, $total, $totaldeaths)
{
    $template = file_get_contents("template.html");
    $template = str_replace("{Section1}", "<h2>Confirmed: " . $total . "</h2>", $template);
    // $template = str_replace("{Section1.Content}", $total, $template);
    $template = str_replace("{Section2.Title}", "<h2>Deaths</h2>", $template);
    $template = str_replace("{Section2.Content}", $totaldeaths, $template);
    $template = str_replace("{Section3.Title}", "", $template);
    $template = str_replace("{Section3.Content}", "", $template);
    // echo $template;
    $myfile = fopen(htmls/$filename, "w") or die("Unable to open file!");
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
function landZahlen($land)
{
    $url = "https://covid2019-api.herokuapp.com/v2/country/";
    if (!empty($land)) {
        $country = $land;
    } else {
        $country = readline("Land: ");
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
            case "ch":
                $country = "switzerland";
                break;
            default:
                $country = $country;
        }
    }
    $url .= $country;
    $response = loadData($url);
    //print_r($response);
    print PHP_EOL;

    $confirmed = $response['data']['confirmed'];
    $deaths = $response['data']['deaths'];
    //$recovered = $response['data']['recovered'];
    //$active = $response['data']['active'];

    printf("Confirmed: %d" . PHP_EOL, $confirmed);
    printf("Deaths: %d" . PHP_EOL, $deaths);
    //printf("Recovered: %d" . PHP_EOL, $recovered);
    //printf("Active: %d" . PHP_EOL, $active);
    writeFile($country . ".html", $confirmed, $deaths);
}

function globaleZahlen()
{
    $url = "https://covid2019-api.herokuapp.com/v2/total";
    $response = loadData($url);
    $total = $response['data']['confirmed'];
    $totaldeaths = $response['data']['deaths'];
    printf("Total confirmed: %d" . PHP_EOL, $total);
    printf("Total deaths: %d" . PHP_EOL, $totaldeaths);
    writeFile("global.html", $total, $totaldeaths);
}

function vergangeneZahlen()
{

    $requestedDate = readline("Datum (: ");

    $url = "https://covid2019-api.herokuapp.com/v2/timeseries/confirmed";

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
        //print_r($response);
        print PHP_EOL;


    }


}
