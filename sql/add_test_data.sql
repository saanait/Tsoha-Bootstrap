-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Katselija-taulun testidata
INSERT INTO Katselija (nimi, salasana) VALUES ('Apina', 'guest');
INSERT INTO Katselija (nimi, salasana) VALUES ('Lehmä', 'guest2');

-- Genre-taulun testidata
INSERT INTO Genre(nimi) VALUES ('jännitys');

-- Sarja-taulun testidata
INSERT INTO Sarja(nimi, genre_id, network, kausia, jaksoja, julkaistu, kuvaus) VALUES ('Westworld', '1', 'HBO', '1', '10', '02.10.2016', ' Westworld on yhdysvaltalainen science fiction -televisiosarja, jonka ovat luoneet Jonathan Nolan ja Lisa Joy. Se perustuu Michael Crichtonin ohjaamaan ja käsikirjoittamaan samannimiseen elokuvaan vuodelta 1973.');
INSERT INTO Sarja(nimi) VALUES ('Big Little Lies');
INSERT INTO Sarja(nimi) VALUES ('Insecure');