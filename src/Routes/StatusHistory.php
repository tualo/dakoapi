<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\StatusHistory as DStatusHistory; 


class StatusHistory implements IRoute{
    public static function register(){

       BasicRoute::add('/dako/statushistory',function($matches){
        App::contenttype('application/json');        
        try{
            DStatusHistory::init();
            App::result('statushistory',DStatusHistory::statusHistory());
        }catch(\Exception $e){
            App::result('msg',$e->getMessage());
            App::result('success',true);
        }
        },array('get','post'),true);


    }
}

