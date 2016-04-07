-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Account (username, password, isMod) VALUES ('pullis', '1234', true);
INSERT INTO Account (username, password) VALUES ('eriksi', '4321');

INSERT INTO Ryhma (name) VALUES ('modit');

INSERT INTO AccountGroup (accoID, groupID) VALUES (1, 1);

INSERT INTO Topic (groupID) VALUES (1);

INSERT INTO Message (topicID, accoID, content) VALUES (1, 1, 'Testi viesti');
INSERT INTO Message (topicID, accoID, content) VALUES (1, 2, 'Sivupohjan testausviesti numero dos');