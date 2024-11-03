delimiter $
USE ecommerce$
DROP PROCEDURE IF EXISTS ListaGeneri$

CREATE PROCEDURE ListaGeneri()
BEGIN
    SELECT NomeGenere AS Categoria, IdGenere, ImmagineGenere FROM Genere;
END$


DROP PROCEDURE IF EXISTS ListaProdotti$
CREATE PROCEDURE ListaProdotti()
BEGIN
    SELECT p.Nome,
           p.VendutiTotali,
           g.NomeGenere as Categoria,
           p.PrezzoAttuale,
           p.PrezzoOriginale,
           p.Descrizione,
           p.ISBN,
           p.CasaEditrice,
           p.DataPubblicazione,
           p.VendutiTotali,
           p.Quantita,
           p.IdProdotto,
           p.immagine   as Immagine
    FROM Prodotto p
             LEFT JOIN ecommerce.appartienegenere a on p.IdProdotto = a.IdProdotto
             LEFT OUTER JOIN ecommerce.genere g on a.IdGenere = g.IdGenere;

END$


DROP PROCEDURE IF EXISTS TopXProdotti$
CREATE PROCEDURE TopXProdotti(Limited INT)
BEGIN
    SELECT Nome,
           VendutiTotali,
           g.NomeGenere           as NomeGenere,
           PrezzoAttuale,
           PrezzoOriginale,
           Descrizione,
           ISBN,
           CasaEditrice,
           DataPubblicazione,
           Prodotto.VendutiTotali as Quantita,
           Prodotto.IdProdotto,
           Prodotto.immagine      as Immagine
    FROM Prodotto
           Left Outer  JOIN ecommerce.appartienegenere a on Prodotto.IdProdotto = a.IdProdotto
           Left Outer  JOIN ecommerce.genere g on a.IdGenere = g.IdGenere

    ORDER By VendutiTotali DESC
    LIMIT Limited;
END$

DROP PROCEDURE IF EXISTS TopXCaseEditrici$
CREATE PROCEDURE TopXCaseEditrici(Limited INT)
BEGIN
    create temporary table temp as

    Select prodotto.Nome, prodotto.CasaEditrice, prodotto.VendutiTotali
    from prodotto
    where DataPubblicazione < DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
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
    SELECT p.PrezzoOriginale,p.PrezzoAttuale,p.Quantita,p.Nome,p.Descrizione,p.ISBN,p.CasaEditrice,p.DataPubblicazione,p.VendutiTotali,p.IdProdotto,p.Immagine,g.NomeGenere as Categoria
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
    Where pc.IdCarrello = IdCarrello
      and pc.IdProdotto = IdProdotto;
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
BEGIN
    SELECT *
    FROM Utente
             JOIN ecommerce.hagruppi h on Utente.Email = h.Email
    where h.IdGruppo = 1;
END$


DROP PROCEDURE IF EXISTS SearchItems$
CREATE PROCEDURE SearchItems(request varchar(255))
BEGIN
    Select p.IdProdotto,p.Nome,p.Descrizione,p.PrezzoAttuale,p.PrezzoOriginale,p.Quantita,g.NomeGenere as Categoria,p.Immagine

    From Prodotto p
    left outer join ecommerce.appartienegenere a on p.IdProdotto = a.IdProdotto
    left outer join ecommerce.genere g on a.IdGenere = g.IdGenere
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

DROP PROCEDURE IF EXISTS UserWishlistRemove$
CREATE PROCEDURE UserWishlistRemove(Email VARCHAR(255), IdProdotto INT)
BEGIN
    DELETE
    FROM Preferiti
    WHERE preferiti.Email = Email
      AND preferiti.IdProdotto = IdProdotto;
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
    DELETE
    FROM Preferiti
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


    IF Search = '' THEN
        SET Search = NULL;
    END IF;

    IF Categoria = '' THEN
        SET Categoria = NULL;
    END IF;

    IF CasaEditrice = '' THEN
        SET CasaEditrice = NULL;
    END IF;

    IF OrderBy = '' THEN
        SET OrderBy = NULL;
    END IF;


    -- Base query
    SET baseQuery =
            'SELECT p.IdProdotto, p.ISBN,p.IdSerie,p.CasaEditrice,p.Nome,p.Descrizione,p.PrezzoAttuale,p.PrezzoOriginale,p.Quantita,p.TipoProdotto,p.Immagine,p.DataPubblicazione,p.DataInserimento,p.Vendutitotali, g.NomeGenere As Categoria FROM Prodotto p LEFT JOIN ecommerce.appartienegenere a ON p.IdProdotto = a.IdProdotto LEFT JOIN ecommerce.genere g ON a.IdGenere = g.IdGenere';

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
        WHEN OrderBy = 'Nome' THEN SET orderByClause = CONCAT(orderByClause, 'p.Nome');
        WHEN OrderBy = 'CasaEditrice' THEN SET orderByClause = CONCAT(orderByClause, 'p.CasaEditrice');
        WHEN OrderBy = 'DataPubblicazione' THEN SET orderByClause = CONCAT(orderByClause, 'p.DataPubblicazione ASC');
        WHEN OrderBy = 'PrezzoCrescente' THEN SET orderByClause =
                CONCAT(orderByClause, 'CASE WHEN p.PrezzoAttuale = 0 THEN p.PrezzoOriginale ELSE p.PrezzoAttuale END');
        WHEN OrderBy = 'PrezzoDecrescente' THEN SET orderByClause = CONCAT(orderByClause,
                                                                           'CASE WHEN p.PrezzoAttuale = 0 THEN p.PrezzoOriginale ELSE p.PrezzoAttuale END DESC');
        ELSE SET orderByClause = CONCAT(orderByClause, 'p.IdProdotto');
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
    DELETE
    FROM ProdottiNelCarrello
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
CREATE PROCEDURE CreateOrder(Nome VARCHAR(255), Cognome VARCHAR(255), mail VARCHAR(255), Telefono VARCHAR(255),
                             Via VARCHAR(255), NumeroCivico VARCHAR(20), Citta VARCHAR(255), Provincia VARCHAR(255),
                             CAP VARCHAR(255), IdCarrello Int unsigned)

BEGIN
    SET @TIMESTAMP = NOW();


    INSERT INTO IndirizzoOrdine(Nome, Cognome, Citta, CAP, Via, NumeroCivico, Provincia, NumeroTelefono)
    VALUES (Nome, Cognome, Citta, CAP, Via, NumeroCivico, Provincia, Telefono);

    SET @IndirizzoTarget = LAST_INSERT_ID();

    INSERT INTO Ordine(Email, DataOrdine, StatoOrdine, IdIndirizzo)
        Value (mail, @TIMESTAMP, DEFAULT, @IndirizzoTarget);
    SET @IdOrdineTarget = LAST_INSERT_ID();

    INSERT INTO CarrelloOrdine(IdOrdine)
        Value (@IdOrdineTarget);

    SET @IdCarrelloTarget = LAST_INSERT_ID();

    INSERT INTO ProdottoOrdine(ISBN, CasaEditrice, Nome, Descrizione, Prezzo, Quantita, IdCarrelloOrdine)
    SELECT p.ISBN, p.CasaEditrice, p.Nome, p.Descrizione, p.PrezzoOriginale, pc.Quantita, @IdCarrelloTarget
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
    SELECT o.DataOrdine, o.StatoOrdine, SUM(po.Prezzo * po.Quantita) as Totale, o.IdOrdine
    FROM Ordine o

             JOIN CarrelloOrdine co ON o.IdOrdine = co.IdOrdine
             JOIN ProdottoOrdine po ON co.IdCarrelloOrdine = po.IdCarrelloOrdine
             JOIN IndirizzoOrdine i ON o.IdIndirizzo = i.IdIndirizzo
    WHERE o.Email = mail
    GROUP BY o.IdOrdine, o.DataOrdine
    ORDER BY o.DataOrdine desc;
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
    Where o.IdOrdine = IdOrdine
    GROUP BY o.IdOrdine;
end$

DROP PROCEDURE IF EXISTS GetOrderProducts$
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
    where g.IdGenere in (select g.IdGenere
                         from prodotto p
                                  join appartienegenere a on p.IdProdotto = a.IdProdotto
                                  join genere g on a.IdGenere = g.IdGenere
                         where p.IdProdotto = IdProdotto)
    ORDER By RAND()
    LIMIT 8;

end $

DROP PROCEDURE IF EXISTS UpdateGenere$
CREATE PROCEDURE UpdateGenere(NomeGenere VARCHAR(255), ImmagineGenere VARCHAR(255), IdGenere INT unsigned)
BEGIN
    -- set nuovo genere dall'id
    UPDATE
        Genere g
    SET g.NomeGenere     = NomeGenere,
        g.ImmagineGenere = ImmagineGenere
    WHERE g.IdGenere = IdGenere;
END$

DROP PROCEDURE IF EXISTS DeleteGenere$
CREATE PROCEDURE DeleteGenere(IdGenere INT unsigned)
BEGIN
    DELETE
    FROM Genere
    WHERE Genere.IdGenere = IdGenere;
END$

DROP PROCEDURE IF EXISTS DeleteProdotto$
CREATE PROCEDURE DeleteProdotto(IdProdotto INT)
BEGIN
    DELETE
    FROM Prodotto
    WHERE Prodotto.IdProdotto = IdProdotto;
END$

DROP PROCEDURE IF EXISTS AddProdotto$
CREATE PROCEDURE AddProdotto(Nome VARCHAR(255), Descrizione TEXT, Quantita INT, ISBN VARCHAR(100),
                             PrezzoOriginale DECIMAL(10, 2), PrezzoAttuale DECIMAL(10, 2), CasaEditrice VARCHAR(255),
                             TipoProdotto VARCHAR(255), GenereId INT, DataPubblicazione DATE, Immagine VARCHAR(255))
BEGIN
    INSERT INTO Prodotto(Nome, ISBN, CasaEditrice, PrezzoAttuale, PrezzoOriginale, Quantita, Descrizione, TipoProdotto,
                         Immagine, DataPubblicazione, DataInserimento)
    VALUES (Nome, ISBN, CasaEditrice, PrezzoAttuale, PrezzoOriginale, Quantita, Descrizione, TipoProdotto, Immagine,
            DataPubblicazione, NOW());
    SET @idP = LAST_INSERT_ID();
    INSERT INTO AppartieneGenere(IdGenere, IdProdotto)
    VALUES (GenereId, @idP);
END$

DROP PROCEDURE IF EXISTS DeleteCasaEditrice$
CREATE PROCEDURE DeleteCasaEditrice(Nome VARCHAR(255))
BEGIN
    DELETE
    FROM CasaEditrice
    WHERE CasaEditrice.Nome = Nome;
END$
DROP PROCEDURE IF EXISTS AddGenere$
CREATE PROCEDURE AddGenere(NewNomeGenere VARCHAR(255), immagine VARCHAR(255))
BEGIN
    INSERT INTO Genere(NomeGenere, ImmagineGenere)
    VALUES (NewNomeGenere, immagine);
END$


DROP PROCEDURE IF EXISTS DeleteUtente$
CREATE PROCEDURE DeleteUtente(Email VARCHAR(255))
BEGIN
    DELETE
    FROM Utente
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
    SET c.Nome= nome
    WHERE c.NumeroTelefono = Telefono
      and c.Sede = sede;
END$

DROP PROCEDURE IF EXISTS ListaCaseEditrici$
CREATE PROCEDURE ListaCaseEditrici()
BEGIN
    SELECT * FROM CasaEditrice;
END$

DROP PROCEDURE IF EXISTS GetGenereById$
CREATE PROCEDURE GetGenereById(IdGenere INT unsigned)
BEGIN
    SELECT *
    FROM Genere g
    WHERE g.IdGenere = IdGenere;
END$

DROP PROCEDURE IF EXISTS GetCasaEditrice$
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

DROP PROCEDURE IF EXISTS UpdateProdotto$
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
    SET p.Nome              = Nome,
        p.Descrizione       = Descrizione,
        p.Quantita          = Quantita,
        p.ISBN              = ISBN,
        p.PrezzoOriginale   = PrezzoOriginale,
        p.PrezzoAttuale     = PrezzoAttuale,
        p.CasaEditrice      = CasaEditrice,
        p.TipoProdotto      = TipoProdotto,
        p.DataPubblicazione = DataPubblicazione,
        p.Immagine          = Immagine
    WHERE p.IdProdotto = IdProdotto;

    UPDATE AppartieneGenere ag
    SET ag.IdGenere = GenereId
    WHERE ag.IdProdotto = IdProdotto;

END$

DROP PROCEDURE IF EXISTS TotalMoneySpent$
CREATE PROCEDURE TotalMoneySpent()
BEGIN
    SELECT sum(quantita * prezzo) as totale
    from prodottoordine;
END$

DROP PROCEDURE IF EXISTS ListaBanners$
CREATE PROCEDURE ListaBanners()
BEGIN
    SELECT * FROM Banner;
END$

DROP PROCEDURE IF EXISTS GetBannerById$
CREATE PROCEDURE GetBannerById(IdBanner INT unsigned)
BEGIN
    SELECT *
    FROM Banner b
    WHERE b.IdBanner = IdBanner;
END$

DROP PROCEDURE IF EXISTS UpdateBanner$
CREATE PROCEDURE UpdateBanner(
    idBanner INT unsigned,
    NomeBanner VARCHAR(255),
    Riga_1 VARCHAR(255),
    Riga_2 VARCHAR(255),
    Bottone bool,
    Testo_Bottone VARCHAR(255),
    Link VARCHAR(255),
    Visibile bool
)

BEGIN
    UPDATE Banner b
    SET b.NomeBanner    = NomeBanner,
        b.Riga_1        = Riga_1,
        b.Riga_2        = Riga_2,
        b.Bottone       = Bottone,
        b.Testo_Bottone = Testo_Bottone,
        b.Link          = Link,
        b.Visibile      = Visibile
    WHERE b.IdBanner = idBanner;
END$


DROP PROCEDURE IF EXISTS AddBanner$
CREATE PROCEDURE AddBanner(NomeBanner VARCHAR(255), Riga_1 VARCHAR(255), Riga_2 VARCHAR(255), Bottone VARCHAR(255),
                           Testo_Bottone VARCHAR(255), Link VARCHAR(255), Visibile BOOLEAN, NumeroBanner INT)
BEGIN
    INSERT INTO Banner(NomeBanner, Riga_1, Riga_2, Bottone, Testo_Bottone, Link, Visibile, NumeroBanner)
    VALUES (NomeBanner, Riga_1, Riga_2, Bottone, Testo_Bottone, Link, Visibile, NumeroBanner);
END$

DROP PROCEDURE IF EXISTS getNumeroBannerArray$
CREATE PROCEDURE getNumeroBannerArray()
BEGIN
    SELECT NumeroBanner
    FROM Banner;
END$

DROP PROCEDURE IF EXISTS DeleteBanner$
CREATE PROCEDURE DeleteBanner(idBanner INT unsigned)
BEGIN
    DELETE
    FROM Banner
    WHERE Banner.IdBanner = idBanner;
END$

DELIMITER ;

