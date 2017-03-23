-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Katselija(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    salasana varchar(50) NOT NULL
);

CREATE TABLE Genre(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    kuvaus varchar(400)
);

CREATE TABLE Sarja(
    id SERIAL PRIMARY KEY,
    genre_id INTEGER REFERENCES Genre(id),
    nimi varchar(50) NOT NULL,
    katsottu boolean DEFAULT FALSE,
    kuvaus varchar(400),
    jaksoja INTEGER,
    kausia INTEGER,
    julkaistu DATE,
    network varchar(50)
);

CREATE TABLE Katselukerta(
    id SERIAL PRIMARY KEY,
    katselija_id INTEGER REFERENCES Katselija(id),
    sarja_id INTEGER REFERENCES Sarja(id),
    katsottu DATE
);
