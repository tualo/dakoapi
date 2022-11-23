<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\ShipmentInfo as DShipmentInfo; 


class ShipmentInfo implements IRoute{
    public static function register(){

       BasicRoute::add('/dako/shipmentinfo/(?P<id>(\d+))',function($matches){
        App::contenttype('application/json');        
        try{
            DShipmentInfo::init();
            App::result('shipmentInfo',DShipmentInfo::shipmentInfo($matches['id']));
        }catch(\Exception $e){
            App::result('msg',$e->getMessage());
            App::result('success',true);
        }
        },array('get','post'),true);


    }
}

