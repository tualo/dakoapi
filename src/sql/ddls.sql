
CREATE OR REPLACE VIEW `view_dako_api_syncsv_state` AS
select
    `sv_daten`.`id` AS `id`,
    `sv_stati`.`DATUM` AS `datum`,
    `sv_stati`.`ZEIT` AS `zeit`,
    `sv_stati`.`status` AS `status`,
    `sv_stati`.`LOGIN` AS `login`,
    `sv_daten`.`name` AS `name`,
    `sv_daten`.`strasse` AS `strasse`,
    `sv_daten`.`plz` AS `plz`,
    `sv_daten`.`ort` AS `ort`,
    `sv_daten`.`depot` AS `depot`,
    `sv_daten`.`weight` / 1000 AS `weight`,
    concat(`sv_stati`.`DATUM`, ' ', `sv_stati`.`ZEIT`) AS `dt`,
    `sendungscodes`.`hybrilog` AS `hybrilog`,
    `sendungscodes`.`BESCHREIBUNG` AS `beschreibung`
from
    (
        (
            `sv_daten`
            join `sv_stati` on(
                `sv_stati`.`ID` = `sv_daten`.`id`
                and `sv_stati`.`sync_hub` is null
                and `sv_stati`.`LOGIN` not in ('dako-import','dako-status-import')
            )
        )
        join `sendungscodes` on(
            `sv_stati`.`status` = `sendungscodes`.`CODE`
            and `sendungscodes`.`hybrilog` <> 200
        )
    )
where
    `sv_daten`.`modell` = 'dako'
    and `sv_daten`.`datum` > curdate() + interval -190 day
having
    `sv_daten`.`id` like '01%'
order by
    concat(`sv_stati`.`DATUM`, ' ', `sv_stati`.`ZEIT`) desc
limit
    100
;    


create table sv_stati_dako_errors (
  ID	varchar(50),
  DATUM	date,
  ZEIT	time,
  status	varchar(10),
  primary key (id,datum,zeit,status),
  msg varchar(255)
);