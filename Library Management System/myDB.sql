CREATE TABLE students (
	studentid SERIAL PRIMARY KEY NOT NULL,
	firstname VARCHAR(80) NOT NULL,
	lastname VARCHAR(80) NOT NULL,
	booktitle VARCHAR(80) NOT NULL,
	daterented DATE NOT NULL,
	datedue DATE NOT NULL
);

CREATE TABLE teachers (
	teacherid SERIAL PRIMARY KEY NOT NULL,
	firstname VARCHAR(80) NOT NULL,
	lastname VARCHAR(80) NOT NULL,
	booktitle VARCHAR(80) NOT NULL,
	daterented DATE NOT NULL,
	datedue DATE NOT NULL
);

CREATE TABLE books (
	bookid SERIAL PRIMARY KEY NOT NULL,
	title VARCHAR(80) NOT NULL,
	publishdate DATE NOT NULL
);


CREATE TABLE authors (
	authorid SERIAL PRIMARY KEY NOT NULL,
	firstname VARCHAR(80) NOT NULL,
	lastname VARCHAR(80) NOT NULL,
	bookpublished VARCHAR(80) NOT NULL,
	publishdate DATE NOT NULL
);

CREATE TABLE login
(
	id SERIAL PRIMARY KEY NOT NULL,
	username VARCHAR(80) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL
);