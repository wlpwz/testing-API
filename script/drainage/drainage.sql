use `project_ktv`;

-- 
drop table if exists `tb_drainage`;
create table if not exists `tb_drainage` (
    `id` int unsigned auto_increment primary key,
    `pid` int(5) unsigned not null,
    `disp_name` varchar(40) unique not null,  -- 
    `applicant` varchar(30) not null default 'nobody',
    `dtype` varchar(20) not null default 'none',
    `start_t` datetime not null default '0000-00-00 00:00:00',
    `end_t` datetime ,
    `dur_hour` tinyint(2) not null default 0,
    `dur_minute` tinyint(2) not null default 0,
    `destination` varchar(50) not null default '127.0.0.1',
    `port` smallint unsigned not null default 9999
) engine=InnoDB default charset=utf8;

-- delimiter $$
-- drop trigger if exists fix_end_time;
create trigger fix_end_time
before insert on tb_drainage
for each row
set new.end_t = date_add(new.start_t, interval concat(new.dur_hour,':',new.dur_minute) hour_minute);
-- begin
-- 	set new.end_t = date_add(new.start_t, interval concat(new.dur_hour,':',new.dur_minute) hour_minute);
-- end$$
-- delimiter ;

-- insert into tb_drainage(pid, disp_name, start_t, dur_hour, dur_minute) values
-- (1, 'a', now(), 1, 1),
-- (2, 'b', now(), 10, 20);
