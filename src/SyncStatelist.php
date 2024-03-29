<?php

namespace Tualo\Office\Dako;


use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\StatusControl as DStatusControl; 


class SyncStatelist extends StatusList {
    public static function syncStatelist(  ){
        $db = App::get('session')->getDB();    
        try{

            
            $keys = [ 'NEW', 'PROCESSING', 'COMPLETE', 'HOLD', 'NONE' ];
            DStatusControl::init();
            foreach($keys as $key){
                $list = self::shipmentStates($key);

                foreach($list as $item){
                    $sql = 'insert into dako_statelist 
                        (state,status_code,label,is_visible,restricted_to_products,manual) 
                        values ({state},{status_code},{label},{is_visible},{restricted_to_products},0)
                        on duplicate key update 
                        label=values(label),is_visible=values(is_visible),restricted_to_products=values(restricted_to_products),manual=values(manual)
                    ';
                    $item['state']=$key;

                    
                    if ($item['is_visible']=='') $item['is_visible']=0;
                    if (is_array($item['restricted_to_products'])) $item['restricted_to_products']=json_encode($item['restricted_to_products']);
                    if ($item['restricted_to_products']=='') $item['restricted_to_products']='[]';
                    $db->direct($sql,$item);
                }
                

            }
            
            App::result('success',true);
        }catch(\Exception $e){
            App::result('msg',$e->getMessage());
            App::result('success',false);
        }
    }

}
