<?php

function landZahlen()
{
    $url = "https://covid2019-api.herokuapp.com/v2/country/";
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

    $url .= $country;

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

        $confirmed = $response['data']['confirmed'];
        $deaths = $response['data']['deaths'];
        //$recovered = $response['data']['recovered'];
        //$active = $response['data']['active'];

        printf("Confirmed: %d" . PHP_EOL, $confirmed);
        printf("Deaths: %d" . PHP_EOL, $deaths);
        //printf("Recovered: %d" . PHP_EOL, $recovered);
        //printf("Active: %d" . PHP_EOL, $active);
    }
}

function globaleZahlen()
{
    $url = "https://covid2019-api.herokuapp.com/v2/total";

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

        $total = $response['data']['confirmed'];
        $totaldeaths = $response['data']['deaths'];
        //$totalrecovered = $response['data']['recovered'];
        //$totalactive = $response['data']['active'];

        printf("Total confirmed: %d" . PHP_EOL, $total);
        printf("Total deaths: %d" . PHP_EOL, $totaldeaths);
        //printf("Total recovered: %d" . PHP_EOL, $totalrecovered);
        //printf("Total active: %d" . PHP_EOL, $totalactive);
    }
}
