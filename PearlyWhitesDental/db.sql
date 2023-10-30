create table users
( userType int unsigned not null,
  userId int unsigned not null auto_increment primary key,
  name varchar(50) not null,
  email varchar(255) not null,
  password varchar(40) not null
);

ALTER TABLE users AUTO_INCREMENT=1001;

create table appointments
( apptId int unsigned not null auto_increment primary key,
  userId int unsigned not null,
  dentistId int unsigned not null,
  date date not null,
  time char(50) not null,
  serviceType char(50) not null
);

/* insert dentists accounts into users table */
insert into users values (9, 1000, "admin", "admin@admin.com", "admin");