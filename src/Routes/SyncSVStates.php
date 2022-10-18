<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\SyncSVStates as DSyncSVStates; 


class SyncSVStates implements IRoute{
    public static function register(){
       BasicRoute::add('/dako/syncvstates',function($matches){
        App::contenttype('application/json');    
        DSyncSVStates::syncSVStates();
        },['get'],true);
    }
}

