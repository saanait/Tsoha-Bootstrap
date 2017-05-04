-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Katselija(
    id SERIAL PRIMARY KEY,
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL
);

CREATE TABLE Genre(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    kuvaus varchar(400)
);

CREATE TABLE Sarja(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    katsottu boolean DEFAULT FALSE,
    kuvaus varchar(400),
    jaksoja INTEGER,
    kausia INTEGER,
    julkaistu DATE,
    network varchar(50)
);

CREATE TABLE SarjanGenret(
    id SERIAL PRIMARY KEY,
    sarja_id INTEGER REFERENCES Sarja(id) ON DELETE CASCADE,
    genre_id INTEGER REFERENCES Genre(id) ON DELETE CASCADE
);

CREATE TABLE Katselukerta(
    id SERIAL PRIMARY KEY,
    katselija_id INTEGER REFERENCES Katselija(id),
    sarja_id INTEGER REFERENCES Sarja(id),
    katsottuPvm DATE
);
