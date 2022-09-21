<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\DakoSend;


class Route implements IRoute{
    public static function register(){

        BasicRoute::add('/dako/products',function($matches){
            App::contenttype('application/json');
            try{
                DakoSend::init();
                App::result('products',DakoSend::products());
                App::result('success',true);
            }catch(\Exception $e){
                App::result('msg',$e->getMessage());
                App::result('success',true);
            }
        },array('get','post'),true);

        BasicRoute::add('/dako/services',function($matches){
            App::contenttype('application/json');
            try{
                DakoSend::init();
                App::result('services',DakoSend::services());
                App::result('success',true);
            }catch(\Exception $e){
                App::result('msg',$e->getMessage());
                App::result('success',true);
            }
        },array('get','post'),true);
    }
}