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

	accoID INTEGER REFERENCES Account(id) ON DELETE CASCADE,
	groupID INTEGER REFERENCES Ryhma(id) ON DELETE CASCADE
);

CREATE TABLE Topic(

	id SERIAL PRIMARY KEY,
	groupID INTEGER REFERENCES Ryhma(id) ON DELETE CASCADE
);

CREATE TABLE Message(

	id SERIAL PRIMARY KEY,
	postTime timestamp DEFAULT now(),
	topicID INTEGER REFERENCES Topic(id) ON DELETE CASCADE,
	accoID INTEGER REFERENCES Account(id) ON DELETE CASCADE,
	content varchar(400) NOT NULL
);