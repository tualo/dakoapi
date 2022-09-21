<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;


class ProviderRoute extends DakoSend {
    public static  $shipmentsURL='/index.php/api/providers/route'; 
    public static function providerRoute( ){

        $result = RequestHelper::query(self::prepareURL( self::$shipmentsURL),[
            "X-API-KEY"=>self::$api_key,
            "api_secret"=>self::$api_secret,
            "shipment"=>[
                "product_key" => "parcel_small-1",
                  "product_category"=>  "PAKET",
                  "width" => 30,
                  "length"=> 50,
                  "height"=> 50,
                  "weight"=> 8,
                  "services" => [
                    "insurance-1",
                    "express-3"
                  ]
            ],
            "destination" => [
                  "prefix" => "Herr",
                  "firstname" => "Thomas",
                  "lastname" => "Mustermann",
                  "company" => "tualo solutions GmbH",
                  "street" => "Karl-Liebknecht-Str.",
                  "street_number" => "1d",
                  "postcode" => "07546",
                  "city" => "Gera",
                  "district" => "",
                  "country_id" => "DE",
                  "telephone" => "",
                  "email" => "thomas.hoffmann@tualo.de",
                  "note" => "Delivery note"
            ]
            
        ]);

        return $result['result']['route'];
    }

}
