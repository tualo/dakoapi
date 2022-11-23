<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;


class ShipmentInfo extends DakoSend {
    public static  $shipmentURL='/index.php/api/tracking/shipment/X-API-KEY/{api_key}/api_secret/{api_secret}/tracking_id/'; // url aus doku
    public static function shipmentInfo(
        $t_id='0100256518889799'
    ){

        $result = RequestHelper::query(self::prepareURL( self::$shipmentURL).$t_id);

        return $result['result']['shipment'];
    }

}
