<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\Shipments as DShimpents;


class Shipments implements IRoute{
    public static function register(){

       BasicRoute::add('/dako/products',function($matches){
        App::contenttype('application/json');
        try{
            DShimpents::init();
            App::result('products',DShimpents::shipments());
            App::result('success',true);
        }catch(\Exception $e){
            App::result('msg',$e->getMessage());
            App::result('success',true);
        }
       });

    }
}