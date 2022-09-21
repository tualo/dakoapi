<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;


class DakoSend {

    public static $api_secret​ = '';
    public static $api_key = '';
    public static $baseURL = '';

    public static $productsURL = '​/index.php​/api​/sales​/products​/X-API-KEY​/{api_key}​/api_secret​/{api_secret}';
    public static $servicesURL = '​/index.php​/api​/sales​/services/X-API-KEY​/{api_key}​/api_secret​/{api_secret}';


    public static function init(){
        if (self::$baseURL==''){
            if (defined('DAKO_URL')){
                self::$baseURL=DAKO_URL;
            }else{
                throw new \Exception("DAKO_URL is not set");
            }
        }

        if (self::$api_secret==''){
            if (defined('DAKO_API_SECRET')){
                self::$api_secret=DAKO_API_SECRET;
            }else{
                throw new \Exception("DAKO_API_SECRET is not set");
            }
        }
        if (self::$api_key==''){
            if (defined('DAKO_API_KEY')){
                self::$api_key=DAKO_API_KEY;
            }else{
                throw new \Exception("DAKO_API_KEY is not set");
            }
        }
    }

    public static function prepareURL($str){
        
        return self::$baseURL.str_replace('{api_secret}',self::$api_secret,str_replace('{api_key}',self::$api_key,$str));
    }


    public static function products(){
        $result = RequestHelper::query(self::prepareURL( self::$productsURL));
        return $result['products'];
    }
    public static function services(){
        $result = RequestHelper::query(self::prepareURL( self::$servicesURL));
        return $result['services'];
    }
}