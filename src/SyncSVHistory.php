<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\StatusControl as DStatusControl; 


class SyncSVHistory extends StatusHistory {
    public static function syncSVHistory(  ){
        $db = App::get('session')->getDB();    
        try{
            DStatusControl::init();

            $list=$db->direct('select * from view_dako_api_syncsv_history limit 10',[]);
            $res=[];
            foreach($list as $item){

                $history = self::statusHistory($item['id']);
                foreach($history as $elem){
                    $sql = 'insert into dako_status_history (id,state,status,timestamp,details,note)
                    values ({id},{state},{status},{timestamp},{details},{note})
                    on duplicate key update 
                        state=values(state),
                        status=values(status),
                        timestamp=values(timestamp),
                        details=values(details),
                        note=values(note)
                    ';

                    $elem['id']=$item['id'];

                    
                    $db->direct($sql,$elem);
                }
            }
            App::result('success',true);
        }catch(\Exception $e){
            App::result('msg',$e->getMessage());
            App::result('success',false);
        }
}

}
