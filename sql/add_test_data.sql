-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Katselija-taulun testidata
INSERT INTO Katselija (username, password) VALUES ('Apina', 'guest');
INSERT INTO Katselija (username, password) VALUES ('Lehmä', 'guest2');

-- Genre-taulun testidata
INSERT INTO Genre(nimi) VALUES ('jännitys');
INSERT INTO Genre(nimi) VALUES ('seikkailu');
INSERT INTO Genre(nimi) VALUES ('komedia');
INSERT INTO Genre(nimi) VALUES ('western');
INSERT INTO Genre(nimi) VALUES ('romantiikka');
INSERT INTO Genre(nimi) VALUES ('rikos');


-- Sarja-taulun testidata
INSERT INTO Sarja(nimi, network, kausia, jaksoja, julkaistu, kuvaus) VALUES ('Westworld', 'HBO', '1', '10', '02.10.2016', ' Westworld on yhdysvaltalainen science fiction -televisiosarja, jonka ovat luoneet Jonathan Nolan ja Lisa Joy. Se perustuu Michael Crichtonin ohjaamaan ja käsikirjoittamaan samannimiseen elokuvaan vuodelta 1973.');


-- Sarjan genret testidata
INSERT INTO SarjanGenret(sarja_id, genre_id) VALUES ('1', '1');
INSERT INTO SarjanGenret(sarja_id, genre_id) VALUES ('1', '3');