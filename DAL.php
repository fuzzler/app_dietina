<?php

/**
 * Inizializza l'oggetto PDO usato per la connessione al DB (ogni volta che serve)
 */
function Initialize_PDO() : PDO
{

    $host = 'localhost';
    $dbname = 'app_dietina';
    $dbUsr = 'root';
    $dbPwd = 'fazia4Mysql';

    $pdo = null;
    try {
        $pdo = new PDO('mysql:host='.$host.'; dbname='.$dbname, $dbUsr, $dbPwd);
    }
    catch (PDOException $pdoe) {
    
        die(sprintf("<h1>CONNESSIONE AL DB FALLITA!</h1>Messaggio di errore: %s", $pdoe->getMessage() ));
    }

    return $pdo;
}

/**
 * Restituisci i dati dell'utente in base al nome (per verifica pw)
 */
function GetUserDataByUsername(string $username) : array
{
    $pdo = Initialize_PDO();

    $query = "SELECT * from utenti where username='".$username."'";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result === false)
        $result = [];

    $pdo = null;

    return $result;
}

/**
 * Restituisce tutti i dati sugli alimenti (con le prop in gr) in base all'ID utente passato
 */
function GetAllFoodDataByUserid(int $userid, int $tipoPasto) : array
{
    $pdo = Initialize_PDO();

    $grammi = $userid == 1 ? "grammi_fab" : "grammi_ste";
    $query = "SELECT cat_alim, descrizione, $grammi FROM provv_tab_alimenti_fs WHERE tipo_pasto = $tipoPasto ORDER BY descrizione";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($result === false)
        $result = [];

    $pdo = null;

    return $result;
}

/**
 * Preleva la lista in piano delle descrizioni sulle macro categorie dei cibi
 */
function GetFoodCatDescrList():array {
    $list = [];
    $pdo = Initialize_PDO();

    $query = "SELECT descrizione FROM macro_categorie_alimenti";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    if($result === false)
        $result = [];

    $pdo = null;

    foreach($result as $r) {
        $list[] = $r['descrizione'];
    }
    
    return $list;
}


function GetFoodDescrByCatId(int $cat) : string {
    $descr = "";

    switch ($cat) {
        case 1:
            $descr = "Zuccheri";
            break;

        case 2:
            $descr = "Cereali";
            break;

        case 3:
            $descr = "Frutta";
            break;

        case 4:
            $descr = "Verdure";
            break;

        case 5:
            $descr = "Proteine";
            break;

        case 6:
            $descr = "Grassi";
            break;
        
        default:
            # code...
            break;
    }

    return $descr;
}

