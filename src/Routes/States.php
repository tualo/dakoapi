<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\StatusList;


class States implements IRoute{
    public static function register(){

       BasicRoute::add('/dako/statelist',function($matches){
        StatusList::init();
        App::contenttype('application/json');
        App::result('shipmentStates',StatusList::shipmentStates());
        },array('get','post'),true);

       BasicRoute::add('/dako/statelist/(?P<type>(NEW|PROCESSING|COMPLETE|HOLD|NONE))',function($matches){
        App::contenttype('application/json');
        StatusList::init();
        App::result('shipmentStates',StatusList::shipmentStates($matches['type']));
        },array('get','post'),true);
       
    }
}