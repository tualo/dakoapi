<?php
namespace Tualo\Office\Dako\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;
use Tualo\Office\Dako\StatusControl as DStatusControl; 


class SynSVStates implements IRoute{
    public static function register(){
       BasicRoute::add('/dako/syncvstates',function($matches){
        App::contenttype('application/json');    
        $db = App::get('session')->getDB();    
        try{
            DStatusControl::init();
            /*

            create or replace view view_dako_api_syncsv_state as 
select
    `sv_daten`.`id` AS `id`,
    sv_stati.datum,
    sv_stati.zeit,
    sv_stati.login,
    `sv_daten`.`name` AS `name`,
    `sv_daten`.`strasse` AS `strasse`,
    `sv_daten`.`plz` AS `plz`,
    `sv_daten`.`ort` AS `ort`,
    `sv_daten`.`depot` AS `depot`,
    `sv_daten`.`weight` / 1000 AS `weight`,
    concat(sv_stati.datum,' ' ,sv_stati.zeit) dt,
    
    sendungscodes.hybrilog,
    sendungscodes.beschreibung
from
    (
        `sv_daten`
        join `sv_stati` on (`sv_stati`.`ID` = `sv_daten`.`id` and sv_stati.sync_hub is null and sv_stati.login<>'dako-import')
        join sendungscodes on sv_stati.status = sendungscodes.code and sendungscodes.hybrilog <> 200
      	
    )
    
where
    `sv_daten`.`modell` = 'dako'
    and `sv_daten`.`datum` > curdate() + interval -16 day

having id like '01%'    
order by dt desc

            create table sv_stati_dako_errors (
  ID	varchar(50),
  DATUM	date,
  ZEIT	time,
  status	varchar(10),
  primary key (id,datum,zeit,status),
  msg varchar(255)
)*/

            $list=$db->direct('select * from view_dako_api_syncsv_state',[]);
            $res=[];
            foreach($list as $item){
                $datetime=$item['dt'];
                $public_note='';
                $tracking_id=$item['id'];
                $code=$item['hybrilog'];

                try{
                    $res[]=DStatusControl::do_transition($tracking_id,$code,$datetime,$public_note);
                }catch(\Exception $e){
                    $item['msg']=substr($e->getMessage(),0,255);
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
        },array('get','post'),true);


    }
}

