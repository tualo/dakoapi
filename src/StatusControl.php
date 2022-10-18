<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;


class StatusControl extends DakoSend {
    public static  $shipmentURL='/index.php/api/statuscontrol/do_transition';
    public static function do_transition($tracking_id,$code,$datetime,$public_note=''){

        $db = App::get('session')->getDB();

        $result = RequestHelper::query(self::prepareURL( self::$shipmentURL ),[
            'api_secret'=>self::$api_secret,
            'X-API-KEY'=>self::$api_key,
            'tracking_id'=>$tracking_id,
            'status_data'=>[
                'status_code'=>$code,
                'datetime'=>$datetime,
                'public_note'=>$public_note
            ]
        ]);
        if ($result['status']=='success'){
            return $result['result'];
        }else{
            throw new \Exception($result['result']['messages'][0]['text']);
        }

    }

}
