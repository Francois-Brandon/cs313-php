CREATE TABLE login
(
	id SERIAL PRIMARY KEY NOT NULL,
	username VARCHAR(80) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL
);

CREATE TABLE recipe (
	recipe_id serial PRIMARY KEY NOT NULL,
	recipe_name varchar(100) NOT NULL,
	user_id int REFERENCES login (id) NOT NULL,
	directions text NOT NULL,
	date_created timestamptz DEFAULT Now() NOT NULL

);

CREATE TABLE ingredients (
	ingredient_id serial PRIMARY KEY NOT NULL,
	recipe_id int REFERENCES recipe (recipe_id) NOT NULL,
	item text NOT NULL
);

CREATE TABLE rating (
	id serial PRIMARY KEY NOT NULL,
	recipe_id int REFERENCES recipe (recipe_id) NOT NULL,
	user_id int REFERENCES login (id) NOT NULL,
	stars int NOT NULL,
	comment text,
	date_created timestamptz DEFAULT Now() NOT NULL
);

CREATE TABLE favorites (
	id serial PRIMARY KEY NOT NULL,
	recipe_id int REFERENCES recipe (recipe_id) NOT NULL,
	user_id int REFERENCES login (id) NOT NULL
);