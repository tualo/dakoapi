<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;


class Shipments extends DakoSend {
    public static  $shipmentsURL='/index.php/api/tracking/shipments/X-API-KEY/{api_key}/api_secret/{api_secret}'; // url aus doku
    public static function shipments(
        $page='1',$period=''
    ){


        // period YYYY-MM-DD_YYYY-MM-DD
        $result = RequestHelper::query(self::prepareURL( self::$shipmentsURL).'?page='.$page);

        return $result['result']['shipments'];
    }

    public static function syncShipments(   ){

        $page=1;

        $date_interval = new \DateInterval( "P1D" );
        $date_interval->invert = 1;
        $start = new \DateTime();
        $start->add($date_interval);

        $period =  $start->format('Y-m-d').'_'.(new \DateTime())->format('Y-m-d');
        $result = RequestHelper::query(self::prepareURL( self::$shipmentsURL).'?page='.$page.'&period='.$period.'');

        return $result['result']['shipments'];
    }

}
