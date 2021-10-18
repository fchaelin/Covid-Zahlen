<?php

function landZahlen()
{
    $url = "https://covid2019-api.herokuapp.com/v2/country/";
    $country = readline("Land: ");
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
        $recovered = $response['data']['recovered'];
        $active = $response['data']['active'];


        printf("Confirmed: %d" . PHP_EOL, $confirmed);
        printf("Deaths: %d" . PHP_EOL, $deaths);
        printf("Recovered: %d" . PHP_EOL, $recovered);
        printf("Active: %d" . PHP_EOL, $active);
    }
}
