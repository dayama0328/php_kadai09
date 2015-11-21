create database image_bbs;

use image_bbs;


grant all on image_bbs.* to testuser@localhost identified by '9999';

create table posts (
id int primary key auto_increment,
create_at datetime,
name varchar(32),
image_name varchar(255),
img_data varchar(255)
);

