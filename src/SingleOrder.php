<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;


class SingleOrder extends DakoSend {
    public static  $shipmentURL='/index.php/api/sales/order';
    public static function singleOrder($request){

        $db = App::get('session')->getDB();
        $id = $db->singleValue('select uuid() id',[],'id');

        // Idee, hinter diese ID legen wir den Kunden ab, da dieser noch nicht in der API hinterkegt werden kann.
        

        $result = RequestHelper::query(self::prepareURL( self::$shipmentURL),
            [
                'api_secret'=>self::$api_secret,
                'X-API-KEY'=>self::$api_key,
                "shipment"=>[
                    "product_key" => "parcel_small-1",
                    "product_category"=>  "PAKET",
                    "width" => self::defaults($request,'width',30),
                    "length"=> self::defaults($request,'length',30),
                    "height"=> self::defaults($request,'height',30),
                    "weight"=> self::defaults($request,'weight',5),
                    "services" => [
                        /*
                        "insurance-1",
                        "express-3"
                        */
                    ]
                ],
                "destination" => [
                    "prefix"            => self::defaults($request,'destination_prefix',''),
                    "firstname"         => self::defaults($request,'destination_firstname',''),
                    "lastname"          => self::defaults($request,'destination_lastname',''),
                    "company"           => self::defaults($request,'destination_company',''),
                    "street"            => self::defaults($request,'destination_street',''),
                    "street_number"     => self::defaults($request,'destination_housenumber',''),
                    "postcode"          => self::defaults($request,'destination_zipcode',''),
                    "city"              => self::defaults($request,'destination_city',''),
                    "district"          => self::defaults($request,'destination_district',''),
                    "country_id"        => self::defaults($request,'destination_country','DE'),
                    "telephone"         => self::defaults($request,'destination_phone',''),
                    "email"             => self::defaults($request,'destination_email',''),
                    "note"              => self::defaults($request,'destination_notes','')
                ],
                "sender"    => [
                    "prefix"            => self::defaults($request,'sender_prefix',''),
                    "firstname"         => self::defaults($request,'sender_firstname',''),
                    "lastname"          => self::defaults($request,'sender_lastname',''),
                    "company"           => self::defaults($request,'sender_company',''),
                    "street"            => self::defaults($request,'sender_street',''),
                    "street_number"     => self::defaults($request,'sender_housenumber',''),
                    "postcode"          => self::defaults($request,'sender_zipcode',''),
                    "city"              => self::defaults($request,'sender_city',''),
                    "district"          => self::defaults($request,'sender_district',''),
                    "country_id"        => self::defaults($request,'sender_country','DE'),
                    "telephone"         => self::defaults($request,'sender_phone',''),
                    "email"             => self::defaults($request,'sender_email',''),
                ],
                "content"           => self::defaults($request,'content',''),
                "desired_date"      => self::defaults($request,'desire_date',''),
                "desired_time_from" => self::defaults($request,'desire_time_from','10:00:00'),
                "desired_time_to"   => self::defaults($request,'desire_time_to','18:00:00'),
                "reference"         => $id,
                "create_label"      => "0",
                "callback_url"      => str_replace('{id}',$id,DAKO_CALLBACK_URL),
                "payload"           => ""
            ]
        );
        return $result['result'];
    }

}
