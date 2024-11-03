# Stored Procedure Create
| Nome Query              | Campi                                   | Output                                      | Cosa Fa                                                                                  |
|-------------------------|-----------------------------------------|---------------------------------------------|------------------------------------------------------------------------------------------|
| ListaGeneri             |                                         | `Genere`                                    | Restituisce tutti i generi                                                               |
| ListaProdotti           |                                         | Tutti i campi della tabella `Prodotto`      | Restituisce tutti i prodotti                                                             |
| TopXProdotti            | `numeroprodotti` INT                    | `Nome`, `VendutiTotali`                     | Restituisce i top X prodotti ordinati per i più venduti                                  |
| ListaProdottiPerGenere  | `genere` VARCHAR(255)                   | `Nome`                                      | Restituisce i prodotti appartenenti a un specifico genere                                |
| TopXProdottiPerGenere   | `genere` VARCHAR(255), `numeroprodotti` INT | `Nome`                                  | Restituisce i top X prodotti di un genere ordinati per i più venduti                     |
| UserVerification        | `Mail` VARCHAR(255), `psw` VARCHAR(255) | Tutti i campi della tabella `Utente`        | Verifica l'esistenza di un utente basato su email e password                             |
| TokenVerification       | `Token` VARCHAR(255)                    | Tutti i campi della tabella `Utente`        | Verifica l'esistenza di un utente basato sul token                                        |
| ModifyToken             | `Mail` VARCHAR(255), `NewToken` VARCHAR(255) |                                             | Aggiorna il token di un utente                                                           |
| SignUpUser              | `Email`, `Password`, `NomeUtente` VARCHAR(255) |                                         | Registra un nuovo utente                                                                 |
| AddxToCart              | `IdCarrello`, `IdProdotto` VARCHAR(255), `Quantita` INT |                                 | Aggiunge un prodotto al carrello o ne aggiorna la quantità se già presente               |
| RemoveFromCart          | `IdCarrello`, `IdProdotto` VARCHAR(255) |                                             | Rimuove un prodotto dal carrello                                                         |
| ModifyQuantityCart      | `IdCarrello`, `IdProdotto` VARCHAR(255), `NuovaQuantita` INT |                             | Modifica la quantità di un prodotto nel carrello                                         |
| GetCart                 | `IdCarrello` VARCHAR(255)               | Dettagli del carrello e dei prodotti in esso | Restituisce i dettagli del carrello e dei prodotti contenuti                              |
| CheckToken              | `Email`, `Token` VARCHAR(255)           | Tutti i campi della tabella `Utente`        | Verifica l'esistenza di un utente basato su email e token                                |
| RemoveToken             | `Token` VARCHAR(255)                    |                                             | Rimuove il token di un utente                                                            |
| ChangePassword          | `Email`, `Old_Password`, `New_Password` VARCHAR(255) |                             | Cambia la password di un utente                                                          |
| GetProductsByCategories | `categories_list` VARCHAR(255)         | `IdProdotto`, `Nome`, `NomeGenere`          | Restituisce i prodotti appartenenti a una o più categorie specificate                    |
| SearchItems             | `request` VARCHAR(255)                  | Tutti i campi della tabella `Prodotto`      | Cerca i prodotti basandosi su una stringa di ricerca                                     |
| UserWishlist            | `Email` VARCHAR(255)                    | Tutti i campi della tabella `Prodotto`      | Restituisce la lista dei desideri di un utente                                           |
| GetProductById          | `IdProdotto` INT                        | Tutti i campi della tabella `Prodotto`      | Restituisce i dettagli di un prodotto basato sull'ID                                     |

# Lista di cose da fare
## Index
- [ ] Implementare la search
- [ ] Impostare i routhing per i 3 blocchi della sezione 1 (Magazine, Manga e Light Novel)
- [ ] Implementare la query per nuovi arrivi
- [ ] Implementare la query per i prodotti più venduti
- [ ] Implementare la query per la ricerca per categorie con pagina annessa
## Categorie
- [ ] Implementare la pagina delle categorie e i vari routing in maniera dinamica
- [x] Implementare la query per i prodotti per categoria
- [x] Modularizzare quadrati
- [ ] Routing dei singoli quadrati con la search

