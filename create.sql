drop table match;
drop table Person;

create table Person(first_name varchar(12), 
	last_name varchar(18), 
	email varchar(20),
	password varchar(20),
	age int check (age >= 18), 
	major varchar(20), 
	gender varchar(10) not null,
	seeking_gender varchar(10) not null,
	language varchar(3), 
	county varchar(20),
	hobby varchar(50),
	approval_rating float(2) default 1.0 check (approval_rating between 0 and 9.99),
	primary key (email));

create table match (email1, email2, date_of_match date,
	primary key(email1, email2), foreign key(email1) references Person, foreign key(email2) references Person);
	
create user matchmaker with password 'kingofthenorth'; 
grant all on person to matchmaker;
grant all on match_id1_seq to matchmaker;
grant all on match_id2_seq to matchmaker;
grant all on match to matchmaker;
grant all on person_id_seq to matchmaker;
