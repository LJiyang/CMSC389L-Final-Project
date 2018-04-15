drop table match;
drop table Person;

create table Person(id serial unique, 
	first_name varchar(12), 
	last_name varchar(18), 
	age int check (age >= 18), 
	major varchar(20), 
	gender int not null,
	seeking_relationship_type int check (seeking_relationship_type between 1 and 3),
	seeking_gender int not null,
	language varchar(3), 
	county varchar(20),
	hobby varchar(50),
	approval_rating float(2) default 1.0 check (approval_rating between 0 and 9.99),
	primary key (id));

create table match (id1 serial, id2 serial, date_of_match date, Rating float(2),
	primary key(id1, id2), foreign key(id1) references Person, foreign key(id2) references Person);
	
create user matchmaker with password 'kingofthenorth'; 
grant all on person to matchmaker;
grant all on match_id1_seq to matchmaker;
grant all on match_id2_seq to matchmaker;
grant all on match to matchmaker;
grant all on person_id_seq to matchmaker;