<?php

$url = "https://randomname.de/";

$params = array(
  "count" => "3",     // gewünschte Anzahl der Resultate
  "gender" => "b",    // männliche und weibliche User generieren
  "minAge" => "18",   // minimale Alter der Nutzer
  "format" => "json"  // Typ des Ausgabeformat
);

// Abhängig von der API, hier json
$headers = array(
    'Accept: application/json',
    'Content-Type: application/json',
);

$url .= '?' . http_build_query($params);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

# header('Content-Type: application/json; charset=utf-8');

if ($code == 200) {
    $response = json_decode($response, true);
    echo "Got " . count($response) . " entries ..." . PHP_EOL;
    // Show the json response array to find the keys ...
    print_r($response);
    // Loop over array items
    for ($i = 0; $i < count($response); $i++) {
        print PHP_EOL;
        // Output array item using the appropriate key
        printf("%s %s" . PHP_EOL, $response[$i]['firstname'], $response[$i]['lastname']);
        printf("%d %s" . PHP_EOL, $response[$i]['location']['zip'], $response[$i]['location']['city']);
        print PHP_EOL;
    }
} else {
    echo 'error ' . $code;
}
