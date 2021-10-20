<?php

include ("functions_covid.php");

function whichIsHigherFrage()
{
    /* $urlLandFall = "https://covid2019-api.herokuapp.com/v2/country/"; */
    $urlLandListe = "https://api.first.org/data/v1/countries?limit=285&pretty=true";
    /* $responseLandFall = loadData($urlLandFall); */
    $responseLandListe = loadData($urlLandListe);

    $punkte = 0;

    while($punkte == 0){
        $countryNum1 = random_int(0, 278);
        $countryNum2 = random_int(0, 278);

        if ($countryNum1 != $countryNum2){

            $country1 = $responseLandListe['data'][$countryNum1]['country'];
            $country2 = $responseLandListe['data'][$countryNum2]['country'];

            $urlLandFallCountry1 = "https://covid2019-api.herokuapp.com/v2/country/" . $country1;
            $urlLandFallCountry2 = "https://covid2019-api.herokuapp.com/v2/country/" . $country2;

            $responseLandFallCountry1 = loadData($urlLandFallCountry1);
            $responseLandFallCountry2 = loadData($urlLandFallCountry2);

            $country1Fall = $responseLandFallCountry1['data']['confirmed'];
            $country2Fall = $responseLandFallCountry2['data']['confirmed'];

            printf("1. %s", $country1);
            PHP_EOL;
            printf("2. %s", $country2);
            PHP_EOL;
            $input = readline("Land 1 oder 2? > ");

            if ($country1Fall > $country2Fall){
                if ($input == 1){
                    echo "richtig";
                    system('clear');
                } elseif ($input == 2){
                    echo "falsch";
                    $punkte--;
                } else {
                    echo "ungültige eingabe";
                }
            } elseif ($country1Fall < $country2Fall){
                if ($input == 1){
                    echo "falsch";
                    $punkte--;
                } elseif ($input == 2){
                    echo "richtig";
                    system('clear');
                } else {
                    echo "ungültige eingabe";
                }
            }


        }

    echo ":(";













    }



}
