DROP TABLE announcement;
DROP TABLE reply;
DROP TABLE thread;
DROP TABLE flag;
DROP TABLE tag;
DROP TABLE complain;
DROP TABLE message;
DROP TABLE bid;
DROP TABLE task;
DROP TABLE admin_account;
DROP TABLE account;
DROP FUNCTION bounceback() CASCADE;
DROP FUNCTION bouncebacknotify() CASCADE;
DROP FUNCTION stoptaskedit() CASCADE;

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

CREATE TABLE task (
	task_id SERIAL PRIMARY KEY,
	requester_name VARCHAR(128) NOT NULL REFERENCES account(username),
	task_name VARCHAR(128) NOT NULL,
	description VARCHAR(1024) NOT NULL,
	location VARCHAR(128) NOT NULL,
	time_of_service TIME NOT NULL,
	date_of_publishing DATE NOT NULL,
	bidding_deadline DATE NOT NULL CHECK (bidding_deadline > date_of_publishing),
	number_of_winning_bids_requirement INT NOT NULL CHECK (number_of_winning_bids_requirement > 0),
	date_of_expiry DATE NOT NULL CHECK (date_of_expiry > bidding_deadline),
	date_of_service DATE NOT NULL CHECK (date_of_service > date_of_expiry),
	requested_ideal_price FLOAT NOT NULL CHECK (requested_ideal_price >= 0),
	is_approved BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE bid (
	bid_id SERIAL PRIMARY KEY,
	bidder_name VARCHAR(128) NOT NULL REFERENCES account(username),
	task_id INT NOT NULL REFERENCES task(task_id),
	bid_amount FLOAT NOT NULL CHECK (bid_amount >= 0),
	is_winning_bid BOOLEAN NOT NULL DEFAULT FALSE,
	is_valid BOOLEAN NOT NULL DEFAULT TRUE,
	feedback_from_creator VARCHAR(1024),
	rating_from_creator INT CHECK (rating_from_creator >= 1 AND rating_from_creator <= 5),
	feedback_to_creator VARCHAR(1024),
	rating_to_creator INT CHECK (rating_to_creator >= 1 AND rating_to_creator <= 5)
);

CREATE TABLE message (
	message_id SERIAL PRIMARY KEY,
	subject VARCHAR(128) NOT NULL,
	message VARCHAR(1024) NOT NULL,
	sender_name VARCHAR(128) NOT NULL REFERENCES account(username),
	receiver_name VARCHAR(128) NOT NULL REFERENCES account(username),
	message_date DATE NOT NULL,
	message_time TIME(0) NOT NULL,
	read_flag BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE complain (
	complain_id SERIAL PRIMARY KEY,
	title VARCHAR(1024) NOT NULL,
    content VARCHAR(1024) NOT NULL,
	complainer_name VARCHAR(128) NOT NULL REFERENCES account(username),
	complain_date DATE NOT NULL,
	complain_time TIME(0) NOT NULL,
	status VARCHAR(128) NOT NULL DEFAULT 'open', /*open closed spam*/
    comment VARCHAR(1024)
);

CREATE TABLE tag (
	task_id INT NOT NULL REFERENCES task(task_id),
	tag VARCHAR(128) NOT NULL,
	PRIMARY KEY(task_id, tag)
);

CREATE TABLE flag (
	task_id INT NOT NULL REFERENCES task(task_id),
	flagger VARCHAR(128) NOT NULL REFERENCES account(username),
	PRIMARY KEY(task_id, flagger)
);

CREATE TABLE "public"."thread" (
    "id" SERIAL PRIMARY KEY,
    "creator" character varying(128) NOT NULL,
    "datetimestamp" timestamptz DEFAULT now() NOT NULL,
    "topic" character varying(64) NOT NULL,
    "body" character varying(256) NOT NULL,
    "status" character varying(16) NOT NULL
);

CREATE TABLE "public"."reply" (
    "id" SERIAL PRIMARY KEY,
    "poster" character varying(128) NOT NULL,
    "datetimestamp" timestamptz DEFAULT now() NOT NULL,
    "body" character varying(256) NOT NULL,
    "threadid" integer,
    CONSTRAINT "reply_threadid_fkey" FOREIGN KEY (threadid) REFERENCES thread(id) NOT DEFERRABLE
) ;

CREATE TABLE "public"."announcement" (
    "id" SERIAL PRIMARY KEY,
    "datetimestamp" timestamptz DEFAULT now() NOT NULL,
    "topic" VARCHAR(64) NOT NULL,
    "body" VARCHAR(256) NOT NULL
);

INSERT INTO 
"account" ("username", "password", "name", "about_me", "email", "last_login", "date_registered", "status") 
VALUES 
('user0', 'password', 'user0', 'about me 0', 'user0@gmail.com', '1111-11-11', '1111-11-11', 'active'),
('user1', 'password', 'user1', 'about me 1', 'user1@gmail.com', '1111-11-11', '1111-11-11', 'active'),
('user2', 'password', 'user2', 'about me 2', 'user2@gmail.com', '1111-11-11', '1111-11-11', 'active'),
('user3', 'password', 'user3', 'about me 3', 'user3@gmail.com', '1111-11-11', '1111-11-11', 'active'),
('user4', 'password', 'user4', 'about me 4', 'user4@gmail.com', '1111-11-11', '1111-11-11', 'active'),
('admin', 'password', 'admin', 'about me 5', 'admin@gmail.com', '1111-11-11', '1111-11-11', 'active'),
('www',	'www',	'mr_www', 'about me',	'www@gmail.com', NULL,	'2018-09-17',	'active'),
('abc',	'123',	'mr_abcdefg', 'about me',	'abc@gmail.com', NULL,	'2018-07-07',	'active'),
('Wayne',	'123',	'mr_wayne', 'about me',	'Wayne@gmail.com', NULL,	'2018-07-07',	'active'),
('Darren',	'123',	'mr_darren', 'about me',	'Darren@gmail.com', NULL,	'2018-07-07',	'active'),
('ChenXing',	'123',	'mr_chenxing', 'about me','chenxing@gmail.com', NULL,	'2018-07-07',	'active'),
('YiWei',	'123',	'mr_yiwei', 'about me',	'YiWei@gmail.com', NULL,	'2018-07-07',	'active'),
('Yanrong',	'123',	'ms_yanrong', 'about me',	'Yanrong@gmail.com', NULL,	'2018-07-07',	'active'),
('Jingwei',	'123',	'mr_jingwei', 'about me',	'Jingwei@gmail.com', NULL,	'2018-07-07',	'active'),
('ZhiKuan',	'123',	'mr_zhikuan', 'about me',	'ZhiKuan@gmail.com', NULL,	'2018-07-07',	'active'),
('RuoJie',	'123',	'ms_ruojie', 'about me',	'RuoJie@gmail.com', NULL,	'2018-07-07',	'active'),
('Bruce',	'123',	'mr_Bruce', 'about me',	'Bruce@gmail.com', NULL,	'2018-07-07',	'active'),
('TomCruise',	'123',	'Dr_Cruise', 'about me',	'TomCruise@gmail.com', NULL,	'2018-07-07',	'active'),
('Alex',	'123',	'Dr_Alex', 'about me',	'Alex@gmail.com', NULL,	'2018-07-07',	'active'),
('Minyu',	'123',	'ms_gao', 'about me',	'Minyu@gmail.com', NULL,	'2018-07-07',	'active'),
('Slyvia',	'123',	'ms_Slyvia', 'about me',	'Slyvia@gmail.com', NULL,	'2018-07-07',	'active'),
('yanxin',	'123',	'ms_yanxin', 'about me',	'yanxin@gmail.com', NULL,	'2018-07-07',	'active'),
('yanru',	'123',	'ms_yanru', 'about me',	'yanru@gmail.com', NULL,	'2018-07-07',	'active'),
('Haoming',	'123',	'mr_haoming', 'about me',	'Haoming@gmail.com', NULL,	'2018-07-07',	'active'),
('Armstrong',	'123',	'mr_strong', 'about me',	'Armstrong@gmail.com', NULL,	'2018-07-07',	'active'),
('Haoran',	'123',	'mr_haorao', 'about me',	'Haoran@gmail.com', NULL,	'2018-07-07',	'active'),
('Alfred',	'123',	'mr_alfred', 'about me',	'Alfred@gmail.com', NULL,	'2018-07-07',	'active'),
('Ragnar',	'123',	'king_ragnar', 'about me',	'Ragnar@gmail.com', NULL,	'2018-07-07',	'active'),
('Tyrion',	'123',	'mr_tyrion', 'about me',	'Tyrion@gmail.com', NULL,	'2018-07-07',	'active'),
('JamieLanister',	'123',	'sir_jamie', 'about me',	'JamieLanister@gmail.com', NULL,	'2018-07-07',	'active'),
('Cersei',	'123',	'ms_cersei', 'about me',	'Cersei@gmail.com', NULL,	'2018-07-07',	'active'),
('JonSnow',	'123',	'mr_snow', 'about me',	'JonSnow@gmail.com', NULL,	'2018-07-07',	'active'),
('Ned',	'123',	'mr_ned', 'about me',	'Ned@gmail.com', NULL,	'2018-07-07',	'active'),
('RobStark',	'123',	'mr_stark', 'about me',	'RobStark@gmail.com', NULL,	'2018-07-07',	'active'),
('BrandonStark',	'123',	'mr_stark', 'about me',	'BrandonStark@gmail.com', NULL,	'2018-07-07',	'active'),
('Drogo',	'123',	'mr_drogo', 'about me',	'Drogo@gmail.com', NULL,	'2018-07-07',	'active'),
('Floki',	'123',	'mr_floki', 'about me',	'Floki@gmail.com', NULL,	'2018-07-07',	'active'),
('Misilande',	'123',	'mr_misilande', 'about me',	'Misilande@gmail.com', NULL,	'2018-07-07',	'active'),
('Greyworm',	'123',	'mr_grey', 'about me',	'Greyworm@gmail.com', NULL,	'2018-07-07',	'active'),
('Aelle',	'123',	'mr_aelle', 'about me',	'Aelle@gmail.com', NULL,	'2018-07-07',	'active'),
('JessePinkman',	'123',	'mr_Pinkman', 'about me',	'JessePinkman@gmail.com', NULL,	'2018-07-07',	'active'),
('WalterWhite',	'123',	'mr_White', 'about me',	'WalterWhite@gmail.com', NULL,	'2018-07-07',	'active'),
('Saul',	'123',	'mr_goodman', 'about me',	'Saul@gmail.com', NULL,	'2018-07-07',	'active'),
('Mike',	'123',	'mr_mike', 'about me',	'Mike@gmail.com', NULL,	'2018-07-07',	'active');

INSERT INTO admin_account VALUES('admin', 'password', 'user3@gmail.com', '1111-11-11');
INSERT INTO admin_account VALUES('admin2', 'password', 'user4@gmail.com', '1111-11-11');

INSERT INTO task (requester_name, task_name, description, location, time_of_service, date_of_publishing, bidding_deadline,
 number_of_winning_bids_requirement, date_of_expiry, date_of_service, requested_ideal_price)
VALUES
('user1', 'washing car', 'wash my honda', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),							/*open bidding*/
('user1', 'washing car', 'wash my toyota', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),							/*open bidding*/
('user1', 'washing car', 'wash my mitsubishi', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),						/*open bidding*/
('user1', 'washing car', 'wash my bmw', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),								/*open bidding*/
('user1', 'washing car', 'wash my mercedes', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),						/*open bidding*/
('user1', 'washing car again', 'wash my honda again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),				/*closed bidding*/
('user1', 'washing car again', 'wash my toyota again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),			/*closed bidding*/
('user1', 'washing car again', 'wash my mitsubishi again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),		/*closed bidding*/
('user1', 'washing car again', 'wash my bmw again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),				/*closed bidding*/
('user1', 'washing car again', 'wash my mercedes again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),			/*closed bidding*/
('user1', 'cleaning house', 'clean the HDB stairs', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user1', 'cleaning house', 'clean the HDB door', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user1', 'cleaning house', 'clean the HDB window', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user1', 'cleaning house', 'clean the HDB floor', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user1', 'cleaning house', 'clean the HDB ceiling', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),				/*expired*/
('user1', 'washing car and house', 'wash my honda and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*16confirmed. enough bids*/
('user1', 'washing car and house', 'wash my toyota and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*confirmed. enough bids*/
('user1', 'washing car and house', 'wash my mitsubishi and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),		/*confirmed. enough bids*/
('user1', 'washing car and house', 'wash my bmw and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*confirmed. enough bids*/
('user1', 'washing car and house', 'wash my mercedes and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),		/*confirmed. enough bids*/
('user1', 'cleaning table', 'clean the living room table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*pending. enough bids*/
('user1', 'cleaning table', 'clean the toilet table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user1', 'cleaning table', 'clean the bedroom table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user1', 'cleaning table', 'clean the study room table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*pending. enough bids*/
('user1', 'cleaning table', 'clean the storeroom table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user1', 'cleaning chair', 'clean the toilet chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*complete. enough bids. has feedback not null*/
('user1', 'cleaning chair', 'clean the living room chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*complete. enough bids. has feedback not null*/
('user1', 'cleaning chair', 'clean the bedroom chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*complete. enough bids. has feedback not null*/
('user1', 'cleaning chair', 'clean the study room chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*complete. enough bids. has feedback not null*/
('user1', 'cleaning chair', 'clean the storeroom chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*30complete. enough bids. has feedback not null*/

('user2', 'washing car', 'wash my honda', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),							/*open bidding*/
('user2', 'washing car', 'wash my toyota', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),							/*open bidding*/
('user2', 'washing car', 'wash my mitsubishi', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),						/*open bidding*/
('user2', 'washing car', 'wash my bmw', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),								/*open bidding*/
('user2', 'washing car', 'wash my mercedes', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),						/*open bidding*/
('user2', 'washing car again', 'wash my honda again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),				/*closed bidding*/
('user2', 'washing car again', 'wash my toyota again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),			/*closed bidding*/
('user2', 'washing car again', 'wash my mitsubishi again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),		/*closed bidding*/
('user2', 'washing car again', 'wash my bmw again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),				/*closed bidding*/
('user2', 'washing car again', 'wash my mercedes again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),			/*closed bidding*/
('user2', 'cleaning house', 'clean the HDB stairs', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user2', 'cleaning house', 'clean the HDB door', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user2', 'cleaning house', 'clean the HDB window', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user2', 'cleaning house', 'clean the HDB floor', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user2', 'cleaning house', 'clean the HDB ceiling', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),				/*expired*/
('user2', 'washing car and house', 'wash my honda and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*46confirmed. enough bids*/
('user2', 'washing car and house', 'wash my toyota and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*confirmed. enough bids*/
('user2', 'washing car and house', 'wash my mitsubishi and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),		/*confirmed. enough bids*/
('user2', 'washing car and house', 'wash my bmw and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*confirmed. enough bids*/
('user2', 'washing car and house', 'wash my mercedes and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),		/*confirmed. enough bids*/
('user2', 'cleaning table', 'clean the living room table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*pending. enough bids*/
('user2', 'cleaning table', 'clean the toilet table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user2', 'cleaning table', 'clean the bedroom table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user2', 'cleaning table', 'clean the study room table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*pending. enough bids*/
('user2', 'cleaning table', 'clean the storeroom table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user2', 'cleaning chair', 'clean the toilet chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*complete. enough bids. has feedback not null*/
('user2', 'cleaning chair', 'clean the living room chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*complete. enough bids. has feedback not null*/
('user2', 'cleaning chair', 'clean the bedroom chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*complete. enough bids. has feedback not null*/
('user2', 'cleaning chair', 'clean the study room chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*complete. enough bids. has feedback not null*/
('user2', 'cleaning chair', 'clean the storeroom chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*60complete. enough bids. has feedback not null*/

('user3', 'washing car', 'wash my honda', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),							/*open bidding*/
('user3', 'washing car', 'wash my toyota', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),							/*open bidding*/
('user3', 'washing car', 'wash my mitsubishi', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),						/*open bidding*/
('user3', 'washing car', 'wash my bmw', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),								/*open bidding*/
('user3', 'washing car', 'wash my mercedes', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),						/*open bidding*/
('user3', 'washing car again', 'wash my honda again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),				/*closed bidding*/
('user3', 'washing car again', 'wash my toyota again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),			/*closed bidding*/
('user3', 'washing car again', 'wash my mitsubishi again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),		/*closed bidding*/
('user3', 'washing car again', 'wash my bmw again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),				/*closed bidding*/
('user3', 'washing car again', 'wash my mercedes again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),			/*closed bidding*/
('user3', 'cleaning house', 'clean the HDB stairs', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user3', 'cleaning house', 'clean the HDB door', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user3', 'cleaning house', 'clean the HDB window', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user3', 'cleaning house', 'clean the HDB floor', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user3', 'cleaning house', 'clean the HDB ceiling', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),				/*expired*/
('user3', 'washing car and house', 'wash my honda and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*76confirmed. enough bids*/
('user3', 'washing car and house', 'wash my toyota and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*confirmed. enough bids*/
('user3', 'washing car and house', 'wash my mitsubishi and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),		/*confirmed. enough bids*/
('user3', 'washing car and house', 'wash my bmw and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*confirmed. enough bids*/
('user3', 'washing car and house', 'wash my mercedes and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),		/*confirmed. enough bids*/
('user3', 'cleaning table', 'clean the living room table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*pending. enough bids*/
('user3', 'cleaning table', 'clean the toilet table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user3', 'cleaning table', 'clean the bedroom table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user3', 'cleaning table', 'clean the study room table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*pending. enough bids*/
('user3', 'cleaning table', 'clean the storeroom table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user3', 'cleaning chair', 'clean the toilet chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*complete. enough bids. has feedback not null*/
('user3', 'cleaning chair', 'clean the living room chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*complete. enough bids. has feedback not null*/
('user3', 'cleaning chair', 'clean the bedroom chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*complete. enough bids. has feedback not null*/
('user3', 'cleaning chair', 'clean the study room chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*complete. enough bids. has feedback not null*/
('user3', 'cleaning chair', 'clean the storeroom chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*90complete. enough bids. has feedback not null*/

('user4', 'washing car', 'wash my honda', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),							/*open bidding*/
('user4', 'washing car', 'wash my toyota', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),							/*open bidding*/
('user4', 'washing car', 'wash my mitsubishi', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),						/*open bidding*/
('user4', 'washing car', 'wash my bmw', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),								/*open bidding*/
('user4', 'washing car', 'wash my mercedes', 'carpark', '11:11:11', '2018-10-01', '2018-12-15', 1, '2018-12-16', '2018-12-17', 2.50),						/*open bidding*/
('user4', 'washing car again', 'wash my honda again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),				/*closed bidding*/
('user4', 'washing car again', 'wash my toyota again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),			/*closed bidding*/
('user4', 'washing car again', 'wash my mitsubishi again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),		/*closed bidding*/
('user4', 'washing car again', 'wash my bmw again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),				/*closed bidding*/
('user4', 'washing car again', 'wash my mercedes again', 'carpark 2', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-12-16', '2018-12-17', 2.50),			/*closed bidding*/
('user4', 'cleaning house', 'clean the HDB stairs', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user4', 'cleaning house', 'clean the HDB door', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user4', 'cleaning house', 'clean the HDB window', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user4', 'cleaning house', 'clean the HDB floor', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),					/*expired*/
('user4', 'cleaning house', 'clean the HDB ceiling', 'changi', '11:11:11', '2018-10-01', '2018-10-02', 2, '2018-10-03', '2018-12-17', 2.50),				/*expired*/
('user4', 'washing car and house', 'wash my honda and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*106confirmed. enough bids*/
('user4', 'washing car and house', 'wash my toyota and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),		/*confirmed. enough bids*/
('user4', 'washing car and house', 'wash my mitsubishi and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),	/*confirmed. enough bids*/
('user4', 'washing car and house', 'wash my bmw and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),			/*confirmed. enough bids*/
('user4', 'washing car and house', 'wash my mercedes and HDB', 'newton', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-12-17', 2.50),		/*confirmed. enough bids*/
('user4', 'cleaning table', 'clean the living room table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*pending. enough bids*/
('user4', 'cleaning table', 'clean the toilet table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user4', 'cleaning table', 'clean the bedroom table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user4', 'cleaning table', 'clean the study room table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*pending. enough bids*/
('user4', 'cleaning table', 'clean the storeroom table', 'marsiling', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*pending. enough bids*/
('user4', 'cleaning chair', 'clean the toilet chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*complete. enough bids. has feedback not null*/
('user4', 'cleaning chair', 'clean the living room chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*complete. enough bids. has feedback not null*/
('user4', 'cleaning chair', 'clean the bedroom chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),			/*complete. enough bids. has feedback not null*/
('user4', 'cleaning chair', 'clean the study room chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50),		/*complete. enough bids. has feedback not null*/
('user4', 'cleaning chair', 'clean the storeroom chair', 'serangoon', '11:11:11', '2018-10-01', '2018-10-02', 1, '2018-10-03', '2018-10-04', 2.50);			/*120complete. enough bids. has feedback not null*/

INSERT INTO bid (bidder_name, task_id, bid_amount) VALUES 
/*
('user1', '1', 1.44),
('user1', '2', 1.44),
('user1', '3', 1.44),
('user1', '4', 1.44),
('user1', '5', 1.44),
('user1', '6', 1.44),
('user1', '7', 1.44),
('user1', '8', 1.44),
('user1', '9', 1.44),
('user1', '10', 1.44),
('user1', '11', 1.44),
('user1', '12', 1.44),
('user1', '13', 1.44),
('user1', '14', 1.44),
('user1', '15', 1.44),
('user1', '16', 1.44),
('user1', '17', 1.44),
('user1', '18', 1.44),
('user1', '19', 1.44),
('user1', '20', 1.44),
('user1', '21', 1.44),
('user1', '22', 1.44),
('user1', '23', 1.44),
('user1', '24', 1.44),
('user1', '25', 1.44),
('user1', '26', 1.44),
('user1', '27', 1.44),
('user1', '28', 1.44),
('user1', '29', 1.44),
('user1', '30', 1.44),
*/
('user1', '31', 1.44),
('user1', '32', 1.44),
('user1', '33', 1.44),
('user1', '34', 1.44),
('user1', '35', 1.44),
('user1', '36', 1.44),
('user1', '37', 1.44),
('user1', '38', 1.44),
('user1', '39', 1.44),
('user1', '40', 1.44),
('user1', '41', 1.44),
('user1', '42', 1.44),
('user1', '43', 1.44),
('user1', '44', 1.44),
('user1', '45', 1.44),
('user1', '46', 1.44),
('user1', '47', 1.44),
('user1', '48', 1.44),
('user1', '49', 1.44),
('user1', '50', 1.44),
('user1', '51', 1.44),
('user1', '52', 1.44),
('user1', '53', 1.44),
('user1', '54', 1.44),
('user1', '55', 1.44),
('user1', '56', 1.44),
('user1', '57', 1.44),
('user1', '58', 1.44),
('user1', '59', 1.44),
('user1', '60', 1.44),
('user1', '61', 1.44),
('user1', '62', 1.44),
('user1', '63', 1.44),
('user1', '64', 1.44),
('user1', '65', 1.44),
('user1', '66', 1.44),
('user1', '67', 1.44),
('user1', '68', 1.44),
('user1', '69', 1.44),
('user1', '70', 1.44),
('user1', '71', 1.44),
('user1', '72', 1.44),
('user1', '73', 1.44),
('user1', '74', 1.44),
('user1', '75', 1.44),
('user1', '76', 1.44),
('user1', '77', 1.44),
('user1', '78', 1.44),
('user1', '79', 1.44),
('user1', '80', 1.44),
('user1', '81', 1.44),
('user1', '82', 1.44),
('user1', '83', 1.44),
('user1', '84', 1.44),
('user1', '85', 1.44),
('user1', '86', 1.44),
('user1', '87', 1.44),
('user1', '88', 1.44),
('user1', '89', 1.44),
('user1', '90', 1.44),
('user1', '91', 1.44),
('user1', '92', 1.44),
('user1', '93', 1.44),
('user1', '94', 1.44),
('user1', '95', 1.44),
('user1', '96', 1.44),
('user1', '97', 1.44),
('user1', '98', 1.44),
('user1', '99', 1.44),
('user1', '100', 1.44),
('user1', '101', 1.44),
('user1', '102', 1.44),
('user1', '103', 1.44),
('user1', '104', 1.44),
('user1', '105', 1.44),
('user1', '106', 1.44),
('user1', '107', 1.44),
('user1', '108', 1.44),
('user1', '109', 1.44),
('user1', '110', 1.44),
('user1', '111', 1.44),
('user1', '112', 1.44),
('user1', '113', 1.44),
('user1', '114', 1.44),
('user1', '115', 1.44),
('user1', '116', 1.44),
('user1', '117', 1.44),
('user1', '118', 1.44),
('user1', '119', 1.44),
('user1', '120', 1.44),

('user2', '1', 1.44),
('user2', '2', 1.44),
('user2', '3', 1.44),
('user2', '4', 1.44),
('user2', '5', 1.44),
('user2', '6', 1.44),
('user2', '7', 1.44),
('user2', '8', 1.44),
('user2', '9', 1.44),
('user2', '10', 1.44),
('user2', '11', 1.44),
('user2', '12', 1.44),
('user2', '13', 1.44),
('user2', '14', 1.44),
('user2', '15', 1.44),
('user2', '16', 1.44),
('user2', '17', 1.44),
('user2', '18', 1.44),
('user2', '19', 1.44),
('user2', '20', 1.44),
('user2', '21', 1.44),
('user2', '22', 1.44),
('user2', '23', 1.44),
('user2', '24', 1.44),
('user2', '25', 1.44),
('user2', '26', 1.44),
('user2', '27', 1.44),
('user2', '28', 1.44),
('user2', '29', 1.44),
('user2', '30', 1.44),
/*
('user2', '31', 1.44),
('user2', '32', 1.44),
('user2', '33', 1.44),
('user2', '34', 1.44),
('user2', '35', 1.44),
('user2', '36', 1.44),
('user2', '37', 1.44),
('user2', '38', 1.44),
('user2', '39', 1.44),
('user2', '40', 1.44),
('user2', '41', 1.44),
('user2', '42', 1.44),
('user2', '43', 1.44),
('user2', '44', 1.44),
('user2', '45', 1.44),
('user2', '46', 1.44),
('user2', '47', 1.44),
('user2', '48', 1.44),
('user2', '49', 1.44),
('user2', '50', 1.44),
('user2', '51', 1.44),
('user2', '52', 1.44),
('user2', '53', 1.44),
('user2', '54', 1.44),
('user2', '55', 1.44),
('user2', '56', 1.44),
('user2', '57', 1.44),
('user2', '58', 1.44),
('user2', '59', 1.44),
('user2', '60', 1.44),
*/
('user2', '61', 1.44),
('user2', '62', 1.44),
('user2', '63', 1.44),
('user2', '64', 1.44),
('user2', '65', 1.44),
('user2', '66', 1.44),
('user2', '67', 1.44),
('user2', '68', 1.44),
('user2', '69', 1.44),
('user2', '70', 1.44),
('user2', '71', 1.44),
('user2', '72', 1.44),
('user2', '73', 1.44),
('user2', '74', 1.44),
('user2', '75', 1.44),
('user2', '76', 1.44),
('user2', '77', 1.44),
('user2', '78', 1.44),
('user2', '79', 1.44),
('user2', '80', 1.44),
('user2', '81', 1.44),
('user2', '82', 1.44),
('user2', '83', 1.44),
('user2', '84', 1.44),
('user2', '85', 1.44),
('user2', '86', 1.44),
('user2', '87', 1.44),
('user2', '88', 1.44),
('user2', '89', 1.44),
('user2', '90', 1.44),
('user2', '91', 1.44),
('user2', '92', 1.44),
('user2', '93', 1.44),
('user2', '94', 1.44),
('user2', '95', 1.44),
('user2', '96', 1.44),
('user2', '97', 1.44),
('user2', '98', 1.44),
('user2', '99', 1.44),
('user2', '100', 1.44),
('user2', '101', 1.44),
('user2', '102', 1.44),
('user2', '103', 1.44),
('user2', '104', 1.44),
('user2', '105', 1.44),
('user2', '106', 1.44),
('user2', '107', 1.44),
('user2', '108', 1.44),
('user2', '109', 1.44),
('user2', '110', 1.44),
('user2', '111', 1.44),
('user2', '112', 1.44),
('user2', '113', 1.44),
('user2', '114', 1.44),
('user2', '115', 1.44),
('user2', '116', 1.44),
('user2', '117', 1.44),
('user2', '118', 1.44),
('user2', '119', 1.44),
('user2', '120', 1.44),

('user3', '1', 1.44),
('user3', '2', 1.44),
('user3', '3', 1.44),
('user3', '4', 1.44),
('user3', '5', 1.44),
('user3', '6', 1.44),
('user3', '7', 1.44),
('user3', '8', 1.44),
('user3', '9', 1.44),
('user3', '10', 1.44),
('user3', '11', 1.44),
('user3', '12', 1.44),
('user3', '13', 1.44),
('user3', '14', 1.44),
('user3', '15', 1.44),
('user3', '16', 1.44),
('user3', '17', 1.44),
('user3', '18', 1.44),
('user3', '19', 1.44),
('user3', '20', 1.44),
('user3', '21', 1.44),
('user3', '22', 1.44),
('user3', '23', 1.44),
('user3', '24', 1.44),
('user3', '25', 1.44),
('user3', '26', 1.44),
('user3', '27', 1.44),
('user3', '28', 1.44),
('user3', '29', 1.44),
('user3', '30', 1.44),
('user3', '31', 1.44),
('user3', '32', 1.44),
('user3', '33', 1.44),
('user3', '34', 1.44),
('user3', '35', 1.44),
('user3', '36', 1.44),
('user3', '37', 1.44),
('user3', '38', 1.44),
('user3', '39', 1.44),
('user3', '40', 1.44),
('user3', '41', 1.44),
('user3', '42', 1.44),
('user3', '43', 1.44),
('user3', '44', 1.44),
('user3', '45', 1.44),
('user3', '46', 1.44),
('user3', '47', 1.44),
('user3', '48', 1.44),
('user3', '49', 1.44),
('user3', '50', 1.44),
('user3', '51', 1.44),
('user3', '52', 1.44),
('user3', '53', 1.44),
('user3', '54', 1.44),
('user3', '55', 1.44),
('user3', '56', 1.44),
('user3', '57', 1.44),
('user3', '58', 1.44),
('user3', '59', 1.44),
/*
('user3', '60', 1.44),
('user3', '61', 1.44),
('user3', '62', 1.44),
('user3', '63', 1.44),
('user3', '64', 1.44),
('user3', '65', 1.44),
('user3', '66', 1.44),
('user3', '67', 1.44),
('user3', '68', 1.44),
('user3', '69', 1.44),
('user3', '70', 1.44),
('user3', '71', 1.44),
('user3', '72', 1.44),
('user3', '73', 1.44),
('user3', '74', 1.44),
('user3', '75', 1.44),
('user3', '76', 1.44),
('user3', '77', 1.44),
('user3', '78', 1.44),
('user3', '79', 1.44),
('user3', '80', 1.44),
('user3', '81', 1.44),
('user3', '82', 1.44),
('user3', '83', 1.44),
('user3', '84', 1.44),
('user3', '85', 1.44),
('user3', '86', 1.44),
('user3', '87', 1.44),
('user3', '88', 1.44),
('user3', '89', 1.44),
('user3', '90', 1.44),
*/
('user3', '91', 1.44),
('user3', '92', 1.44),
('user3', '93', 1.44),
('user3', '94', 1.44),
('user3', '95', 1.44),
('user3', '96', 1.44),
('user3', '97', 1.44),
('user3', '98', 1.44),
('user3', '99', 1.44),
('user3', '100', 1.44),
('user3', '101', 1.44),
('user3', '102', 1.44),
('user3', '103', 1.44),
('user3', '104', 1.44),
('user3', '105', 1.44),
('user3', '106', 1.44),
('user3', '107', 1.44),
('user3', '108', 1.44),
('user3', '109', 1.44),
('user3', '110', 1.44),
('user3', '111', 1.44),
('user3', '112', 1.44),
('user3', '113', 1.44),
('user3', '114', 1.44),
('user3', '115', 1.44),
('user3', '116', 1.44),
('user3', '117', 1.44),
('user3', '118', 1.44),
('user3', '119', 1.44),
('user3', '120', 1.44),

('user4', '1', 1.44),
('user4', '2', 1.44),
('user4', '3', 1.44),
('user4', '4', 1.44),
('user4', '5', 1.44),
('user4', '6', 1.44),
('user4', '7', 1.44),
('user4', '8', 1.44),
('user4', '9', 1.44),
('user4', '10', 1.44),
('user4', '11', 1.44),
('user4', '12', 1.44),
('user4', '13', 1.44),
('user4', '14', 1.44),
('user4', '15', 1.44),
('user4', '16', 1.44),
('user4', '17', 1.44),
('user4', '18', 1.44),
('user4', '19', 1.44),
('user4', '20', 1.44),
('user4', '21', 1.44),
('user4', '22', 1.44),
('user4', '23', 1.44),
('user4', '24', 1.44),
('user4', '25', 1.44),
('user4', '26', 1.44),
('user4', '27', 1.44),
('user4', '28', 1.44),
('user4', '29', 1.44),
('user4', '30', 1.44),
('user4', '31', 1.44),
('user4', '32', 1.44),
('user4', '33', 1.44),
('user4', '34', 1.44),
('user4', '35', 1.44),
('user4', '36', 1.44),
('user4', '37', 1.44),
('user4', '38', 1.44),
('user4', '39', 1.44),
('user4', '40', 1.44),
('user4', '41', 1.44),
('user4', '42', 1.44),
('user4', '43', 1.44),
('user4', '44', 1.44),
('user4', '45', 1.44),
('user4', '46', 1.44),
('user4', '47', 1.44),
('user4', '48', 1.44),
('user4', '49', 1.44),
('user4', '50', 1.44),
('user4', '51', 1.44),
('user4', '52', 1.44),
('user4', '53', 1.44),
('user4', '54', 1.44),
('user4', '55', 1.44),
('user4', '56', 1.44),
('user4', '57', 1.44),
('user4', '58', 1.44),
('user4', '59', 1.44),
('user4', '60', 1.44),
('user4', '61', 1.44),
('user4', '62', 1.44),
('user4', '63', 1.44),
('user4', '64', 1.44),
('user4', '65', 1.44),
('user4', '66', 1.44),
('user4', '67', 1.44),
('user4', '68', 1.44),
('user3', '69', 1.44),
('user4', '70', 1.44),
('user4', '71', 1.44),
('user4', '72', 1.44),
('user4', '73', 1.44),
('user4', '74', 1.44),
('user4', '75', 1.44),
('user4', '76', 1.44),
('user4', '77', 1.44),
('user4', '78', 1.44),
('user4', '79', 1.44),
('user4', '80', 1.44),
('user4', '81', 1.44),
('user4', '82', 1.44),
('user4', '83', 1.44),
('user4', '84', 1.44),
('user4', '85', 1.44),
('user4', '86', 1.44),
('user4', '87', 1.44),
('user4', '88', 1.44),
('user4', '89', 1.44),
('user4', '90', 1.44);
/*
('user4', '91', 1.44),
('user4', '92', 1.44),
('user4', '93', 1.44),
('user4', '94', 1.44),
('user4', '95', 1.44),
('user4', '96', 1.44),
('user4', '97', 1.44),
('user4', '98', 1.44),
('user4', '99', 1.44),
('user4', '100', 1.44),
('user4', '101', 1.44),
('user4', '102', 1.44),
('user4', '103', 1.44),
('user4', '104', 1.44),
('user4', '105', 1.44),
('user4', '106', 1.44),
('user4', '107', 1.44),
('user4', '108', 1.44),
('user4', '109', 1.44),
('user4', '110', 1.44),
('user4', '111', 1.44),
('user4', '112', 1.44),
('user4', '113', 1.44),
('user4', '114', 1.44),
('user4', '115', 1.44),
('user4', '116', 1.44),
('user4', '117', 1.44),
('user4', '118', 1.44),
('user4', '119', 1.44),
('user4', '120', 1.44),
*/

/*user4 bids for the tasks of user1, 2, 3 to meet requirements*/
UPDATE bid SET is_winning_bid='TRUE' WHERE
bidder_name='user4' AND (
(task_id>=16 AND task_id<=30) OR 
(task_id>=46 AND task_id<=60) OR 
(task_id>=76 AND task_id<=90)
);

/*user1 bids for the tasks of user4 to meet requirements*/
UPDATE bid SET is_winning_bid='TRUE' WHERE
bidder_name='user1' AND (
(task_id>=116 AND task_id<=120)
);

/*user2 bids for the tasks of user4 to meet requirements*/
UPDATE bid SET is_winning_bid='TRUE' WHERE
bidder_name='user2' AND (
(task_id>=111 AND task_id<=115)
);

/*user3 bids for the tasks of user4 to meet requirements*/
UPDATE bid SET is_winning_bid='TRUE' WHERE
bidder_name='user3' AND (
(task_id>=106 AND task_id<=110)
);

/*user4 gets feedback from the winning bids for the tasks of user1, 2, 3 after task complete*/
UPDATE bid SET rating_from_creator=4, feedback_from_creator='good job' WHERE
bidder_name='user4' AND (
(task_id>=26 AND task_id<=30) OR 
(task_id>=56 AND task_id<=60) OR 
(task_id>=86 AND task_id<=90)
);

/*user1 gets feedback from the winning bids for the tasks of user4 after task complete*/
UPDATE bid SET rating_from_creator=4, feedback_from_creator='good job' WHERE
bidder_name='user1' AND (
(task_id>=116 AND task_id<=120)
);


INSERT INTO message (sender_name, receiver_name, message_date, message_time, read_flag, subject, message) VALUES
('www',	'admin',	'2018-09-19',	'17:18:31.906837',	'f',	'b',	'&gt;?'),
('www',	'abc',	'2018-09-19',	'17:18:07.81876',	'f',	'a',	'&gt;?'),
('www',	'abc',	'2018-09-19',	'17:18:31.906837',	'f',	'c',	'&gt;?'),
('abc',	'www',	'2018-09-21',	'01:37:57.775294',	't',	'Test for read/unread',	'How are you doing mate? Would you like to help me with gardening?'),
('abc',	'www',	'2018-09-19',	'21:46:49.038612',	't',	'this is a test',	'test'),
('abc',	'www',	'2018-10-08',	'16:30:27.142631',	'f',	'Test Apollo',	'Apollo how are you?'),
('YiWei','ZhiKuan',	'2018-09-24',	'13:22:44.029678',	'f',	'Hello',	'Car Washing'),
('Minyu','yanru',	'2018-09-24',	'13:22:44.029678',	'f',	'Building table',	'Good day mate'),
('yanxin','Haoran',	'2018-09-24',	'13:22:44.029678',	'f',	'Plumbing',	'Hey there'),
('Armstrong','Haoming',	'2018-09-24',	'13:22:44.029678',	't',	'Watering plants',	'Hey ya'),
('Slyvia','Haoming',	'2018-09-24',	'13:22:44.029678',	'f',	'Building wardrobe',	'Hey mate'),
('Armstrong','Haoming',	'2018-09-24',	'13:22:44.029678',	'f',	'Building ',	'Hey mate'),
('TomCruise','Bruce',	'2018-09-24',	'13:22:44.029678',	'f',	'Mission Impossible','Hey mate'),
('Bruce','Alfred',	'2018-09-24',	'13:22:44.029678',	'f',	'Batman Inc',	'Hey mate'),
('Bruce','Alfred',	'2018-09-24',	'13:22:44.029678',	'f',	'Bat Mobile',	'Hey mate'),
('Bruce','Alfred',	'2018-09-24',	'13:22:44.029678',	'f',	'Bat Flash',	'Hey mate'),
('Bruce','Alfred',	'2018-09-24',	'13:22:44.029678',	'f',	'Bat hook',	'Hey mate'),
('Bruce','Alfred',	'2018-09-24',	'13:22:44.029678',	'f',	'Bat man',	'Hey mate'),
('Alfred','Bruce',	'2018-09-24',	'13:22:44.029678',	'f',	'Bat Mobile',	'Hey mate, i am working on it'),
('Alfred','Bruce',	'2018-09-24',	'13:22:44.029678',	'f',	'Bat man',	'Hey mate, i am working on it'),
('Alfred','Bruce',	'2018-09-24',	'13:22:44.029678',	'f',	'Bat hook',	'Hey mate, i am working on it'),
('Alfred','Bruce',	'2018-09-24',	'13:22:44.029678',	'f',	'Bat Bomberang',	'Hey mate, i am working on it'),
('Alfred','Bruce',	'2018-09-24',	'13:22:44.029678',	'f',	'Bat you',	'Hey mate, i am working on it'),
('Alfred','Bruce',	'2018-09-24',	'13:22:44.029678',	'f',	'Bat Armour',	'Hey mate, i am working on it');

INSERT INTO complain (title, content, complainer_name, complain_date, complain_time) VALUES ('title1', 'complain1', 'user2', '1111-11-11', '11:11:11');
INSERT INTO complain (title, content, complainer_name, complain_date, complain_time) VALUES ('title2', 'complain2', 'user3', '1111-11-12', '11:11:11');
INSERT INTO complain (title, content, complainer_name, complain_date, complain_time) VALUES ('title3',  'complain3', 'user1', '1111-11-13', '11:11:11');
INSERT INTO complain (title, content, complainer_name, complain_date, complain_time) VALUES ('title4', 'complain4', 'user2', '1111-11-14', '11:11:11');
INSERT INTO complain (title, content, complainer_name, complain_date, complain_time) VALUES ('title5', 'complain5', 'user2', '1111-11-15', '11:11:11');

INSERT INTO tag VALUES (1, 'fun');
INSERT INTO tag VALUES (1, 'wash');
INSERT INTO tag VALUES (1, 'clean');
INSERT INTO tag VALUES (2, 'fun');
INSERT INTO tag VALUES (2, 'wash');
INSERT INTO tag VALUES (2, 'clean');
INSERT INTO tag VALUES (3, 'fun');
INSERT INTO tag VALUES (3, 'wash');
INSERT INTO tag VALUES (3, 'clean');
INSERT INTO tag VALUES (4, 'fun');
INSERT INTO tag VALUES (4, 'wash');
INSERT INTO tag VALUES (4, 'clean');
INSERT INTO tag VALUES (5, 'fun');
INSERT INTO tag VALUES (5, 'wash');
INSERT INTO tag VALUES (5, 'clean');
INSERT INTO tag VALUES (6, 'fun');
INSERT INTO tag VALUES (6, 'wash');
INSERT INTO tag VALUES (6, 'clean');
INSERT INTO tag VALUES (7, 'fun');
INSERT INTO tag VALUES (7, 'wash');
INSERT INTO tag VALUES (7, 'clean');
INSERT INTO tag VALUES (8, 'fun');
INSERT INTO tag VALUES (8, 'wash');
INSERT INTO tag VALUES (8, 'clean');
INSERT INTO tag VALUES (9, 'fun');
INSERT INTO tag VALUES (9, 'wash');
INSERT INTO tag VALUES (9, 'clean');
INSERT INTO tag VALUES (10, 'fun');
INSERT INTO tag VALUES (10, 'wash');
INSERT INTO tag VALUES (10, 'clean');
INSERT INTO tag VALUES (11, 'fun');
INSERT INTO tag VALUES (11, 'wash');
INSERT INTO tag VALUES (11, 'clean');
INSERT INTO tag VALUES (12, 'fun');
INSERT INTO tag VALUES (12, 'wash');
INSERT INTO tag VALUES (12, 'clean');
INSERT INTO tag VALUES (13, 'fun');
INSERT INTO tag VALUES (13, 'wash');
INSERT INTO tag VALUES (13, 'clean');
INSERT INTO tag VALUES (14, 'fun');
INSERT INTO tag VALUES (14, 'wash');
INSERT INTO tag VALUES (14, 'clean');
INSERT INTO tag VALUES (15, 'fun');
INSERT INTO tag VALUES (15, 'wash');
INSERT INTO tag VALUES (15, 'clean');
INSERT INTO tag VALUES (16, 'fun');
INSERT INTO tag VALUES (16, 'wash');
INSERT INTO tag VALUES (16, 'clean');
INSERT INTO tag VALUES (17, 'fun');
INSERT INTO tag VALUES (17, 'wash');
INSERT INTO tag VALUES (17, 'clean');
INSERT INTO tag VALUES (18, 'fun');
INSERT INTO tag VALUES (18, 'wash');
INSERT INTO tag VALUES (18, 'clean');
INSERT INTO tag VALUES (19, 'fun');
INSERT INTO tag VALUES (19, 'wash');
INSERT INTO tag VALUES (19, 'clean');
INSERT INTO tag VALUES (20, 'fun');
INSERT INTO tag VALUES (20, 'wash');
INSERT INTO tag VALUES (20, 'clean');
INSERT INTO tag VALUES (21, 'fun');
INSERT INTO tag VALUES (21, 'wash');
INSERT INTO tag VALUES (21, 'clean');
INSERT INTO tag VALUES (22, 'fun');
INSERT INTO tag VALUES (22, 'wash');
INSERT INTO tag VALUES (22, 'clean');
INSERT INTO tag VALUES (23, 'fun');
INSERT INTO tag VALUES (23, 'wash');
INSERT INTO tag VALUES (23, 'clean');
INSERT INTO tag VALUES (24, 'fun');
INSERT INTO tag VALUES (24, 'wash');
INSERT INTO tag VALUES (24, 'clean');
INSERT INTO tag VALUES (25, 'fun');
INSERT INTO tag VALUES (25, 'wash');
INSERT INTO tag VALUES (25, 'clean');
INSERT INTO tag VALUES (26, 'fun');
INSERT INTO tag VALUES (26, 'wash');
INSERT INTO tag VALUES (26, 'clean');
INSERT INTO tag VALUES (27, 'fun');
INSERT INTO tag VALUES (27, 'wash');
INSERT INTO tag VALUES (27, 'clean');
INSERT INTO tag VALUES (28, 'fun');
INSERT INTO tag VALUES (28, 'wash');
INSERT INTO tag VALUES (28, 'clean');
INSERT INTO tag VALUES (29, 'fun');
INSERT INTO tag VALUES (29, 'wash');
INSERT INTO tag VALUES (29, 'clean');
INSERT INTO tag VALUES (30, 'fun');
INSERT INTO tag VALUES (30, 'wash');
INSERT INTO tag VALUES (30, 'clean');
INSERT INTO tag VALUES (31, 'fun');
INSERT INTO tag VALUES (31, 'wash');
INSERT INTO tag VALUES (31, 'clean');
INSERT INTO tag VALUES (32, 'fun');
INSERT INTO tag VALUES (32, 'wash');
INSERT INTO tag VALUES (32, 'clean');
INSERT INTO tag VALUES (33, 'fun');
INSERT INTO tag VALUES (33, 'wash');
INSERT INTO tag VALUES (33, 'clean');
INSERT INTO tag VALUES (34, 'fun');
INSERT INTO tag VALUES (34, 'wash');
INSERT INTO tag VALUES (34, 'clean');
INSERT INTO tag VALUES (35, 'fun');
INSERT INTO tag VALUES (35, 'wash');
INSERT INTO tag VALUES (35, 'clean');
INSERT INTO tag VALUES (36, 'fun');
INSERT INTO tag VALUES (36, 'wash');
INSERT INTO tag VALUES (36, 'clean');
INSERT INTO tag VALUES (37, 'fun');
INSERT INTO tag VALUES (37, 'wash');
INSERT INTO tag VALUES (37, 'clean');
INSERT INTO tag VALUES (38, 'fun');
INSERT INTO tag VALUES (38, 'wash');
INSERT INTO tag VALUES (38, 'clean');
INSERT INTO tag VALUES (39, 'fun');
INSERT INTO tag VALUES (39, 'wash');
INSERT INTO tag VALUES (39, 'clean');
INSERT INTO tag VALUES (40, 'fun');
INSERT INTO tag VALUES (40, 'wash');
INSERT INTO tag VALUES (40, 'clean');
INSERT INTO tag VALUES (41, 'fun');
INSERT INTO tag VALUES (41, 'wash');
INSERT INTO tag VALUES (41, 'clean');
INSERT INTO tag VALUES (42, 'fun');
INSERT INTO tag VALUES (42, 'wash');
INSERT INTO tag VALUES (42, 'clean');
INSERT INTO tag VALUES (43, 'fun');
INSERT INTO tag VALUES (43, 'wash');
INSERT INTO tag VALUES (43, 'clean');
INSERT INTO tag VALUES (44, 'fun');
INSERT INTO tag VALUES (44, 'wash');
INSERT INTO tag VALUES (44, 'clean');
INSERT INTO tag VALUES (45, 'fun');
INSERT INTO tag VALUES (45, 'wash');
INSERT INTO tag VALUES (45, 'clean');
INSERT INTO tag VALUES (46, 'fun');
INSERT INTO tag VALUES (46, 'wash');
INSERT INTO tag VALUES (46, 'clean');
INSERT INTO tag VALUES (47, 'fun');
INSERT INTO tag VALUES (47, 'wash');
INSERT INTO tag VALUES (47, 'clean');
INSERT INTO tag VALUES (48, 'fun');
INSERT INTO tag VALUES (48, 'wash');
INSERT INTO tag VALUES (48, 'clean');
INSERT INTO tag VALUES (49, 'fun');
INSERT INTO tag VALUES (49, 'wash');
INSERT INTO tag VALUES (49, 'clean');
INSERT INTO tag VALUES (50, 'fun');
INSERT INTO tag VALUES (50, 'wash');
INSERT INTO tag VALUES (50, 'clean');
INSERT INTO tag VALUES (51, 'fun');
INSERT INTO tag VALUES (51, 'wash');
INSERT INTO tag VALUES (51, 'clean');
INSERT INTO tag VALUES (52, 'fun');
INSERT INTO tag VALUES (52, 'wash');
INSERT INTO tag VALUES (52, 'clean');
INSERT INTO tag VALUES (53, 'fun');
INSERT INTO tag VALUES (53, 'wash');
INSERT INTO tag VALUES (53, 'clean');
INSERT INTO tag VALUES (54, 'fun');
INSERT INTO tag VALUES (54, 'wash');
INSERT INTO tag VALUES (54, 'clean');
INSERT INTO tag VALUES (55, 'fun');
INSERT INTO tag VALUES (55, 'wash');
INSERT INTO tag VALUES (55, 'clean');
INSERT INTO tag VALUES (56, 'fun');
INSERT INTO tag VALUES (56, 'wash');
INSERT INTO tag VALUES (56, 'clean');
INSERT INTO tag VALUES (57, 'fun');
INSERT INTO tag VALUES (57, 'wash');
INSERT INTO tag VALUES (57, 'clean');
INSERT INTO tag VALUES (58, 'fun');
INSERT INTO tag VALUES (58, 'wash');
INSERT INTO tag VALUES (58, 'clean');
INSERT INTO tag VALUES (59, 'fun');
INSERT INTO tag VALUES (59, 'wash');
INSERT INTO tag VALUES (59, 'clean');
INSERT INTO tag VALUES (60, 'fun');
INSERT INTO tag VALUES (60, 'wash');
INSERT INTO tag VALUES (60, 'clean');

INSERT INTO flag VALUES
/*
(1, 'user1'),
(2, 'user1'),
(3, 'user1'),
(4, 'user1'),
(5, 'user1'),
(6, 'user1'),
(7, 'user1'),
(8, 'user1'),
(9, 'user1'),
(10, 'user1'),
(11, 'user1'),
(12, 'user1'),
(13, 'user1'),
(14, 'user1'),
(15, 'user1'),
(16, 'user1'),
(17, 'user1'),
(18, 'user1'),
(19, 'user1'),
(20, 'user1'),
(21, 'user1'),
(22, 'user1'),
(23, 'user1'),
(24, 'user1'),
(25, 'user1'),
(26, 'user1'),
(27, 'user1'),
(28, 'user1'),
(29, 'user1'),
(30, 'user1'),
*/
(31, 'user1'),
(32, 'user1'),
(33, 'user1'),
(34, 'user1'),
(35, 'user1'),
(36, 'user1'),
(37, 'user1'),
(38, 'user1'),
(39, 'user1'),
(40, 'user1'),
(41, 'user1'),
(42, 'user1'),
(43, 'user1'),
(44, 'user1'),
(45, 'user1'),
(46, 'user1'),
(47, 'user1'),
(48, 'user1'),
(49, 'user1'),
(50, 'user1'),
(51, 'user1'),
(52, 'user1'),
(53, 'user1'),
(54, 'user1'),
(55, 'user1'),
(56, 'user1'),
(57, 'user1'),
(58, 'user1'),
(59, 'user1'),
(60, 'user1'),
(61, 'user1'),
(62, 'user1'),
(63, 'user1'),
(64, 'user1'),
(65, 'user1'),
(66, 'user1'),
(67, 'user1'),
(68, 'user1'),
(69, 'user1'),
(70, 'user1'),
(71, 'user1'),
(72, 'user1'),
(73, 'user1'),
(74, 'user1'),
(75, 'user1'),
(76, 'user1'),
(77, 'user1'),
(78, 'user1'),
(79, 'user1'),
(80, 'user1'),
(81, 'user1'),
(82, 'user1'),
(83, 'user1'),
(84, 'user1'),
(85, 'user1'),
(86, 'user1'),
(87, 'user1'),
(88, 'user1'),
(89, 'user1'),
(90, 'user1'),
(91, 'user1'),
(92, 'user1'),
(93, 'user1'),
(94, 'user1'),
(95, 'user1'),
(96, 'user1'),
(97, 'user1'),
(98, 'user1'),
(99, 'user1'),
(100, 'user1'),
(101, 'user1'),
(102, 'user1'),
(103, 'user1'),
(104, 'user1'),
(105, 'user1'),
/*
(106, 'user1'),
(107, 'user1'),
(108, 'user1'),
(109, 'user1'),
(110, 'user1'),
(111, 'user1'),
(112, 'user1'),
(113, 'user1'),
(114, 'user1'),
(115, 'user1'),
(116, 'user1'),
(117, 'user1'),
(118, 'user1'),
(119, 'user1'),
(120, 'user1'),
*/

(1, 'user2'),
(2, 'user2'),
(3, 'user2'),
(4, 'user2'),
(5, 'user2'),
(6, 'user2'),
(7, 'user2'),
(8, 'user2'),
(9, 'user2'),
(10, 'user2'),
(11, 'user2'),
(12, 'user2'),
(13, 'user2'),
(14, 'user2'),
(15, 'user2'),
(16, 'user2'),
(17, 'user2'),
(18, 'user2'),
(19, 'user2'),
(20, 'user2'),
(21, 'user2'),
(22, 'user2'),
(23, 'user2'),
(24, 'user2'),
(25, 'user2'),
(26, 'user2'),
(27, 'user2'),
(28, 'user2'),
(29, 'user2'),
(30, 'user2'),
/*
(31, 'user2'),
(32, 'user2'),
(33, 'user2'),
(34, 'user2'),
(35, 'user2'),
(36, 'user2'),
(37, 'user2'),
(38, 'user2'),
(39, 'user2'),
(40, 'user2'),
(41, 'user2'),
(42, 'user2'),
(43, 'user2'),
(44, 'user2'),
(45, 'user2'),
(46, 'user2'),
(47, 'user2'),
(48, 'user2'),
(49, 'user2'),
(50, 'user2'),
(51, 'user2'),
(52, 'user2'),
(53, 'user2'),
(54, 'user2'),
(55, 'user2'),
(56, 'user2'),
(57, 'user2'),
(58, 'user2'),
(59, 'user2'),
(60, 'user2'),
*/
(61, 'user2'),
(62, 'user2'),
(63, 'user2'),
(64, 'user2'),
(65, 'user2'),
(66, 'user2'),
(67, 'user2'),
(68, 'user2'),
(69, 'user2'),
(70, 'user2'),
(71, 'user2'),
(72, 'user2'),
(73, 'user2'),
(74, 'user2'),
(75, 'user2'),
(76, 'user2'),
(77, 'user2'),
(78, 'user2'),
(79, 'user2'),
(80, 'user2'),
(81, 'user2'),
(82, 'user2'),
(83, 'user2'),
(84, 'user2'),
(85, 'user2'),
(86, 'user2'),
(87, 'user2'),
(88, 'user2'),
(89, 'user2'),
(90, 'user2'),
(91, 'user2'),
(92, 'user2'),
(93, 'user2'),
(94, 'user2'),
(95, 'user2'),
(96, 'user2'),
(97, 'user2'),
(98, 'user2'),
(99, 'user2'),
(100, 'user2'),
(101, 'user2'),
(102, 'user2'),
(103, 'user2'),
(104, 'user2'),
(105, 'user2'),
/*
(106, 'user2'),
(107, 'user2'),
(108, 'user2'),
(109, 'user2'),
(110, 'user2'),
(111, 'user2'),
(112, 'user2'),
(113, 'user2'),
(114, 'user2'),
(115, 'user2'),
(116, 'user2'),
(117, 'user2'),
(118, 'user2'),
(119, 'user2'),
(120, 'user2'),
*/

(1, 'user3'),
(2, 'user3'),
(3, 'user3'),
(4, 'user3'),
(5, 'user3'),
(6, 'user3'),
(7, 'user3'),
(8, 'user3'),
(9, 'user3'),
(10, 'user3'),
(11, 'user3'),
(12, 'user3'),
(13, 'user3'),
(14, 'user3'),
(15, 'user3'),
(16, 'user3'),
(17, 'user3'),
(18, 'user3'),
(19, 'user3'),
(20, 'user3'),
(21, 'user3'),
(22, 'user3'),
(23, 'user3'),
(24, 'user3'),
(25, 'user3'),
(26, 'user3'),
(27, 'user3'),
(28, 'user3'),
(29, 'user3'),
(30, 'user3'),
(31, 'user3'),
(32, 'user3'),
(33, 'user3'),
(34, 'user3'),
(35, 'user3'),
(36, 'user3'),
(37, 'user3'),
(38, 'user3'),
(39, 'user3'),
(40, 'user3'),
(41, 'user3'),
(42, 'user3'),
(43, 'user3'),
(44, 'user3'),
(45, 'user3'),
(46, 'user3'),
(47, 'user3'),
(48, 'user3'),
(49, 'user3'),
(50, 'user3'),
(51, 'user3'),
(52, 'user3'),
(53, 'user3'),
(54, 'user3'),
(55, 'user3'),
(56, 'user3'),
(57, 'user3'),
(58, 'user3'),
(59, 'user3'),
(60, 'user3'),
/*
(61, 'user3'),
(62, 'user3'),
(63, 'user3'),
(64, 'user3'),
(65, 'user3'),
(66, 'user3'),
(67, 'user3'),
(68, 'user3'),
(69, 'user3'),
(70, 'user3'),
(71, 'user3'),
(72, 'user3'),
(73, 'user3'),
(74, 'user3'),
(75, 'user3'),
(76, 'user3'),
(77, 'user3'),
(78, 'user3'),
(79, 'user3'),
(80, 'user3'),
(81, 'user3'),
(82, 'user3'),
(83, 'user3'),
(84, 'user3'),
(85, 'user3'),
(86, 'user3'),
(87, 'user3'),
(88, 'user3'),
(89, 'user3'),
(90, 'user3'),
*/
(91, 'user3'),
(92, 'user3'),
(93, 'user3'),
(94, 'user3'),
(95, 'user3'),
(96, 'user3'),
(97, 'user3'),
(98, 'user3'),
(99, 'user3'),
(100, 'user3'),
(101, 'user3'),
(102, 'user3'),
(103, 'user3'),
(104, 'user3'),
(105, 'user3'),
/*
(106, 'user3'),
(107, 'user3'),
(108, 'user3'),
(109, 'user3'),
(110, 'user3'),
(111, 'user3'),
(112, 'user3'),
(113, 'user3'),
(114, 'user3'),
(115, 'user3'),
(116, 'user3'),
(117, 'user3'),
(118, 'user3'),
(119, 'user3'),
(120, 'user3'),
*/

(1, 'user4'),
(2, 'user4'),
(3, 'user4'),
(4, 'user4'),
(5, 'user4'),
(6, 'user4'),
(7, 'user4'),
(8, 'user4'),
(9, 'user4'),
(10, 'user4'),
(11, 'user4'),
(12, 'user4'),
(13, 'user4'),
(14, 'user4'),
(15, 'user4'),
(16, 'user4'),
(17, 'user4'),
(18, 'user4'),
(19, 'user4'),
(20, 'user4'),
(21, 'user4'),
(22, 'user4'),
(23, 'user4'),
(24, 'user4'),
(25, 'user4'),
(26, 'user4'),
(27, 'user4'),
(28, 'user4'),
(29, 'user4'),
(30, 'user4'),
(31, 'user4'),
(32, 'user4'),
(33, 'user4'),
(34, 'user4'),
(35, 'user4'),
(36, 'user4'),
(37, 'user4'),
(38, 'user4'),
(39, 'user4'),
(40, 'user4'),
(41, 'user4'),
(42, 'user4'),
(43, 'user4'),
(44, 'user4'),
(45, 'user4'),
(46, 'user4'),
(47, 'user4'),
(48, 'user4'),
(49, 'user4'),
(50, 'user4'),
(51, 'user4'),
(52, 'user4'),
(53, 'user4'),
(54, 'user4'),
(55, 'user4'),
(56, 'user4'),
(57, 'user4'),
(58, 'user4'),
(59, 'user4'),
(60, 'user4'),
(61, 'user4'),
(62, 'user4'),
(63, 'user4'),
(64, 'user4'),
(65, 'user4'),
(66, 'user4'),
(67, 'user4'),
(68, 'user4'),
(69, 'user4'),
(70, 'user4'),
(71, 'user4'),
(72, 'user4'),
(73, 'user4'),
(74, 'user4'),
(75, 'user4'),
(76, 'user4'),
(77, 'user4'),
(78, 'user4'),
(79, 'user4'),
(80, 'user4'),
(81, 'user4'),
(82, 'user4'),
(83, 'user4'),
(84, 'user4'),
(85, 'user4'),
(86, 'user4'),
(87, 'user4'),
(88, 'user4'),
(89, 'user4'),
(90, 'user4');
/*
(91, 'user4'),
(92, 'user4'),
(93, 'user4'),
(94, 'user4'),
(95, 'user4'),
(96, 'user4'),
(97, 'user4'),
(98, 'user4'),
(99, 'user4'),
(100, 'user4'),
(101, 'user4'),
(102, 'user4'),
(103, 'user4'),
(104, 'user4'),
(105, 'user4'),
(106, 'user4'),
(107, 'user4'),
(108, 'user4'),
(109, 'user4'),
(110, 'user4'),
(111, 'user4'),
(112, 'user4'),
(113, 'user4'),
(114, 'user4'),
(115, 'user4'),
(116, 'user4'),
(117, 'user4'),
(118, 'user4'),
(119, 'user4'),
(120, 'user4'),
*/

INSERT INTO "thread" ("creator", "datetimestamp", "topic", "body", "status") VALUES
('abc',	'2018-10-13 00:08:41.61887+08',	'Gotta problem logging in',	'Anyone knows how to solve this??',	'ok');

INSERT INTO "reply" ("poster", "datetimestamp", "body", "threadid") VALUES
('abc',	'2018-10-13 00:12:29.818632+08',	'This problem is quite annoying',	1),
('abc',	'2018-10-19 01:59:02.649572+08',	'bro you just need to use your brains
Thank You',	1);

INSERT INTO "announcement" ("datetimestamp", "topic", "body") VALUES
('2018-10-19 01:48:59.464002+08',	'Happy New Year!',	'Admins would like to wish everybody a happy new year!!'),
('2018-10-19 01:50:01.291611+08',	'System Downtime',	'Dear all, System will be down from UTC+8 1100-1500 on Monday for maintenance');

CREATE OR REPLACE FUNCTION bounceback() RETURNS TRIGGER AS $$ 
BEGIN 
IF OLD.date_of_expiry<=NOW() THEN
 RETURN NULL;
ELSE
 UPDATE bid SET is_valid='FALSE' WHERE task_id=OLD.task_id;
 RETURN NEW;
END IF;
 END; $$ LANGUAGE PLPGSQL;
CREATE TRIGGER bounceback BEFORE UPDATE ON task FOR EACH ROW WHEN (OLD.bidding_deadline IS DISTINCT FROM NEW.bidding_deadline OR OLD.date_of_service IS DISTINCT FROM NEW.date_of_service) EXECUTE PROCEDURE bounceback();

CREATE OR REPLACE FUNCTION bouncebacknotify() RETURNS TRIGGER AS $$ 
BEGIN 
IF TG_OP='UPDATE' AND (SELECT b.date_of_service FROM task b WHERE b.task_id=OLD.task_id)<NOW()
 AND (OLD.feedback_from_creator IS DISTINCT FROM NEW.feedback_from_creator
 OR OLD.rating_from_creator IS DISTINCT FROM NEW.rating_from_creator
 OR OLD.feedback_to_creator IS DISTINCT FROM NEW.feedback_to_creator
 OR OLD.rating_to_creator IS DISTINCT FROM NEW.rating_to_creator)
 AND (OLD.feedback_from_creator IS NULL
 OR OLD.rating_from_creator IS NULL
 OR OLD.feedback_to_creator IS NULL
 OR OLD.rating_to_creator IS NULL)
 THEN /*task after date of service and feedbacks are being changed. bids can be updated only*/
    RETURN NEW;
ELSIF (SELECT t.date_of_expiry FROM task t WHERE t.task_id=OLD.task_id)<=NOW() THEN /*task after date of expiry. bids cannot be updated*/
    RETURN NULL;
ELSIF OLD.is_valid='TRUE' AND NEW.is_valid='FALSE' THEN /*task not after date of expiry and bids are being set to invalid. accepted case*/
	NEW.is_winning_bid:='FALSE';
	INSERT INTO message (sender_name, receiver_name, message_date, message_time, read_flag, subject, message) VALUES
	((SELECT t.requester_name FROM task t WHERE t.task_id=OLD.task_id), OLD.bidder_name,	NOW(),	NOW(),	'f',	'Your bid has bounced',	'Check your bid here: <a href=''bidpage.php?task_id=' || OLD.task_id || '''>View Bid Page</a>');
	RETURN NEW;
ELSIF (SELECT t.bidding_deadline FROM task t WHERE t.task_id=OLD.task_id)>=NOW() THEN /*task before bidding deadline. bids can be inserted, updated, deleted*/
    RETURN NEW;
ELSIF OLD.bid_amount=NEW.bid_amount AND OLD.is_approved IS DISTINCT FROM NEW.is_approved THEN /*task between bidding deadline and date of expiry. bids can be approved/unapproved. */
    RETURN NEW;
ELSE
    RETURN NULL;
END IF;
 END; $$ LANGUAGE PLPGSQL;
CREATE TRIGGER bouncebacknotify BEFORE UPDATE ON bid FOR EACH ROW EXECUTE PROCEDURE bouncebacknotify();

CREATE OR REPLACE FUNCTION stoptaskedit() RETURNS TRIGGER AS $$ 
BEGIN 
 RETURN NULL;
 END; $$ LANGUAGE PLPGSQL;
CREATE TRIGGER stoptaskedit BEFORE UPDATE OR DELETE ON task FOR EACH ROW WHEN (OLD.date_of_expiry<=NOW()) EXECUTE PROCEDURE stoptaskedit();