create table dako_shipment_item (
    tracking_id_0 varchar(20) primary key,
    tracking_id_1 varchar(20) default null,
    tracking_id_2 varchar(20) default null,
    product_category varchar(30) default null,
    status_code integer default null,
    status varchar(255) default null,
    scheduled_execution_date_from date  default null,
    scheduled_execution_date_to date  default null,
    scheduled_execution_time_from time  default null,
    scheduled_execution_time_to time  default null,
    state varchar(20)  default null,
    reference varchar(50) default null,
    content varchar(50) default null,
    created_at datetime default null,
    insurance_sum decimal(15,6) default null,
    width decimal(15,6) default null,
    length decimal(15,6) default null,
    height decimal(15,6) default null,

    weight decimal(15,6) default null,
    
    insert_datetime datetime default current_timestamp
)