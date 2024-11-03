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
('JuJutsuKaisen', 'Serie Section by Gege Akutami'),
('One Piece', 'Serie Section by Eiichiro Oda'),
('EIGHTY SIX 86', 'Serie Section by Asato Asato');

-- Populate Genere
INSERT INTO Genere (NomeGenere, ImmagineGenere) VALUES
('Fantasy', 'Fantasy_imm.jpg'),
('Science-Fiction', 'sci_fiction_imm.jpg'),
('Mystery', 'mystery_imm.jpeg'),
('Thriller', 'thriller_imm.jpg'),
('Romance', 'romance_imm.jpeg'),
('Horror', 'horror_imm.jpg'),
('Historical','historical_imm.jpg'),
('Young-Adult', 'young_adult_imm.jpeg'),
('Non-fiction', 'non_ficiton_sport_imm.jpg'),
('Biography', 'biography_imm.jpg');



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
('9788868890761', 1, 'Panini', 'JuJutsuKaisen Romanzo', 'Il romanzo ispirato al prequel dell’opera', 8.94, 10.20, 99, 'Manga', 'Jjk_Rm.jpg', '2022-08-15', CURDATE(), 34),
('9219321932939',2, 'StarComics', 'One Piece 1', 'Il primo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_1.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 2', 'Il secondo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_2.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 3', 'Il terzo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_3.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 4', 'Il quarto volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_4.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 5', 'Il quinto volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_5.jpg', '2021-06-04', CURDATE(), 55),
('9219321932939',2, 'StarComics', 'One Piece 6', 'Il sesto volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_6.jpg', '2021-06-04', CURDATE(), 319),
('9219321932939',2, 'StarComics', 'One Piece 7', 'Il settimo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_7.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 8', 'L’ottavo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_8.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 9', 'Il nono volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_9.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 10', 'Il decimo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_10.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 11', 'L’undicesimo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_11.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 12', 'Il dodicesimo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_12.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 13', 'Il tredicesimo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_13.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 14', 'Il quattordicesimo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_14.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 15', 'Il quindicesimo volume della saga di One Piece', 4.94, 5.20,100, 'Manga', 'OnePiece_15.jpg', '2021-06-04', CURDATE(), 39),
('9219321932939',2, 'StarComics', 'One Piece 16', 'Il sedicesimo volume della saga di One Piece', 4.94, 5.20, 100, 'Manga', 'OnePiece_16.jpg', '2021-06-04', CURDATE(), 3911),
('3290310913291',3, 'jpop', 'EIGHTY SIX 86 Nr. 1', 'Il primo volume della saga di Eighty Six', 4.94, 5.20, 100, 'Light Novel', '86_1.jpg', '2021-06-04', CURDATE(), 39),
('3290310913291',3, 'jpop', 'EIGHTY SIX 86 Nr. 2', 'Il secondo volume della saga di Eighty Six', 4.94, 5.20, 100, 'Light Novel', '86_2.jpg', '2021-06-04', CURDATE(), 3459);


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
(1,28),
(2, 29),
(2,30),
(2,31),
(2,32),
(2,33),
(2,34),
(2,35),
(2,36),
(2,37),
(2,38),
(2,39),
(2,40),
(2,41),
(2,42),
(2,43),
(2,44),
(3,45),
(3,46);


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
-- Populate carrelloordine

INSERT INTO carrelloordine (IdCarrelloOrdine) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);



-- Populate prodottoordine

-- INSERT INTO prodottoordine (Nome, IdProdottoOrdine, Prezzo, Quantita, Descrizione, IdCarrelloOrdine) VALUES
-- ('JuJutsuKaisen 0', 1, 4.94, 2, 'Il prequel che getta luce sugli eventi della serie. Un volume imperdibile per i fan.', 1),
-- ('JuJutsuKaisen 1', 2, 4.94, 1, 'L’inizio della saga con Itadori Yuji, che scopre il mondo dell’occulto.', 2),
-- ('JuJutsuKaisen 2', 3, 4.94, 3, 'Scontri e rivelazioni continuano mentre Yuji affronta nuove sfide.', 3),
-- ('JuJutsuKaisen 3', 4, 4.94, 1, 'Un combattimento che segna profondamente i protagonisti.', 4),
-- ('JuJutsuKaisen 4', 5, 4.94, 2, 'Nuovi alleati e nemici emergono, ampliando il mondo dell’occulto.', 5),
-- ('JuJutsuKaisen 5', 6, 4.94, 1, 'La tensione sale mentre le battaglie diventano più intense.', 6),
-- ('JuJutsuKaisen 6', 7, 4.94, 4, 'Strategie e segreti vengono rivelati nel cuore della lotta.', 7),
-- ('JuJutsuKaisen 7', 8, 4.94, 1, 'Un viaggio nel passato svela il vero potere della stregoneria.', 8),
-- ('JuJutsuKaisen 8', 9, 4.94, 2, 'Itadori affronta nuove minacce che mettono alla prova la sua determinazione.', 9),
-- ('JuJutsuKaisen 9', 10, 4.94, 1, 'Le battaglie raggiungono un nuovo livello di ferocia e strategia.', 10),
-- ('JuJutsuKaisen 10', 11, 4.94, 2, 'Il destino dei protagonisti prende una piega inaspettata.', 1),
-- ('JuJutsuKaisen 11', 12, 4.94, 1, 'Nuove alleanze e tradimenti mettono alla prova i legami.', 2),
-- ('JuJutsuKaisen 12', 13, 4.94, 4, 'Le rivelazioni continuano a sorprendere i protagonisti.', 3),
-- ('JuJutsuKaisen 13', 14, 4.94, 1, 'La tensione aumenta mentre si avvicina uno scontro epocale.', 1);



-- Populate Banner
INSERT INTO Banner (NumeroBanner, NomeBanner, Riga_1, Riga_2, Bottone, Testo_Bottone, Link, Visibile) VALUES
(1, "ultime uscite",   "Scopri le ultime uscite delle tue serie preferite",   "",  1,  "Scopri",  "http://php.localhost/public/products?category=&amp;search=&amp;casaEditrice=&amp;orderBy=DataPubblicazione",  1),
(2, "spedizioni gratuite", "Spedizioni gratuite per tutto Agosto", "Goditi le tue serie preferite sotto l'ombrellone", 0, "", "", 1 ),
(3, "generi preferiti", "Trova i tuoi generi preferiti", "Nel migliore shop del Centro Italia", 1, "Scopri ora", "http://php.localhost/public/category", 1);