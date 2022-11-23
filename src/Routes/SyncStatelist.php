<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\SyncStatelist as DSyncStatelist; 


class SyncStatelist implements IRoute{
    public static function register(){
       BasicRoute::add('/dako/syncstatelist',function($matches){
        App::contenttype('application/json');    
        DSyncStatelist::syncStatelist();
        },['get'],true);
    }
}

