<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;


class SingleLabel extends DakoSend {
    public static  $shipmentURL='/index.php/api/sales/labels/X-API-KEY/{api_key}/api_secret/{api_secret}';
    public static function singleLabel($order_id){

        $db = App::get('session')->getDB();

        $result = RequestHelper::query(self::prepareURL( self::$shipmentURL).'?order_id='.$order_id);
        return $result['result'];
    }

}
