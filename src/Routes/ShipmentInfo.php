<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\ShipmentInfo as DShipmentInfo; 


class ShipmentInfo implements IRoute{
    public static function register(){

       BasicRoute::add('/dako/shipmentinfo',function($matches){
        DShipmentInfo::init();
        App::contenttype('application/json');
        App::result('shipmentInfo',DShipmentInfo::shipmentInfo());
        },array('get','post'),true);


    }
}

