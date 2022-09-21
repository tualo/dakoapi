<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;


class Shipments extends DakoSend {
    public static  $shipmentsURL='/index.php/api/tracking/shipments/X-API-KEY/{api_key}/api_secret/{api_secret}'; // url aus doku
    public static function shipments(
        $page='0'
    ){

        $result = RequestHelper::query(self::prepareURL( self::$shipmentsURL).'?page='.$page);

        return $result['result']['shipments'];
    }

}
