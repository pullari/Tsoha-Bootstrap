-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Account (username, password, isMod) VALUES ('jasjok', '1234', true);
INSERT INTO Account (username, password) VALUES ('minjok', '4321');
INSERT INTO Account (username, password) VALUES ('kukmuumuk', 'asd');

INSERT INTO Ryhma (name) VALUES ('Modit');
INSERT INTO Ryhma (name) VALUES ('Ei Modit');

INSERT INTO AccountGroup (accoID, groupID) VALUES (1, 1);
INSERT INTO AccountGroup (accoID, groupID) VALUES (2, 2);
INSERT INTO AccountGroup (accoID, groupID) VALUES (3, 2);

INSERT INTO Topic (groupID) VALUES (1);
INSERT INTO Topic (groupID) VALUES (1);
INSERT INTO Topic (groupID) VALUES (2);

INSERT INTO Message (topicID, accoID, content) VALUES (1, 1, 'Testi viesti');
INSERT INTO Message (topicID, accoID, content) VALUES (1, 1, 'Sivupohjan testausviesti numero dos');
INSERT INTO Message (topicID, accoID, content) VALUES (1, 1, 'Lisäillään vielä testiviestejä');
INSERT INTO Message (topicID, accoID, content) VALUES (2, 3, 'Tämäkin toimii');
INSERT INTO Message (topicID, accoID, content) VALUES (3, 3, 'Eri group');