create table dako_statelist (
    state varchar(20) not null,
    status_code varchar(20) not null,
    primary key (state,status_code),
    label varchar(255) not null,
    is_visible tinyint default 0,
    restricted_to_products json
);

create table dako_state (
    state varchar(20) primary key
);

insert into dako_state (state) values ('NEW'), ('PROCESSING'), ('COMPLETE'), ('HOLD'), ('NONE');



CREATE TABLE `dako_status_history` (
  `id` varchar(50) NOT NULL,
  `state` varchar(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `timestamp` datetime NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`timestamp`)
);


CREATE TABLE `dako_status_history_query_stat` (
  `id` varchar(50) NOT NULL,

  `timestamp` datetime NOT NULL,
    PRIMARY KEY (`id`,`timestamp`)
);

create or replace view view_dako_api_syncsv_history as
select id from sv_daten where modell='Dako' and id not in (select id from dako_status_history_query_stat);


create or replace view view_dako_statelist_unsolved as 
select
distinct status
from (
select 
dako_status_history.*,
dako_statelist.state dako_statelist_state,
dako_statelist.status_code
from 
dako_status_history left join
dako_statelist on dako_statelist.label = dako_status_history.status
having dako_statelist.status_code is  null
  ) x;


create table sv_statistics_state_pairs (
    name varchar(255) not null,
    start_state varchar(10),
    stop_state varchar(10),
    primary key (start_state,stop_state)
    
)