-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Account(

	id SERIAL PRIMARY KEY,
	username varchar(30) NOT NULL,
	password varchar(30) NOT NULL,
	isMod boolean NOT NULL DEFAULT FALSE
);

CREATE TABLE Ryhma(

	id SERIAL PRIMARY KEY,
	name varchar(30) NOT NULL
);

CREATE TABLE AccountGroup(

	accoID INTEGER REFERENCES Account(id),
	groupID INTEGER REFERENCES Ryhma(id)
);

CREATE TABLE Topic(

	id SERIAL PRIMARY KEY,
	groupID INTEGER REFERENCES Ryhma(id)
);

CREATE TABLE Message(

	id SERIAL PRIMARY KEY,
	postTime timestamp DEFAULT now(),
	topicID INTEGER REFERENCES Topic(id),
	accoID INTEGER REFERENCES Account(id),
	content varchar(400) NOT NULL
);