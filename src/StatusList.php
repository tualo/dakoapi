<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;


class StatusList extends DakoSend {
    public static  $shipmentStatesURL='/index.php/api/statuscontrol/status_list'; // url aus doku
    public static function shipmentStates($type='NEW'){
        $result = RequestHelper::query(self::prepareURL( self::$shipmentStatesURL), [
            'state'=>$type,
            'api_secret'=>self::$api_secret,
            'X-API-KEY'=>self::$api_key
        ]);
        return $result['result']['status_list'];
    }

}
