<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\StatusControl as DStatusControl; 


class StatusControl implements IRoute{
    public static function register(){
       BasicRoute::add('/dako/setstate/(?P<tracking_id>(\d){16})/(?P<code>(\d)+)',function($matches){
        App::contenttype('application/json');    
        $db = App::get('session')->getDB();    
        try{
            DStatusControl::init();
            $datetime=(new \DateTime())->format('Y-m-d H:i:s');
            $public_note='';
            $tracking_id=$db->singleValue('select id from sv_daten where id={tracking_id} ',$matches,'id');
            $code=$db->singleValue('select hybrilog from sendungscodes where code={code}',$matches,'hybrilog');
            if ($code===false) throw new \Exception("Der Code wurde nicht gefunden");
            if ($tracking_id===false) throw new \Exception("Die Sendung wurde nicht gefunden");
            App::result('result',DStatusControl::do_transition($tracking_id,$code,$datetime,$public_note));
            App::result('success',true);
        }catch(\Exception $e){
            App::result('msg',$e->getMessage());
            App::result('success',false);
        }
        },array('get','post'),true);


    }
}

