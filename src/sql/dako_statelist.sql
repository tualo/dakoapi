create table dako_statelist (
    state varchar(20) not null,
    status_code varchar(20) not null,
    primary key (state,status_code),
    label varchar(255) not null,
    is_visible tinyint default 0,
    restricted_to_products json
);