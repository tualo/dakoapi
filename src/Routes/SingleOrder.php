<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\SingleOrder as DSingleOrder; 


class SingleOrder implements IRoute{
    public static function register(){

       BasicRoute::add('/dako/singleOrder',function($matches){
        App::contenttype('application/json');        
        try{
            if (!defined('DAKO_CALLBACK_URL')){
                throw new \Exception("DAKO_CALLBACK_URL is not set");
            }

            DSingleOrder::init();
            App::result('singleOrder',DSingleOrder::singleOrder($_REQUEST));
        }catch(\Exception $e){
            App::result('msg',$e->getMessage());
            App::result('success',true);
        }
        },array('post'),true);


    }
}

