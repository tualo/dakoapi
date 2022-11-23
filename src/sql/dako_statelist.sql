create table dako_statelist (
    state varchar(20) not null,
    status_code varchar(20) not null,
    primary key (state,status_code),
    label varchar(255) not null,
    is_visible tinyint default 0,
    restricted_to_products json
);


CREATE TABLE `dako_status_history` (
  `id` varchar(50) NOT NULL,
  `state` varchar(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `timestamp` datetime NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`timestamp`)
);

create or replace view view_dako_api_syncsv_history as
select id from sv_daten where modell='Dako';