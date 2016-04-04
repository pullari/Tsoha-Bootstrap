-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Account (username, password, isMod) VALUES ('pullis', '1234', true);
INSERT INTO Account (username, password) VALUES ('eriksi', '4321');

INSERT INTO Group (name) VALUES ('modit');

INSERT INTO AccountGroup (accoID, groupID) VALUES (0, 0);

INSERT INTO Topic (groupID) VALUES (0);

INSERT INTO Message (topicID, accoID, content) VALUES (0, 0, 'Testi viesti');