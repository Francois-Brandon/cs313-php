CREATE TABLE contributor (
	contributor_id serial NOT NULL PRIMARY KEY,
	name varchar(40) NOT NULL
);

CREATE TABLE recipe (
	recipe_id serial NOT NULL PRIMARY KEY,
	recipe_name varchar(100) NOT NULL,
	contributor_id int NOT NULL REFERENCES contributor (contributor_id),
	recipe_body text NOT NULL,
	number_of_ratings int NOT NULL,
	average_rating decimal NOT NULL
);

CREATE TABLE rating (
	rating_id serial NOT NULL PRIMARY KEY,
	recipe_id int NOT NULL REFERENCES recipe (recipe_id),
	rating_stars int NOT NULL
);