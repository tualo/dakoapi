<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\DakoSend;


class Route implements IRoute{
    public static function register(){

       BasicRoute::add('/dako/products',function($matches){
        DakoSend::init();
        App::set('products',DakoSend::products());
       });


       BasicRoute::add('/dako/services',function($matches){
       });


    }
}