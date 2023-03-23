create or replace view view_dako_status_history_sync_list as 
select 
dako_status_history.*,
dako_statelist.state dako_statelist_state,
dako_statelist.status_code,
sc.code,
sc.beschreibung
from 
dako_status_history  join
dako_statelist on dako_statelist.label = dako_status_history.status
join (select max(code) code ,beschreibung,hybrilog from sendungscodes group by hybrilog) sc
on sc.hybrilog = dako_statelist.status_code
order by id,timestamp 
//

CREATE OR REPLACE PROCEDURE `loop_sv_stati_dako_status_history_sync_list`( )
    MODIFIES SQL DATA
BEGIN 

	FOR date_record in (select * from view_dako_status_history_sync_list) DO
        if not exists(select id from sv_stati where (id,datum,zeit) = (date_record.id,
                cast(date_record.timestamp as date),
                cast(date_record.timestamp as time)) ) 
        then
            select date_record.id,' append ' m;
            insert ignore into sv_stati (ID,DATUM,ZEIT,status,LOGIN) values (
                date_record.id,
                cast(date_record.timestamp as date),
                cast(date_record.timestamp as time),
                date_record.code,
                'dako-status-import'
            );
        else
            select date_record.id,'not set ' m;
        end if;
    END FOR;
END