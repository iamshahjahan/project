create table users (
	user_id int unsigned AUTO_INCREMENT NOT NULL,
	name varchar(100) NOT NULL,
	email varchar(320) unique NOT NULL,          
	mobileno varchar(10) unique NOT NULL,
	profilepic varchar(100),
	passwd char(32) NOT NULL,
	about text,
	creation_time timestamp NOT NULL,
	is_active boolean NOT NULL default 0,
	hash_key char(32) NOT NULL,
	primary key (user_id)
);



create table tags (
	tag_id int unsigned AUTO_INCREMENT NOT NULL,
	name varchar(50) NOT NULL,
	primary key (tag_id)
);

create table questions (
	q_id int unsigned AUTO_INCREMENT NOT NULL,
	title varchar(50) NOT NULL,
	description text NOT NULL,
	creation_time timestamp NOT NULL,
	user_id int unsigned NOT NULL,
	foreign key (user_id) references users(user_id) on delete cascade on update cascade,
	primary key (q_id)
);

create table answers (
	a_id int unsigned AUTO_INCREMENT NOT NULL,
	q_id int unsigned NOT NULL,
	user_id int unsigned NOT NULL,
	answer_time timestamp NOT NULL,
	answer_text  text NOT NULL,
	foreign key (user_id) references users(user_id) on delete cascade on update cascade,
	foreign key (q_id) references questions(q_id) on delete cascade on update cascade,
	primary key (a_id)
);

create table question_tags (
	tag_id int unsigned NOT NULL,
	q_id  int unsigned NOT NULL,
	foreign key (tag_id) references tags(tag_id) on delete cascade on update cascade,
	foreign key (q_id) references questions(q_id) on delete cascade on update cascade,
	primary key (tag_id,q_id)
);

create table follows(
	tag_id int unsigned NOT NULL,
	user_id  int unsigned NOT NULL,
	foreign key (tag_id) references tags(tag_id) on delete cascade on update cascade,
	foreign key (user_id) references users(user_id) on delete cascade on update cascade,
	primary key (tag_id,user_id)
);