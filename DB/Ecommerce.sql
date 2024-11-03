DROP DATABASE IF EXISTS ecommerce;
CREATE DATABASE ecommerce;
USE ecommerce;
CREATE TABLE Utente (
    NomeUtente VARCHAR(255),
    Email VARCHAR(255) PRIMARY KEY,
    Token VARCHAR(255),
    Password VARCHAR(255) NOT NULL,
    IdRuolo INT unsigned DEFAULT 0,
    Saldo FLOAT DEFAULT 0.0
);

CREATE TABLE Gruppo(
    IdGruppo INT unsigned PRIMARY KEY AUTO_INCREMENT,
    NomeGruppo VARCHAR(255)
);



CREATE TABLE Genere(
    IdGenere INT unsigned PRIMARY KEY AUTO_INCREMENT,
    NomeGenere VARCHAR(255),
    ImmagineGenere VARCHAR(255)
);

CREATE TABLE IndirizzoOrdine(
                                IdIndirizzo INT unsigned PRIMARY KEY AUTO_INCREMENT,
                                Nome VARCHAR(255),
                                Cognome VARCHAR(255),
                                Citta VARCHAR(255) ,
                                CAP VARCHAR(5),
                                Via VARCHAR(255),
                                NumeroCivico INT unsigned,
                                Provincia VARCHAR(40),
                                NumeroTelefono VARCHAR(10)
);

CREATE TABLE Banner (
                        IdBanner INT unsigned PRIMARY KEY AUTO_INCREMENT,
                        NumeroBanner INT unsigned,
                        NomeBanner VARCHAR(255),
                        Riga_1 VARCHAR(255),
                        Riga_2 VARCHAR(255),
                        Bottone bool DEFAULT 0,
                        Testo_Bottone VARCHAR(255),
                        Link VARCHAR(255),
                        Visibile bool DEFAULT 1
);

CREATE TABLE Ordine (
                        IdOrdine INT unsigned PRIMARY KEY AUTO_INCREMENT,
                        Email Varchar(255),
                        TrackerID Varchar(255),
                        DataOrdine DATETIME,
                        StatoOrdine VARCHAR(255) DEFAULT 'In Attesa',
                        IdIndirizzo INT unsigned,
                        CONSTRAINT StatoOrdine CHECK (StatoOrdine IN ('In Attesa', 'In Preparazione','In Consegna', 'Consegnato') ),
                        FOREIGN KEY (Email) REFERENCES Utente(Email) ON DELETE NO ACTION ON UPDATE CASCADE,
                        FOREIGN KEY (IdIndirizzo) REFERENCES IndirizzoOrdine(IdIndirizzo) ON DELETE NO ACTION ON UPDATE NO ACTION

    -- da capire come gestire il clone delle informazioni
);
CREATE TABLE CasaEditrice(
    Nome VARCHAR(255) PRIMARY KEY,
    Sede VARCHAR(255),
    NumeroTelefono VARCHAR(10),
    UNIQUE (Sede,NumeroTelefono)
);

CREATE TABLE Serie (
    IdSerie INT unsigned PRIMARY KEY AUTO_INCREMENT,
    NomeSerie VARCHAR(255),
    Descrizione TEXT
);

CREATE TABLE Prodotto (
    IdProdotto INT unsigned PRIMARY KEY AUTO_INCREMENT,
    ISBN VARCHAR(100),
    IdSerie INT unsigned,
    CasaEditrice VARCHAR(255),
    Nome VARCHAR(255) NOT NULL,
    Descrizione TEXT,
    PrezzoAttuale DECIMAL(10,2) NOT NULL CHECK(PrezzoAttuale >= 0),
    PrezzoOriginale DECIMAL(10,2) NOT NULL CHECK(PrezzoOriginale >= 0),
    Quantita INT unsigned NOT NULL CHECK(Quantita >= 0),
    TipoProdotto VARCHAR(255) CHECK(TipoProdotto IN ('Manga', 'Magazine', 'Light Novel', 'Altro')),
    Immagine VARCHAR(255), -- path dell'immagine
    DataPubblicazione DATE ,
    DataInserimento DATE,
    VendutiTotali INT unsigned DEFAULT 0,
    FOREIGN KEY (CasaEditrice) REFERENCES CasaEditrice(Nome)ON DELETE NO ACTION  ON UPDATE CASCADE ,
    FOREIGN KEY (IdSerie) REFERENCES Serie(IdSerie) ON DELETE NO ACTION ON UPDATE CASCADE
);


CREATE TABLE Carrello (
    IdCarrello INT unsigned PRIMARY KEY AUTO_INCREMENT,
    Email VARCHAR(255),
    FOREIGN KEY (Email) REFERENCES Utente(Email) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE CarrelloOrdine (
                          IdCarrelloOrdine INT unsigned PRIMARY KEY AUTO_INCREMENT,
                          IdOrdine INT unsigned,
                          FOREIGN KEY (IdOrdine) REFERENCES Ordine(IdOrdine) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE ProdottoOrdine(
        IdProdottoOrdine INT unsigned PRIMARY KEY AUTO_INCREMENT,
        ISBN VARCHAR(100),
        CasaEditrice VARCHAR(255),
        Nome VARCHAR(255) NOT NULL,
        Prezzo DECIMAL(10,2) NOT NULL ,
        Quantita INT unsigned NOT NULL ,
        Descrizione TEXT,
        IdCarrelloOrdine INT unsigned,
        UNIQUE (IdProdottoOrdine, IdCarrelloOrdine),
        FOREIGN KEY (IdCarrelloOrdine) REFERENCES CarrelloOrdine(IdCarrelloOrdine) ON DELETE CASCADE ON UPDATE CASCADE

);



CREATE TABLE ProdottiNelCarrello(
	IdPC INT unsigned PRIMARY KEY AUTO_INCREMENT,
    IdCarrello INT unsigned,
    IdProdotto INT unsigned,
    UNIQUE (IdCarrello,IdProdotto),
    quantita INT default 1 CHECK (quantita >= 0),
    FOREIGN KEY (IdCarrello) REFERENCES Carrello(IdCarrello) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (IdProdotto) REFERENCES Prodotto(IdProdotto) ON DELETE CASCADE ON UPDATE CASCADE
    );
CREATE TABLE Coupon(
    CodiceCoupon VARCHAR(255) PRIMARY KEY,
    Sconto FLOAT CHECK(Sconto >= 0 AND Sconto <= 100),
    DataInizio DATE,
    DataFine DATE
);

CREATE TABLE HaCoupon(
    CodiceCoupon VARCHAR(255),
    IdProdotto INT unsigned,
    PRIMARY KEY (CodiceCoupon, IdProdotto),
    FOREIGN KEY (CodiceCoupon) REFERENCES Coupon(CodiceCoupon) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (IdProdotto) REFERENCES Prodotto(IdProdotto) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE HaGruppi(
    IdGruppo INT unsigned,
    Email VARCHAR(255),
    PRIMARY KEY (IdGruppo, Email),
    FOREIGN KEY (IdGruppo) REFERENCES Gruppo(IdGruppo) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Email) REFERENCES Utente(Email) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE AppartieneGenere(
    IdGenere INT unsigned,
    IdProdotto INT unsigned,
    PRIMARY KEY (IdGenere, IdProdotto),
    FOREIGN KEY (IdGenere) REFERENCES Genere(IdGenere) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (IdProdotto) REFERENCES Prodotto(IdProdotto) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Preferiti (
    IdPreferiti INT unsigned PRIMARY KEY AUTO_INCREMENT,
    Email VARCHAR(255),
    IdProdotto INT unsigned,
    FOREIGN KEY (Email) REFERENCES Utente(Email) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (IdProdotto) REFERENCES Prodotto(IdProdotto) ON DELETE CASCADE ON UPDATE CASCADE
);





CREATE TABLE Servizio(
    IdServizio INT unsigned AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(255),
    Script VARCHAR(255), -- da vedere l'implementazione (bisonga scriverci gli script a cui si ha accesso, consigliabile avenrne uno per ogni servizio)
    Descrizione TEXT,
    ServizioDefault VARCHAR(1) -- se il servizio é disponibile a tutti gli utenti allora mettici un *

);




CREATE TABLE HaServizi(
    IdServizio INT unsigned,
    IdGruppo INT unsigned,
    PRIMARY KEY (IdServizio, IdGruppo),
    FOREIGN KEY (IdServizio) REFERENCES Servizio(IdServizio) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (IdGruppo) REFERENCES Gruppo(IdGruppo) ON DELETE CASCADE ON UPDATE CASCADE

);

