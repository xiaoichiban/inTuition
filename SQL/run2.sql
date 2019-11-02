/*
---------------------------------------------------------
-- HELLO
-- Please check if your SQL Table Names
-- do not have SQL RESERVED KEYWORDS
--
-- REFERENCE HERE:
---------------------------------------------------------
-- https://mariadb.com/kb/en/library/reserved-words/
---------------------------------------------------------
--
--
---------------------------------------------------------
⠀⠀⠀⣖⠲⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⠉⡇⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠸⡆⠹⡀⣠⢤⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡏⠀⡧⢤⡄⠀⠀⠀⠀⠀
⠀⠀⠀⠀⡧⢄⣹⣅⣜⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⠁⠀⢹⠚⠃⠀⠀⠀⠀⠀
⠀⣀⠴⢒⣉⡹⣶⣤⣀⡉⠉⠒⠒⠒⠤⠤⣀⣀⣀⠇⠀⠀⢸⠠⣄⠀⠀⠀⠀⠀
⠀⠈⠉⠁⠀⠀⠀⠉⠒⠯⣟⣲⠦⣤⣀⡀⠀⠀⠈⠉⠉⠉⠛⠒⠻⢥⣀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙⣲⡬⠭⠿⢷⣦⣤⢄⣀⠀⠀⠚⠛⠛⠓⢦⡀
⠀⠀⠀⠀⠀⠀⠀⢀⣀⠤⠴⠚⠉⠁⠀⠀⠀⠀⣀⣉⡽⣕⣯⡉⠉⠉⠑⢒⣒⡾
⠀⠀⣀⡠⠴⠒⠉⠉⠀⢀⣀⣀⠤⡤⢶⣶⣋⠉⠉⠀⠀⠀⠈⠉⠉⠉⠉⠉⠁⠀
⣖⣉⣁⣠⠤⠶⡶⡶⢍⡉⠀⠀⠀⠙⠒⠯⠜⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠁⠀⠀⠀⠀⠑⢦⣯⠇
⠀⠀⠀⣖⠲⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⠉⡇⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠸⡆⠹⡀⣠⢤⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡏⠀⡧⢤⡄⠀⠀⠀⠀⠀
⠀⠀⠀⠀⡧⢄⣹⣅⣜⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⠁⠀⢹⠚⠃⠀⠀⠀⠀⠀
⠀⣀⠴⢒⣉⡹⣶⣤⣀⡉⠉⠒⠒⠒⠤⠤⣀⣀⣀⠇⠀⠀⢸⠠⣄⠀⠀⠀⠀⠀
⠀⠈⠉⠁⠀⠀⠀⠉⠒⠯⣟⣲⠦⣤⣀⡀⠀⠀⠈⠉⠉⠉⠛⠒⠻⢥⣀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙⣲⡬⠭⠿⢷⣦⣤⢄⣀⠀⠀⠚⠛⠛⠓⢦⡀
⠀⠀⠀⠀⠀⠀⠀⢀⣀⠤⠴⠚⠉⠁⠀⠀⠀⠀⣀⣉⡽⣕⣯⡉⠉⠉⠑⢒⣒⡾
⠀⠀⣀⡠⠴⠒⠉⠉⠀⢀⣀⣀⠤⡤⢶⣶⣋⠉⠉⠀⠀⠀⠈⠉⠉⠉⠉⠉⠁⠀
⣖⣉⣁⣠⠤⠶⡶⡶⢍⡉⠀⠀⠀⠙⠒⠯⠜⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠁⠀⠀⠀⠀⠑⢦⣯⠇
*/




DROP TABLE IF EXISTS announcement;
DROP TABLE IF EXISTS reply;
DROP TABLE IF EXISTS thread;
DROP TABLE IF EXISTS complain;
DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS admin_account;
DROP TABLE IF EXISTS tutor;
DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS tc;
DROP TABLE IF EXISTS enroll;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS attempts;
DROP TABLE IF EXISTS quiz;
DROP TABLE IF EXISTS module;
DROP TABLE IF EXISTS account;

/*
--
--
-- TC
--
--
*/



CREATE TABLE admin_account (
user_id int AUTO_INCREMENT UNIQUE,
username VARCHAR(128) NOT NULL PRIMARY KEY,
password VARCHAR(128) NOT NULL,
email VARCHAR(128) UNIQUE NOT NULL,
last_login DATE
);



CREATE TABLE account (
user_id int AUTO_INCREMENT UNIQUE,
username VARCHAR(128) NOT NULL PRIMARY KEY,
password VARCHAR(128) NOT NULL,
last_seen DATETIME NOT NULL DEFAULT now(),
name VARCHAR(128) NOT NULL,
about_me VARCHAR(1024) NOT NULL DEFAULT '',
email VARCHAR(128) UNIQUE NOT NULL,
avatar_path VARCHAR(1024) NOT NULL DEFAULT 'default.png',
last_login DATE,
date_registered DATE NOT NULL,
status VARCHAR(128) NOT NULL DEFAULT 'active',
account_type VARCHAR(20) NOT NULL DEFAULT 'student'
);

/*
account_type = {student , tc or tutor}
*/


/*
--https://www.regular-expressions.info/creditcard.html
---
---
-- one {FK} only
---
*/


CREATE TABLE tc (
id int AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(128) NOT NULL UNIQUE,
credit_card_num VARCHAR(18) NOT NULL,
valid_till VARCHAR(4) NOT NULL,
credit_card_name VARCHAR(30) NOT NULL,
cvv VARCHAR(3) NOT NULL,
FOREIGN KEY (username) REFERENCES account(username)
);


CREATE TABLE tutor (
id int AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(128) NOT NULL UNIQUE,
tc_owner VARCHAR(128) NOT NULL,
FOREIGN KEY (username) REFERENCES account(username),
FOREIGN KEY (tc_owner) REFERENCES tc(username)
);

CREATE TABLE student (
id int AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(128) NOT NULL UNIQUE,
FOREIGN KEY (username) REFERENCES account(username)
);

INSERT INTO account
(username, password, name, about_me, email, last_login, date_registered, status, account_type)
VALUES
('alice', 'password', 'alice', 'about me 0', 'alice@gmail.com', '1111-11-11', '1111-11-11', 'active', 'student'),
('bob', 'password', 'bob', 'about me 1', 'bob@gmail.com', '1111-11-11', '1111-11-11', 'active', 'student'),
('brightkids', 'password', 'brightkids', 'best tuition center', 'brightkids@gmail.com', '1111-11-11', '1111-11-11', 'active', 'tc'),
('danny', 'password', 'danny', 'I very lepak', 'danny@gmail.com', '1111-11-11', '1111-11-11', 'active', 'tutor');




INSERT INTO student (username) VALUES ('alice');
INSERT INTO student (username) VALUES ('bob');

INSERT INTO tc (username, credit_card_num, valid_till, credit_card_name, cvv)
VALUES ('brightkids' , '12345678912345' , '1220' , 'DR Danny Poo' , '123');


INSERT INTO tutor (username,tc_owner) VALUES ('danny' , 'brightkids');









CREATE TABLE module (
id int AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(128) NOT NULL,
description VARCHAR(128) NOT NULL,
class_day int NOT NULL,
class_startTime VARCHAR(4) NOT NULL,
class_endTime VARCHAR(4) NOT NULL,
tc    VARCHAR(128) NOT NULL,
tutor VARCHAR(128) NOT NULL,
datetimestamp DATETIME DEFAULT now() NOT NULL,
status VARCHAR(16) NOT NULL DEFAULT 'active' ,
FOREIGN KEY (tc) REFERENCES account(username) ,
FOREIGN KEY (tutor) REFERENCES account(username)

);


CREATE TABLE enroll (
id int AUTO_INCREMENT PRIMARY KEY,
student VARCHAR(128) NOT NULL,
mod_id int NOT NULL REFERENCES module(id),
status VARCHAR(128) NOT NULL,
datetimestamp DATETIME DEFAULT now() NOT NULL,
FOREIGN KEY (student) REFERENCES account(username)
);





CREATE TABLE video (
id int AUTO_INCREMENT PRIMARY KEY,
mod_id int NOT NULL,
name VARCHAR(128) NOT NULL,
description VARCHAR(128) NOT NULL,
filename VARCHAR(128) NOT NULL,
datetimestamp DATETIME DEFAULT now() NOT NULL,
FOREIGN KEY (mod_id) REFERENCES module(id)
);






CREATE TABLE complain (
id int AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(128) NOT NULL,
content VARCHAR(256) NOT NULL,
complainer VARCHAR(128) NOT NULL,
datetimestamp DATETIME NOT NULL DEFAULT now(),
status VARCHAR(128) NOT NULL DEFAULT 'new',
comment VARCHAR(256),
FOREIGN KEY (complainer) REFERENCES account(username)
);

INSERT INTO module
(name, description, class_day, class_startTime, class_endTime, tc, tutor, status)
VALUES
('IS2103', 'This is a killer module', '1', '1400', '1600',
'brightkids', 'danny', 'active'),
('IS2103', 'This is NOT a killer module', '5', '1000', '1200',
'brightkids', 'danny', 'active'),
('IS3103', 'This is a module that wastes time', '2', '2000', '2300',
'brightkids', 'danny', 'active'),
('IS3103', 'This is an online module', '0', '0900', '1800',
'brightkids', 'danny', 'active');


INSERT INTO enroll (student, mod_id, status) VALUES
('alice', '1', 'accepted');


















CREATE TABLE quiz (
id int AUTO_INCREMENT PRIMARY KEY,
quiztitle VARCHAR(128) NOT NULL,
moduleid int NOT NULL
);


CREATE TABLE question (
id int AUTO_INCREMENT PRIMARY KEY,
questiontitle VARCHAR(128) NOT NULL,
optiona VARCHAR(128) NOT NULL,
optionb VARCHAR(128) NOT NULL,
optionc VARCHAR(128) NOT NULL,
optiond VARCHAR(128) NOT NULL,
answer VARCHAR(128) NOT NULL,
quizid int NOT NULL,
FOREIGN KEY (quizid) REFERENCES quiz(id)
);





CREATE TABLE attempts (
id int AUTO_INCREMENT PRIMARY KEY,
quizid int NOT NULL,
student VARCHAR(128) NOT NULL,
FOREIGN KEY (quizid) REFERENCES quiz(id),
FOREIGN KEY (student) REFERENCES account(username)
);



















/*
---- NOTE THIS !!!
---- I employed a dirty trick on this table  :)
---- Notice no {FK}
*/

CREATE TABLE message (
id int AUTO_INCREMENT PRIMARY KEY,
body VARCHAR(256) NOT NULL,
sender VARCHAR(128) NOT NULL,
receiver VARCHAR(128) NOT NULL,
datetimestamp DATETIME DEFAULT now() NOT NULL,
read_flag BOOLEAN NOT NULL DEFAULT FALSE
);

/*
--- I am not gonna link this to any table FYI
--- Don't worry, it still works
--- removed below
REFERENCES account(username),
REFERENCES account(username),
*/





/*
-------------------------------
-- Do not remove these yet
-- thanks
-------------------------------
*/


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
);

CREATE TABLE announcement (
id int AUTO_INCREMENT PRIMARY KEY,
datetimestamp DATETIME DEFAULT now() NOT NULL,
topic VARCHAR(64) NOT NULL,
body VARCHAR(256) NOT NULL );


INSERT INTO admin_account
VALUES ('1' , 'admin', 'password', 'admin@gmail.com', '1111-11-11');

INSERT INTO message (sender, receiver, read_flag, body) VALUES
('alice','bob', false , 'hello'),
('alice','bob', false , 'hello'),
('alice','bob', false , 'hello');

INSERT INTO announcement ( topic, body) VALUES
('Happy New Year!', 'Admins would like to wish everybody a happy new year!!'),
('System Downtime', 'Dear all, System will be down from UTC+8 1100-1500 on Monday for maintenance');

INSERT INTO thread (id, creator, topic, body, status)
VALUES ('1' , 'alice' , 'Gotta problem logging in' , 'Anyone knows how to solve this??', 'ok');

INSERT INTO reply (id , poster, body, threadid)
VALUES
(2, 'bob', 'This problem is quite annoying', 1),
(3, 'bob', 'you just need to use your brainsThank You', 1);



INSERT INTO complain (title, content, complainer)
VALUES ('slow', 'everything is too slow', 'bob');

INSERT INTO complain (title, content, complainer)
VALUES ('slow', 'everything is too slow', 'alice');
