<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\StatusControl as DStatusControl; 


class SyncSVStates extends DakoSend {
    public static function syncSVStates(  ){
        $db = App::get('session')->getDB();    
        try{
            DStatusControl::init();
 

            $list=$db->direct('select * from view_dako_api_syncsv_state',[]);
            $res=[];
            foreach($list as $item){
                $datetime=$item['dt'];
                $public_note='';
                $tracking_id=$item['id'];
                $code=$item['hybrilog'];

                try{
                    $res[]=[
                        'id'=>$item['id'],
                        'dako'=>DStatusControl::do_transition($tracking_id,$code,$datetime,$public_note)
                    ];
                }catch(\Exception $e){
                    $item['msg']=substr($e->getMessage(),0,255);
                    $res[]=[
                        'id'=>$item['id'],
                        'dako'=>$item['msg']
                    ];
                    $db->direct('insert into sv_stati_dako_errors (id,datum,zeit,status,msg) values (
                        {id},{datum},{zeit},{status},{msg}
                    )',$item);
                }
                $db->direct('update sv_stati set sync_hub=now() where id={id} and datum = {datum} and zeit = {zeit}',$item);
            }
            
            App::result('result',$res);
            App::result('success',true);
        }catch(\Exception $e){
            App::result('msg',$e->getMessage());
            App::result('success',false);
        }
    }

}
