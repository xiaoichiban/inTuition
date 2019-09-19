DROP TABLE IF EXISTS announcement;
DROP TABLE IF EXISTS reply;
DROP TABLE IF EXISTS thread;
DROP TABLE IF EXISTS flag;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS complain;
DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS bid;
DROP TABLE IF EXISTS task;
DROP TABLE IF EXISTS admin_account;
DROP TABLE IF EXISTS account;

CREATE TABLE account (
username VARCHAR(128) NOT NULL PRIMARY KEY,
password VARCHAR(128) NOT NULL,
name VARCHAR(128) NOT NULL,
about_me VARCHAR(1024) NOT NULL DEFAULT '',
email VARCHAR(128) UNIQUE NOT NULL,
avatar_path VARCHAR(1024) NOT NULL DEFAULT 'default.png',
last_login DATE,
date_registered DATE NOT NULL,
status VARCHAR(128) NOT NULL DEFAULT 'active'
);

CREATE TABLE admin_account (
username VARCHAR(128) NOT NULL PRIMARY KEY,
password VARCHAR(128) NOT NULL,
email VARCHAR(128) UNIQUE NOT NULL,
last_login DATE
);



CREATE TABLE message (
id int AUTO_INCREMENT PRIMARY KEY,
body VARCHAR(256) NOT NULL,
sender VARCHAR(128) NOT NULL REFERENCES account(username),
receiver VARCHAR(128) NOT NULL REFERENCES account(username),
datetimestamp DATETIME DEFAULT now() NOT NULL,
read_flag BOOLEAN NOT NULL DEFAULT FALSE
);








CREATE TABLE thread (
id int AUTO_INCREMENT PRIMARY KEY,
creator VARCHAR(128) NOT NULL,
datetimestamp DATETIME DEFAULT now() NOT NULL,
topic VARCHAR(64) NOT NULL,
body VARCHAR(256) NOT NULL,
status VARCHAR(16) NOT NULL
);


CREATE TABLE reply (
id int AUTO_INCREMENT PRIMARY KEY,
poster VARCHAR(128) NOT NULL,
datetimestamp DATETIME DEFAULT now() NOT NULL,
body VARCHAR(256) NOT NULL,
threadid int,
FOREIGN KEY (threadid) REFERENCES thread(id)
) ;


CREATE TABLE announcement (
id int AUTO_INCREMENT PRIMARY KEY,
datetimestamp DATETIME DEFAULT now() NOT NULL,
topic VARCHAR(64) NOT NULL,
body VARCHAR(256) NOT NULL );



INSERT INTO account
(username, password, name, about_me, email, last_login, date_registered,
status)
VALUES
('alice', 'password', 'alice', 'about me 0', 'alice@gmail.com', '1111-11-11',
'1111-11-11', 'active'),
('bob', 'password', 'bob', 'about me 1', 'bob@gmail.com', '1111-11-11',
'1111-11-11', 'active');


INSERT INTO admin_account
VALUES ('admin', 'password', 'admin@gmail.com', '1111-11-11');

INSERT INTO message (sender, receiver, read_flag, body) VALUES
('alice','bob', 'f' , 'hello'),
('alice','bob', 'f' , 'hello'),
('alice','bob', 'f' , 'hello');







INSERT INTO announcement ( topic, body) VALUES
('Happy New Year!', 'Admins would like to wish everybody a happy new year!!'),
('System Downtime', 'Dear all, System will be down from UTC+8 1100-1500 on Monday for maintenance');


INSERT INTO thread (id, creator, topic, body, status)
VALUES ('1' , 'alice' , 'Gotta problem logging in' , 'Anyone knows how to solve this??', 'ok');



INSERT INTO reply (id , poster, body, threadid)
VALUES
(2, 'bob', 'This problem is quite annoying', 1),
(3, 'bob', 'you just need to use your brainsThank You', 1);


CREATE TABLE complain (
id int AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(128) NOT NULL,
content VARCHAR(256) NOT NULL,
complainer VARCHAR(128) NOT NULL REFERENCES account(username),
datetimestamp DATETIME NOT NULL DEFAULT now(),
status VARCHAR(128) NOT NULL DEFAULT 'new',
comment VARCHAR(256)
);

INSERT INTO complain (title, content, complainer) 
VALUES ('slow', 'everything is too slow', 'bob');

INSERT INTO complain (title, content, complainer) 
VALUES ('slow', 'everything is too slow', 'alice');
