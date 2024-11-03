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
                        NomeBanner VARCHAR(255),
                        Riga_1 VARCHAR(255),
                        Riga_2 VARCHAR(255),
                        Riga_3 VARCHAR(255),
                        Immagine_Sfondo VARCHAR(255),
                        Bottone bool DEFAULT 0,
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

USE ecommerce;


-- Populate CasaEditrice
INSERT INTO CasaEditrice (Nome, Sede, NumeroTelefono) VALUES
('Panini','Modena', '0593456789'),
('Jpop', 'Milano', '21321331231'),
('StarComics', 'Roma', '3231123123123'),
('EdizioniBD', 'Torino', '0134567890'),
('Dynit', 'Napoli', '0812345678'),
('Goen', 'Bari', '0803456789'),
('Magic Press', 'Firenze', '0553456789'),
('GP Publishing', 'Venezia', '0413456789'),
('Mondadori', 'Milano', '213123123'),
('Feltrinelli', 'Roma', '0634567890'),
('Einaudi', 'Torino', '343242242424234'),
('Garzanti', 'Napoli', '432432342234324'),
('Laterza', 'Bari', '2342334242342'),
('Zanichelli', 'Bologna', '0513456789'),
('Rizzoli', 'Firenze', '32423423424'),
('Adelphi', 'Venezia', '432424242'),
('Dokusho Edizioni','Milano','0413456789'),
('Il Mulino', 'Cagliari', '0703456789');

-- Populate Serie
INSERT INTO Serie (NomeSerie, Descrizione) VALUES
('JuJutsuKaisen', 'Serie Section by Gege Akutami');

-- Populate Genere
INSERT INTO Genere (NomeGenere) VALUES
('Fantasy'),
('Science-Fiction'),
('Mystery'),
('Thriller'),
('Romance'),
('Horror'),
('Historical'),
('Young-Adult'),
('Non-fiction'),
('Biography');



-- Populate Utente (Assuming Email is the primary key)
INSERT INTO Utente (Email, NomeUtente, Password, IdRuolo) VALUES
('mario.rossi@example.com', 'Mario', SHA2('Rossi', 512 ), 1),
('luigi.verdi@example.com', 'Luigi', SHA2('Verdi',512 ), 0),
('anna.bianchi@example.com', 'Anna', SHA2('Bianchi',512 ), 0),
('paolo.neri@example.com', 'Paolo', SHA2('Neri',512 ), 0),
('laura.gialli@example.com', 'Laura', SHA2('Gialli',512 ), 0),
('giuseppe.blu@example.com', 'Giuseppe', SHA2('Blu',512 ), 0),
('francesca.viola@example.com', 'Francesca', SHA2('Viola',512 ), 0),
('stefano.arancio@example.com', 'Stefano', SHA2('Arancio',512 ), 0),
('elisa.rosa@example.com', 'Elisa', SHA2('Rosa',512 ), 0),
('roberto.marrone@example.com', 'Roberto', SHA2('Marrone',512 ), 0);

-- do the same thing of line 46 for all users



-- Populate Prodotto
INSERT INTO Prodotto (ISBN, IdSerie, CasaEditrice, Nome, Descrizione, PrezzoAttuale, PrezzoOriginale, Quantita, TipoProdotto, Immagine, DataPubblicazione, DataInserimento, VendutiTotali) VALUES
('9788868834143', 1, 'Panini', 'JuJutsuKaisen 0', 'Il prequel che getta luce sugli eventi della serie. Un volume imperdibile per i fan.', 4.94, 5.20, 0, 'Manga', 'Jjk_0.jpg', '2021-06-04', CURDATE(), 39),
('9788868836604', 1, 'Panini', 'JuJutsuKaisen 1', 'L’inizio della saga con Itadori Yuji, che scopre il mondo dell’occulto.', 4.94, 5.20, 85, 'Manga', 'Jjk_1.jpg', '2021-06-17', CURDATE(), 45),
('9788868838325', 1, 'Panini', 'JuJutsuKaisen 2', 'Scontri e rivelazioni continuano mentre Yuji affronta nuove sfide.', 4.94, 5.20, 92, 'Manga', 'Jjk_2.jpg', '2021-06-27', CURDATE(), 42),
('9788868839926', 1, 'Panini', 'JuJutsuKaisen 3', 'Un combattimento che segna profondamente i protagonisti.', 4.94, 5.20, 78, 'Manga', 'Jjk_3.jpg', '2021-07-10', CURDATE(), 50),
('9788868842391', 1, 'Panini', 'JuJutsuKaisen 4', 'Nuovi alleati e nemici emergono, ampliando il mondo dell’occulto.', 4.94, 5.20, 105, 'Manga', 'Jjk_4.jpg', '2021-07-23', CURDATE(), 37),
('9788868844081', 1, 'Panini', 'JuJutsuKaisen 5', 'La tensione sale mentre le battaglie diventano più intense.', 4.94, 5.20, 80, 'Manga', 'Jjk_5.jpg', '2021-08-05', CURDATE(), 55),
('9788868845101', 1, 'Panini', 'JuJutsuKaisen 6', 'Strategie e segreti vengono rivelati nel cuore della lotta.', 4.94, 5.20, 95, 'Manga', 'Jjk_6.jpg', '2021-08-20', CURDATE(), 48),
('9788868847570', 1, 'Panini', 'JuJutsuKaisen 7', 'Un viaggio nel passato svela il vero potere della stregoneria.', 4.94, 5.20, 88, 'Manga', 'Jjk_7.jpg', '2021-09-02', CURDATE(), 60),
('9788868849802', 1, 'Panini', 'JuJutsuKaisen 8', 'Itadori affronta nuove minacce che mettono alla prova la sua determinazione.', 4.94, 5.20, 82, 'Manga', 'Jjk_8.jpg', '2021-09-14', CURDATE(), 52),
('9788868852208', 1, 'Panini', 'JuJutsuKaisen 9', 'Le battaglie raggiungono un nuovo livello di ferocia e strategia.', 4.94, 5.20, 90, 'Manga', 'Jjk_9.jpg', '2021-09-29', CURDATE(), 47),
('9788868854448', 1, 'Panini', 'JuJutsuKaisen 10', 'Il destino dei protagonisti prende una piega inaspettata.', 4.94, 5.20, 97, 'Manga', 'Jjk_10.jpg', '2021-10-10', CURDATE(), 43),
('9788868856305', 1, 'Panini', 'JuJutsuKaisen 11', 'Nuove alleanze e tradimenti mettono alla prova i legami.', 4.94, 5.20, 75, 'Manga', 'Jjk_11.jpg', '2021-10-24', CURDATE(), 58),
('9788868858347', 1, 'Panini', 'JuJutsuKaisen 12', 'Le rivelazioni continuano a sorprendere i protagonisti.', 4.94, 5.20, 83, 'Manga', 'Jjk_12.jpg', '2021-11-06', CURDATE(), 49),
('9788868860852', 1, 'Panini', 'JuJutsuKaisen 13', 'La tensione aumenta mentre si avvicina uno scontro epocale.', 4.94, 5.20, 87, 'Manga', 'Jjk_13.jpg', '2021-11-20', CURDATE(), 56),
('9788868863396', 1, 'Panini', 'JuJutsuKaisen 14', 'La battaglia per il futuro del mondo occulto si intensifica.', 4.94, 5.20, 93, 'Manga', 'Jjk_14.jpg', '2021-12-03', CURDATE(), 41),
('9788868865376', 1, 'Panini', 'JuJutsuKaisen 15', 'Ogni scelta può cambiare il destino dei protagonisti.', 4.94, 5.20, 102, 'Manga', 'Jjk_15.jpg', '2021-12-16', CURDATE(), 53),
('9788868868032', 1, 'Panini', 'JuJutsuKaisen 16', 'Le battaglie interne ed esterne raggiungono un culmine.', 4.94, 5.20, 79, 'Manga', 'Jjk_16.jpg', '2021-12-29', CURDATE(), 44),
('9788868870561', 1, 'Panini', 'JuJutsuKaisen 17', 'Il confronto finale è più vicino che mai.', 4.94, 5.20, 96, 'Manga', 'Jjk_17.jpg', '2022-01-12', CURDATE(), 51),
('9788868872640', 1, 'Panini', 'JuJutsuKaisen 18', 'Le linee tra amico e nemico si sfumano ulteriormente.', 4.94, 5.20, 81, 'Manga', 'Jjk_18.jpg', '2022-01-26', CURDATE(), 59),
('9788868875115', 1, 'Panini', 'JuJutsuKaisen 19', 'Nuovi segreti e poteri emergono dalle ombre.', 4.94, 5.20, 89, 'Manga', 'Jjk_19.jpg', '2022-02-09', CURDATE(), 46),
('9788868877935', 1, 'Panini', 'JuJutsuKaisen 20', 'Il mondo dell’occulto è scosso dalle rivelazioni recenti.', 4.94, 5.20, 86, 'Manga', 'Jjk_20.jpg', '2022-02-23', CURDATE(), 54),
('9788868880461', 1, 'Panini', 'JuJutsuKaisen 21', 'Nuove minacce emergono dal passato dei protagonisti.', 4.94, 5.20, 94, 'Manga', 'Jjk_21.jpg', '2022-03-09', CURDATE(), 40),
('9788868882731', 1, 'Panini', 'JuJutsuKaisen 22', 'Le alleanze cambiano in vista della battaglia finale.', 4.94, 5.20, 77, 'Manga', 'Jjk_22.jpg', '2022-03-24', CURDATE(), 57),
('9788868885596', 1, 'Panini', 'JuJutsuKaisen 23', 'Il destino del mondo occulto è in bilico.', 4.94, 5.20, 91, 'Manga', 'Jjk_23.jpg', '2022-04-08', CURDATE(), 38),
('9788868888245', 1, 'Panini', 'JuJutsuKaisen 24', 'Le battaglie decisive sono ormai imminenti.', 4.94, 5.20, 84, 'Manga', 'Jjk_24.jpg', '2022-04-23', CURDATE(), 61),
('9788868890569', 1, 'Panini', 'JuJutsuKaisen 25', 'L’epilogo si avvicina mentre le tensioni raggiungono il massimo.', 4.94, 5.20, 98, 'Manga', 'Jjk_25.jpg', '2022-05-07', CURDATE(), 36),
('9788868890761', 1, 'Panini', 'JuJutsuKaisen Winter Edition','L’inizio della saga con Itadori Yuji, che scopre il mondo dell’occulto.' , 9.15, 12.99, 99, 'Manga', 'Jjk_CV.jpg', '2022-05-10', CURDATE(), 11),
('9788868890761', 1, 'Panini', 'JuJutsuKaisen Romanzo', 'Il romanzo ispirato al prequel dell\'opera', 8.94, 10.20, 99, 'Manga', 'Jjk_Rm.jpg', '2022-08-15', CURDATE(), 34);

-- Populate Carrello

INSERT INTO Carrello (Email) VALUES
('mario.rossi@example.com'),
('luigi.verdi@example.com'),
('anna.bianchi@example.com'),
('paolo.neri@example.com'),
('laura.gialli@example.com'),
('giuseppe.blu@example.com'),
('francesca.viola@example.com'),
('stefano.arancio@example.com'),
('elisa.rosa@example.com'),
('roberto.marrone@example.com');

-- Populate ProdottiNelCarrello
INSERT INTO ProdottiNelCarrello (IdCarrello, IdProdotto, quantita) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 3, 3),
(4, 4, 1),
(5, 5, 2),
(6, 6, 1),
(7, 7, 4),
(8, 8, 1),
(9, 9, 2),
(10, 10, 1);

-- Populate Coupon
INSERT INTO Coupon (CodiceCoupon, Sconto, DataInizio, DataFine) VALUES
('SUMMER21', 10, '2024-06-01', '2024-08-31'),
('WINTER21', 15, '2024-12-01', '2025-02-28'),
('SPRING21', 20, '2024-03-01', '2024-05-31'),
('FALL21', 25, '2024-09-01', '2024-11-30'),
('NEWYEAR21', 30, '2024-12-31', '2025-01-01'),
('BLACKFRIDAY21', 50, '2024-11-27', '2024-11-30'),
('CYBERMONDAY21', 40, '2024-12-01', '2024-12-02'),
('EASTER21', 15, '2024-04-10', '2024-04-20'),
('HALLOWEEN21', 20, '2024-10-31', '2024-11-01'),
('CHRISTMAS21', 25, '2024-12-24', '2024-12-26');

-- Populate HaCoupon
INSERT INTO HaCoupon (CodiceCoupon, IdProdotto) VALUES
('SUMMER21', 1),
('WINTER21', 2),
('SPRING21', 3),
('FALL21', 4),
('NEWYEAR21', 5),
('BLACKFRIDAY21', 6),
('CYBERMONDAY21', 7),
('EASTER21', 8),
('HALLOWEEN21', 9),
('CHRISTMAS21', 10);




-- Populate Servizio
INSERT INTO Servizio (Nome, Script, Descrizione, ServizioDefault) VALUES
('EmailService', 'email_script.sh', 'Service to send emails', '*'),
('PaymentService', 'payment_script.sh', 'Service to process payments', '*'),
('NotificationService', 'notification_script.sh', 'Service to send notifications', '*'),
('ReportService', 'report_script.sh', 'Service to generate reports', '*'),
('LoggingService', 'logging_script.sh', 'Service to log events', '*'),
('BackupService', 'backup_script.sh', 'Service to backup data', '*'),
('AuthenticationService', 'auth_script.sh', 'Service to authenticate users', '*'),
('DataService', 'data_script.sh', 'Service to manage data', '*'),
('SearchService', 'search_script.sh', 'Service to search data', '*'),
('AnalyticsService', 'analytics_script.sh', 'Service to analyze data', '*');


-- Populate Gruppo (Assuming IdGruppo is the primary key)
INSERT INTO Gruppo (NomeGruppo) VALUES
('AdminGroup'),
('EditorGroup'),
('UserGroup'),
('GuestGroup'),
('ModeratorGroup'),
('ContributorGroup'),
('AuthorGroup'),
('ReviewerGroup'),
('SubscriberGroup'),
('SupportGroup');

-- Populate HaGruppi
INSERT INTO HaGruppi (IdGruppo, Email) VALUES
(1, 'mario.rossi@example.com'),
(2, 'luigi.verdi@example.com'),
(3, 'anna.bianchi@example.com'),
(4, 'paolo.neri@example.com'),
(5, 'laura.gialli@example.com'),
(6, 'giuseppe.blu@example.com'),
(7, 'francesca.viola@example.com'),
(8, 'stefano.arancio@example.com'),
(9, 'elisa.rosa@example.com'),
(10, 'roberto.marrone@example.com');

-- Populate AppartieneGenere
INSERT INTO AppartieneGenere (IdGenere, IdProdotto) VALUES
(1, 1),
(1,2),
(1,3),
(1,4),
(1,5),
(1,6),
(1,7),
(1,8),
(1,9),
(1,10),
(1,11),
(1,12),
(1,13),
(1,14),
(1,15),
(1,16),
(1,17),
(1,18),
(1,19),
(1,20),
(1,21),
(1,22),
(1,23),
(3,24),
(1,25),
(1,26),
(1,27),
(1,28);


-- Populate Preferiti
INSERT INTO Preferiti (Email, IdProdotto) VALUES
('mario.rossi@example.com', 1),
('luigi.verdi@example.com', 2),
('anna.bianchi@example.com', 3),
('paolo.neri@example.com', 4),
('laura.gialli@example.com', 5),
('giuseppe.blu@example.com', 6),
('francesca.viola@example.com', 7),
('stefano.arancio@example.com', 8),
('elisa.rosa@example.com', 9),
('roberto.marrone@example.com', 10);


-- Populate HaServizi
INSERT INTO HaServizi (IdServizio, IdGruppo) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

delimiter $
USE ecommerce$
DROP PROCEDURE IF EXISTS ListaGeneri$

CREATE PROCEDURE ListaGeneri()
BEGIN
    SELECT NomeGenere AS Categoria, IdGenere FROM Genere;
END$


DROP PROCEDURE IF EXISTS ListaProdotti$
CREATE PROCEDURE ListaProdotti()
BEGIN
    SELECT p.Nome, p.VendutiTotali, g.NomeGenere as Categoria, p.PrezzoAttuale, p.PrezzoOriginale, p.Descrizione, p.ISBN, p.CasaEditrice, p.DataPubblicazione, p.VendutiTotali, p.Quantita, p.IdProdotto, p.immagine as Immagine
        FROM Prodotto p
        JOIN ecommerce.appartienegenere a on p.IdProdotto = a.IdProdotto
        JOIN ecommerce.genere g on a.IdGenere = g.IdGenere;

END$


DROP PROCEDURE IF EXISTS TopXProdotti$
CREATE PROCEDURE TopXProdotti(Limited INT)
BEGIN
    SELECT Nome, VendutiTotali, g.NomeGenere as NomeGenere, PrezzoAttuale, PrezzoOriginale, Descrizione, ISBN, CasaEditrice, DataPubblicazione,Prodotto.VendutiTotali as Quantita, Prodotto.IdProdotto, Prodotto.immagine as Immagine
    FROM Prodotto
    JOIN ecommerce.appartienegenere a on Prodotto.IdProdotto = a.IdProdotto
    JOIN ecommerce.genere g on a.IdGenere = g.IdGenere

    ORDER By VendutiTotali DESC
    LIMIT Limited;
END$

DROP PROCEDURE IF EXISTS TopXCaseEditrici$
CREATE PROCEDURE TopXCaseEditrici(Limited INT)
BEGIN
    create temporary table temp as

    Select prodotto.Nome,prodotto.CasaEditrice, prodotto.VendutiTotali
    from prodotto
    where DataPubblicazione < DATE_SUB(CURDATE(), INTERVAL 1 MONTH )
    order by prodotto.VendutiTotali desc
    limit 8;

    select CasaEditrice
    from temp
    group by CasaEditrice;
    drop table temp;

END$

DROP PROCEDURE IF EXISTS ListaProdottiPerGenere$
CREATE PROCEDURE ListaProdottiPerGenere(genere VARCHAR(255))
BEGIN
    SELECT *
    FROM ecommerce.prodotto p
             JOIN appartienegenere a ON p.IdProdotto = a.IdProdotto
             JOIN genere g ON a.IdGenere = g.IdGenere
    WHERE g.NomeGenere = genere;
END$



DROP PROCEDURE IF EXISTS UserVerification$
CREATE PROCEDURE UserVerification(Mail VARCHAR(255), psw VARCHAR(255))
BEGIN
    SELECT *
    FROM Utente
    WHERE Email = Mail
      AND Password = psw
    LIMIT 1;
END$

DROP PROCEDURE IF EXISTS TokenVerification$
CREATE PROCEDURE TokenVerification(Token VARCHAR(255))
BEGIN
    SELECT *
    FROM Utente u
    WHERE u.Token = Token
    LIMIT 1;
END$

DROP PROCEDURE IF EXISTS ModifyToken$
CREATE PROCEDURE ModifyToken(Mail VARCHAR(255), NewToken VARCHAR(255))
BEGIN
    UPDATE Utente
    SET Token = NewToken
    WHERE Email = Mail;
END$

DROP PROCEDURE IF EXISTS SignUpUser$
CREATE PROCEDURE SignUpUser(Email VARCHAR(255), Password VARCHAR(255), NomeUtente VARCHAR(255))
BEGIN
    INSERT INTO Utente(Email, Password, NomeUtente)
    VALUES (Email, Password, NomeUtente);
    SET @idU = LAST_INSERT_ID();
    INSERT INTO Carrello(Email)
    VALUES (Email);
END$

DROP PROCEDURE IF EXISTS AddxToCart$
CREATE PROCEDURE AddxToCart(IdCarrello VARCHAR(255), IdProdotto VARCHAR(255), QuantitaAggiunta int)
BEGIN
    If exists(select * from ProdottiNelCarrello pc where pc.IdCarrello = IdCarrello and pc.IdProdotto = IdProdotto)
    then
        update ProdottiNelCarrello pc
        Set Quantita = Quantita + QuantitaAggiunta
        where pc.IdCarrello = IdCarrello && pc.IdProdotto = IdProdotto;
    else
        INSERT INTO ProdottiNelCarrello(IdCarrello, IdProdotto, Quantita)
        Values (IdCarrello, IdProdotto, QuantitaAggiunta);
    end if;
END$

DROP PROCEDURE IF EXISTS RemoveFromCart$
CREATE PROCEDURE RemoveFromCart(IdCarrello VARCHAR(255), IdProdotto VARCHAR(255))
BEGIN
    DELETE pc FROM ProdottiNelCarrello AS pc WHERE pc.IdCarrello = IdCarrello AND pc.IdProdotto = IdProdotto;
END$


DROP PROCEDURE IF EXISTS ModifyQuantityCart$
CREATE PROCEDURE ModifyQuantityCart(IdCarrello VARCHAR(255), IdProdotto VARCHAR(255), NuovaQuantita int)
BEGIN
    update ProdottiNelCarrello pc
    Set Quantita=NuovaQuantita
    Where pc.IdCarrello = IdCarrello and pc.IdProdotto = IdProdotto;
END$

DROP PROCEDURE IF EXISTS GetCart$
CREATE PROCEDURE GetCart(IdCarrello VARCHAR(255))
BEGIN
    Select *
    From Carrello
             JOIN ProdottiNelCarrello ON Carrello.IdCarrello = ProdottiNelCarrello.IdCarrello
             JOIN Prodotto ON ProdottiNelCarrello.IdProdotto = Prodotto.IdProdotto
             JOIN serie ON Prodotto.IdSerie = serie.IdSerie
    WHERE Carrello.IdCarrello = IdCarrello;
END$


DROP PROCEDURE IF EXISTS CheckToken$
CREATE PROCEDURE CheckToken(Email VARCHAR(255), Token VARCHAR(255))
BEGIN
    SELECT *
    FROM Utente u
    WHERE u.Email = Email
      AND u.Token = Token;
    -- LIMIT 1;
END$

DROP PROCEDURE IF EXISTS RemoveToken$
CREATE PROCEDURE RemoveToken(Token VARCHAR(255))
BEGIN
    UPDATE Utente u
    SET u.Token = NULL
    WHERE u.Token = Token;

END$

DROP PROCEDURE IF EXISTS ChangePassword$
CREATE PROCEDURE ChangePassword(Email VARCHAR(255), Old_Password VARCHAR(255), New_Password VARCHAR(255))
BEGIN
    UPDATE Utente u
    SET u.Password = New_Password
    WHERE u.Email = Email
      AND u.Password = Old_Password;
END$


DROP FUNCTION IF EXISTS SplitString$
CREATE FUNCTION SplitString(str TEXT, delim CHAR(1), pos INT) RETURNS TEXT
BEGIN
    DECLARE output TEXT;
    SET output = REPLACE(SUBSTRING(SUBSTRING_INDEX(str, delim, pos),
                                   LENGTH(SUBSTRING_INDEX(str, delim, pos - 1)) + 1),
                         delim, '');
    RETURN output;
END$


DROP PROCEDURE IF EXISTS GetProductsByCategories$
CREATE PROCEDURE GetProductsByCategories(IN categories_list VARCHAR(255))
BEGIN
    DECLARE idx INT DEFAULT 1;
    DECLARE category_name VARCHAR(255);
    DECLARE done INT DEFAULT 0;

    -- Temp table to store the list of categories
    DROP TEMPORARY TABLE IF EXISTS temp_categories;
    CREATE TEMPORARY TABLE temp_categories
    (
        category_name VARCHAR(50)
    );

    -- Loop to insert each category from the input list into the temp table
    split_loop:
    LOOP
        SET category_name = SplitString(categories_list, ',', idx);
        IF category_name = '' THEN
            SET done = 1;
        ELSE
            INSERT INTO temp_categories (category_name) VALUES (category_name);
            SET idx = idx + 1;
        END IF;

        IF done = 1 THEN
            LEAVE split_loop;
        END IF;
    END LOOP split_loop;

    -- Query to fetch products belonging to at least one of the provided categories
    SELECT p.IdProdotto, p.Nome, g.NomeGenere
    FROM prodotto p
             JOIN AppartieneGenere ag ON ag.IdProdotto = p.IdProdotto
             JOIN Genere g ON ag.IdGenere = g.IdGenere
             JOIN temp_categories tc ON g.NomeGenere = tc.category_name
    GROUP BY p.IdProdotto;

END $

DROP PROCEDURE IF EXISTS AdminVerification$
CREATE PROCEDURE AdminVerification(Mail VARCHAR(255), psw VARCHAR(255))
    BEGIN SELECT * FROM Utente
    WHERE Email = Mail
      AND Password = psw
      AND IdRuolo = 1
    LIMIT 1;
END$


DROP PROCEDURE IF EXISTS SearchItems$
CREATE PROCEDURE SearchItems(request varchar(255))
BEGIN
    Select *
    From Prodotto p
    Where Nome LIKE concat('%', request, '%');
END$



DROP PROCEDURE IF EXISTS UserWishlist$
CREATE PROCEDURE UserWishlist(Email VARCHAR(255))
BEGIN
    SELECT p.*
    FROM Prodotto p
             JOIN Preferiti pr ON p.IdProdotto = pr.IdProdotto
    WHERE pr.Email = Email;
END$

DROP PROCEDURE IF EXISTS GetProductById$
CREATE PROCEDURE GetProductById(IdProdotto INT)
BEGIN
    SELECT *
    FROM Prodotto as p
    WHERE p.IdProdotto = IdProdotto;
END$

DROP PROCEDURE IF EXISTS IdCartFromEmail$
CREATE PROCEDURE IdCartFromEmail(Email VARCHAR(255))
BEGIN
    SELECT IdCarrello
    FROM Carrello as c
    WHERE c.Email = Email;
END$

DROP PROCEDURE IF EXISTS GetAllCaseEditrici$
CREATE PROCEDURE GetAllCaseEditrici()
BEGIN
    SELECT *
    FROM casaeditrice;
END$

DROP PROCEDURE IF EXISTS UserWishlistAdd$
CREATE PROCEDURE UserWishlistAdd(Email VARCHAR(255), IdProdotto INT)
BEGIN
    IF NOT EXISTS(SELECT * FROM Preferiti WHERE Preferiti.Email = Email AND Preferiti.IdProdotto = IdProdotto) THEN
    INSERT INTO Preferiti(Email, IdProdotto)
    VALUES (Email, IdProdotto);
    END IF;
END$

DROP PROCEDURE  IF EXISTS UserWishlistRemove$
CREATE PROCEDURE UserWishlistRemove(Email VARCHAR(255), IdProdotto INT)
BEGIN
    DELETE FROM Preferiti
    WHERE preferiti.Email = Email AND preferiti.IdProdotto = IdProdotto;
END$

DROP PROCEDURE IF EXISTS AddCoupon$
CREATE PROCEDURE AddCoupon(CodiceCoupon VARCHAR(255), Sconto FLOAT, DataInizio DATE, DataFine DATE)
BEGIN
    INSERT INTO Coupon(CodiceCoupon, Sconto, DataInizio, DataFine)
    VALUES (CodiceCoupon, Sconto, DataInizio, DataFine);
END$

DROP PROCEDURE IF EXISTS AssignCouponWithCasaEditrice$
CREATE PROCEDURE AssignCouponWithCasaEditrice(CodiceCoupon VARCHAR(255), CasaEditrice VARCHAR(255))
BEGIN
    INSERT INTO hacoupon(CodiceCoupon, IdProdotto)
    SELECT CodiceCoupon, IdProdotto
    FROM Prodotto
    WHERE Prodotto.CasaEditrice = CasaEditrice;

END$

DROP PROCEDURE IF EXISTS ClearAllWishlist$
CREATE PROCEDURE ClearAllWishlist(Email VARCHAR(255))
BEGIN
    DELETE FROM Preferiti
    WHERE Preferiti.Email = Email;
END$

DROP PROCEDURE IF EXISTS ListaDi$
CREATE PROCEDURE ListaDi(Type VARCHAR(255))
BEGIN
    Select *
        From prodotto
            Where TipoProdotto = Type;
END$


DROP PROCEDURE IF EXISTS FilterSearch$
CREATE PROCEDURE FilterSearch(
    IN Search VARCHAR(255),
    IN Categoria VARCHAR(255),
    IN CasaEditrice VARCHAR(255),
    IN OrderBy VARCHAR(255)
)
BEGIN
    DECLARE baseQuery TEXT;
    DECLARE whereClause TEXT;
    DECLARE orderByClause TEXT;
    DECLARE finalQuery TEXT;


    IF Search='' THEN
        SET Search = NULL;
    END IF;

    IF Categoria='' THEN
        SET Categoria = NULL;
    END IF;

    IF CasaEditrice='' THEN
        SET CasaEditrice = NULL;
    END IF;

    IF OrderBy='' THEN
        SET OrderBy = NULL;
    END IF;


    -- Base query
    SET baseQuery = 'SELECT * FROM Prodotto p LEFT JOIN ecommerce.appartienegenere a ON p.IdProdotto = a.IdProdotto LEFT JOIN ecommerce.genere g ON a.IdGenere = g.IdGenere';

    -- WHERE clause
    SET whereClause = ' WHERE p.Nome LIKE CONCAT("%", ?, "%")';

    IF Categoria IS NOT NULL THEN
        SET whereClause = CONCAT(whereClause, ' AND g.NomeGenere = ?');
    END IF;

    IF CasaEditrice IS NOT NULL THEN
        SET whereClause = CONCAT(whereClause, ' AND p.CasaEditrice = ?');
    END IF;

    -- ORDER BY clause
    SET orderByClause = ' ORDER BY ';
    CASE
        WHEN OrderBy = 'Nome' THEN
            SET orderByClause = CONCAT(orderByClause, 'p.Nome');
        WHEN OrderBy = 'CasaEditrice' THEN
            SET orderByClause = CONCAT(orderByClause, 'p.CasaEditrice');
        WHEN OrderBy = 'DataPubblicazione' THEN
            SET orderByClause = CONCAT(orderByClause, 'p.DataPubblicazione ASC');
        WHEN OrderBy = 'PrezzoCrescente' THEN
            SET orderByClause = CONCAT(orderByClause, 'CASE WHEN p.PrezzoAttuale = 0 THEN p.PrezzoOriginale ELSE p.PrezzoAttuale END');
        WHEN OrderBy = 'PrezzoDecrescente' THEN
            SET orderByClause = CONCAT(orderByClause, 'CASE WHEN p.PrezzoAttuale = 0 THEN p.PrezzoOriginale ELSE p.PrezzoAttuale END DESC');
        ELSE
            SET orderByClause = CONCAT(orderByClause, 'p.IdProdotto');
        END CASE;

    -- LIMIT clause
    -- Construct final query
    SET finalQuery = CONCAT(baseQuery, whereClause, orderByClause);

    -- Prepare and execute the statement
    if Search is null then
        SET Search = '';
    end if;

    SET @param1 = Search;
    IF Categoria IS NULL AND CasaEditrice IS NULL THEN

        PREPARE stmt FROM finalQuery;
        EXECUTE stmt USING @param1;
    ELSEIF Categoria IS NULL THEN
        SET @param2 = CasaEditrice;

        PREPARE stmt FROM finalQuery;
        EXECUTE stmt USING @param1, @param2;
    ELSEIF CasaEditrice IS NULL THEN

        SET @param2 = Categoria;
        PREPARE stmt FROM finalQuery;
        EXECUTE stmt USING @param1, @param2;
    ELSE
        SET @param2 = Categoria;
        SET @param3 = CasaEditrice;

        PREPARE stmt FROM finalQuery;
        EXECUTE stmt USING @param1, @param2, @param3;
    END IF;

    -- Deallocate the prepared statement
    DEALLOCATE PREPARE stmt;
END$

DROP PROCEDURE IF EXISTS ClearCart$
CREATE PROCEDURE ClearCart(IdCarrello VARCHAR(255))
BEGIN
    DELETE FROM ProdottiNelCarrello
    WHERE ProdottiNelCarrello.IdCarrello = IdCarrello;
END$

DROP PROCEDURE IF EXISTS CountOrder$
CREATE PROCEDURE CountOrder(Email VARCHAR(255))
BEGIN
    SELECT COUNT(*) as NumeroOrdini
    FROM Ordine
    WHERE Ordine.Email = Email;
END$

DROP PROCEDURE IF EXISTS CountWishlist$
CREATE PROCEDURE CountWishlist(Email VARCHAR(255))
BEGIN
    SELECT COUNT(*) as NumeroProdotti
    FROM Preferiti
    WHERE Preferiti.Email = Email;
END$

DROP PROCEDURE IF EXISTS CreateOrder$
CREATE PROCEDURE CreateOrder(Nome VARCHAR(255), Cognome VARCHAR(255), mail VARCHAR(255), Telefono VARCHAR(255), Via VARCHAR(255), NumeroCivico VARCHAR(20), Citta VARCHAR(255), Provincia VARCHAR(255), CAP VARCHAR(255), IdCarrello Int unsigned)

BEGIN
    SET @TIMESTAMP = NOW();



    INSERT INTO IndirizzoOrdine(Nome, Cognome, Citta, CAP, Via, NumeroCivico, Provincia, NumeroTelefono)
    VALUES (Nome, Cognome, Citta, CAP, Via, NumeroCivico, Provincia, Telefono);

    SET @IndirizzoTarget = LAST_INSERT_ID();

    INSERT INTO Ordine(Email,DataOrdine,StatoOrdine,IdIndirizzo)
    Value (mail,@TIMESTAMP,DEFAULT,@IndirizzoTarget);
    SET @IdOrdineTarget = LAST_INSERT_ID();

    INSERT INTO CarrelloOrdine(IdOrdine)
    Value (@IdOrdineTarget);

    SET @IdCarrelloTarget = LAST_INSERT_ID();

    INSERT INTO ProdottoOrdine(ISBN,CasaEditrice,Nome,Descrizione,Prezzo,Quantita,IdCarrelloOrdine)
    SELECT p.ISBN,p.CasaEditrice,p.Nome,p.Descrizione,p.PrezzoOriginale,pc.Quantita,@IdCarrelloTarget
    FROM Prodotto p
    JOIN ecommerce.prodottinelcarrello pc on p.IdProdotto = pc.IdProdotto
    WHERE pc.IdCarrello = idCarrello;



    DELETE FROM prodottinelcarrello WHERE prodottinelcarrello.IdCarrello = IdCarrello;

END$


DROP PROCEDURE IF EXISTS ChangeUsername$
CREATE PROCEDURE ChangeUsername(Mail VARCHAR(255), NewUsername VARCHAR(255))
BEGIN
    UPDATE Utente u
    SET u.NomeUtente = NewUsername
    WHERE u.Email = Mail;
END$

DROP PROCEDURE IF EXISTS CheckPassword$
CREATE PROCEDURE CheckPassword(Email VARCHAR(255), Password VARCHAR(255))
BEGIN
    SELECT Count(*) as Risultato
    FROM Utente u
    WHERE u.Email = Email
      AND u.Password = Password;
END$

DROP PROCEDURE IF EXISTS GetOrders$
CREATE PROCEDURE GetOrders(mail VARCHAR(255))
BEGIN
    SELECT o.DataOrdine,o.StatoOrdine,SUM(po.Prezzo*po.Quantita) as Totale, o.IdOrdine
    FROM Ordine o

                JOIN CarrelloOrdine co ON o.IdOrdine = co.IdOrdine
                JOIN ProdottoOrdine po ON co.IdCarrelloOrdine = po.IdCarrelloOrdine
                JOIN IndirizzoOrdine i ON o.IdIndirizzo = i.IdIndirizzo
    WHERE o.Email = mail
    GROUP BY o.IdOrdine, o.DataOrdine
    ORDER BY o.DataOrdine desc ;
END$

DROP PROCEDURE IF EXISTS GetOrderDetails$
CREATE PROCEDURE GetOrderDetails(IdOrdine INT unsigned)
BEGIN
    -- Data, Totale, StatoDell'Ordine,Indirizzo
    SELECT o.DataOrdine, SUM(p.Prezzo * p.Quantita) as Totale, o.StatoOrdine, i.*
        FROM Ordine o
    JOIN ecommerce.carrelloordine c ON o.IdOrdine = c.IdOrdine
    JOIN ecommerce.indirizzoordine i ON o.IdIndirizzo = i.IdIndirizzo
    JOIN ecommerce.prodottoordine p ON c.IdCarrelloOrdine = p.IdCarrelloOrdine
    Where o.IdOrdine=IdOrdine
    GROUP BY o.IdOrdine;
end$

DROP PROCEDURE  IF EXISTS GetOrderProducts$
CREATE PROCEDURE GetOrderProducts(IdOrdine INT unsigned)
BEGIN
    SELECT po.Nome, po.Prezzo, po.Quantita
    FROM Ordine o
        JOIN carrelloordine co ON o.IdOrdine = co.IdOrdine
        JOIN prodottoordine po ON co.IdCarrelloOrdine = po.IdCarrelloOrdine

    WHERE o.IdOrdine = IdOrdine;


END$

DROP PROCEDURE IF EXISTS SimilarProducts$
CREATE PROCEDURE SimilarProducts(IdProdotto INT)
BEGIN
    SELECT *
        FROM prodotto
            join ecommerce.appartienegenere a on prodotto.IdProdotto = a.IdProdotto
    join ecommerce.genere g on g.IdGenere = a.IdGenere
    where g.IdGenere in (select g.IdGenere from prodotto p join appartienegenere a on p.IdProdotto = a.IdProdotto join genere g on a.IdGenere = g.IdGenere where p.IdProdotto = IdProdotto)
    ORDER By RAND()
    LIMIT 8;

end $

DROP PROCEDURE  IF EXISTS UpdateGenere$
CREATE PROCEDURE UpdateGenere(NomeGenere VARCHAR(255), IdGenere INT unsigned)
BEGIN
-- set nuovo genere dall'id
    UPDATE 
        Genere g
        SET 
            g.NomeGenere = NomeGenere
        WHERE 
            g.IdGenere = IdGenere;
END$

DROP PROCEDURE IF EXISTS DeleteGenere$
CREATE PROCEDURE DeleteGenere(IdGenere INT unsigned)
BEGIN
    DELETE FROM Genere
    WHERE Genere.IdGenere = IdGenere;
END$

DROP PROCEDURE IF EXISTS DeleteProdotto$
CREATE PROCEDURE DeleteProdotto(IdProdotto INT)
BEGIN
    DELETE FROM Prodotto
    WHERE Prodotto.IdProdotto = IdProdotto;
END$

DROP PROCEDURE IF EXISTS AddProdotto$
CREATE PROCEDURE AddProdotto(Nome VARCHAR(255), Descrizione TEXT,  Quantita INT,  ISBN VARCHAR(100), PrezzoOriginale DECIMAL(10, 2), PrezzoAttuale DECIMAL(10, 2), CasaEditrice VARCHAR(255), TipoProdotto VARCHAR(255), GenereId INT, DataPubblicazione DATE,  Immagine VARCHAR(255))
BEGIN
    INSERT INTO Prodotto(Nome, ISBN, CasaEditrice, PrezzoAttuale, PrezzoOriginale, Quantita, Descrizione, TipoProdotto, Immagine, DataPubblicazione,DataInserimento)
    VALUES (Nome, ISBN, CasaEditrice, PrezzoAttuale, PrezzoOriginale, Quantita,Descrizione, TipoProdotto, Immagine, DataPubblicazione, NOW());
    SET @idP = LAST_INSERT_ID();
    INSERT INTO AppartieneGenere(IdGenere, IdProdotto)
    VALUES (GenereId, @idP);
END$

DROP PROCEDURE IF EXISTS DeleteCasaEditrice$
CREATE PROCEDURE DeleteCasaEditrice(Nome VARCHAR(255))
BEGIN
    DELETE FROM CasaEditrice
    WHERE CasaEditrice.Nome = Nome;
END$
DROP PROCEDURE IF EXISTS AddGenere$
CREATE PROCEDURE AddGenere(NewNomeGenere VARCHAR(255))
BEGIN
    INSERT INTO Genere(NomeGenere)
    VALUES (NewNomeGenere);
END$


DROP PROCEDURE IF EXISTS DeleteUtente$
CREATE PROCEDURE DeleteUtente(Email VARCHAR(255))
BEGIN
    DELETE FROM Utente
    WHERE Utente.Email = Email;
END$

DROP PROCEDURE IF EXISTS CountTotalOrders$
CREATE PROCEDURE CountTotalOrders()
BEGIN
    SELECT COUNT(*) as NumeroOrdini
    FROM Ordine;
END$

DROP PROCEDURE IF EXISTS UpdateCasaEditrice$
CREATE PROCEDURE UpdateCasaEditrice(nome VARCHAR(255), sede VARCHAR(255), Telefono VARCHAR(10))
BEGIN

    UPDATE
        CasaEditrice c
        SET
            c.Nome= nome
        WHERE
            c.NumeroTelefono = Telefono and
            c.Sede = sede;
END$

DROP PROCEDURE IF EXISTS ListaCaseEditrici$
CREATE PROCEDURE ListaCaseEditrici()
BEGIN
    SELECT * FROM CasaEditrice;
END$

DROP PROCEDURE  IF EXISTS GetGenereById$
CREATE PROCEDURE GetGenereById(IdGenere INT unsigned)
BEGIN
    SELECT *
    FROM Genere g
    WHERE g.IdGenere = IdGenere;
END$

DROP PROCEDURE  IF EXISTS GetCasaEditrice$
CREATE PROCEDURE GetCasaEditrice(Nome VARCHAR(255))
BEGIN
    SELECT *
    FROM CasaEditrice c
    WHERE c.Nome = Nome;
END$

DROP PROCEDURE IF EXISTS AddCasaEditrice$
CREATE PROCEDURE AddCasaEditrice(nome VARCHAR(255), sede VARCHAR(255), telefono VARCHAR(10))
BEGIN
    INSERT INTO CasaEditrice(Nome, Sede, NumeroTelefono)
    VALUES (nome, sede, telefono);
END$

DROP PROCEDURE IF EXISTS GetAllOrdini$
CREATE PROCEDURE GetAllOrdini()
BEGIN
    SELECT o.IdOrdine, o.DataOrdine, SUM(p.Prezzo * p.Quantita) as Totale, o.StatoOrdine, i.*, o.Email
    FROM Ordine o
             JOIN ecommerce.carrelloordine c ON o.IdOrdine = c.IdOrdine
             JOIN ecommerce.indirizzoordine i ON o.IdIndirizzo = i.IdIndirizzo
             JOIN ecommerce.prodottoordine p ON c.IdCarrelloOrdine = p.IdCarrelloOrdine
    GROUP BY o.IdOrdine, o.DataOrdine
    ORDER BY o.DataOrdine desc;

END$

DROP PROCEDURE IF EXISTS ListaUtenti$
CREATE PROCEDURE ListaUtenti()
BEGIN
    SELECT * FROM Utente;
END$

DROP PROCEDURE IF EXISTS UpdateOrder$
CREATE PROCEDURE UpdateOrder(IdOrdine INT, StatoOrdineIn VARCHAR(255))
BEGIN
    UPDATE Ordine
    SET StatoOrdine = StatoOrdineIn
    WHERE Ordine.IdOrdine = IdOrdine;
END$


DROP PROCEDURE IF EXISTS GetIdGenereByIdProdotto$
CREATE PROCEDURE GetIdGenereByIdProdotto(IdProdotto INT)
BEGIN
    SELECT g.IdGenere
    FROM Genere g
             JOIN AppartieneGenere ag ON g.IdGenere = ag.IdGenere
    WHERE ag.IdProdotto = IdProdotto;
END$

DROP PROCEDURE  IF EXISTS UpdateProdotto$
CREATE PROCEDURE UpdateProdotto(
    IdProdotto INT,
    Nome VARCHAR(255),
    Descrizione TEXT,
    Quantita INT,
    ISBN VARCHAR(100),
    PrezzoOriginale DECIMAL(10, 2),
    PrezzoAttuale DECIMAL(10, 2),
    CasaEditrice VARCHAR(255),
    TipoProdotto VARCHAR(255),
    GenereId INT,
    DataPubblicazione DATE,
    Immagine VARCHAR(255)
)
BEGIN
    UPDATE Prodotto p
    SET p.Nome = Nome,
        p.Descrizione = Descrizione,
        p.Quantita = Quantita,
        p.ISBN = ISBN,
        p.PrezzoOriginale = PrezzoOriginale,
        p.PrezzoAttuale = PrezzoAttuale,
        p.CasaEditrice = CasaEditrice,
        p.TipoProdotto = TipoProdotto,
        p.DataPubblicazione = DataPubblicazione,
        p.Immagine = Immagine
    WHERE p.IdProdotto = IdProdotto;

    UPDATE AppartieneGenere ag
    SET ag.IdGenere = GenereId
    WHERE ag.IdProdotto = IdProdotto;

END$

DELIMITER ;

