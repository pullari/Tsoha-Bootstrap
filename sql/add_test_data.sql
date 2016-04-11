-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Account (username, password, isMod) VALUES ('pullis', '1234', true);
INSERT INTO Account (username, password) VALUES ('eriksi', '4321');

INSERT INTO Ryhma (name) VALUES ('Modit');
INSERT INTO Ryhma (name) VALUES ('Ei Modit');

INSERT INTO AccountGroup (accoID, groupID) VALUES (1, 1);
INSERT INTO AccountGroup (accoID, groupID) VALUES (2, 2);

INSERT INTO Topic (groupID) VALUES (1);
INSERT INTO Topic (groupID) VALUES (1);
INSERT INTO Topic (groupID) VALUES (2);

INSERT INTO Message (topicID, accoID, content) VALUES (1, 1, 'Testi viesti');
INSERT INTO Message (topicID, accoID, content) VALUES (1, 1, 'Sivupohjan testausviesti numero dos');
INSERT INTO Message (topicID, accoID, content) VALUES (1, 1, 'Lisäillään vielä testiviestejä');
INSERT INTO Message (topicID, accoID, content) VALUES (2, 1, 'Tämäkin toimii');
INSERT INTO Message (topicID, accoID, content) VALUES (3, 2, 'Eri group');