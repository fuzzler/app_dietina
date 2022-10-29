<?php
require_once "DAL.php";

session_start();

$username = strtolower($_POST["username"]);
$password = $_POST["password"];

$userData = GetUserDataByUsername($username);


// DEBUG: echo "<pre>";    var_dump($userData);die();

// Verifico che siano stati trovati dei risultati per l'utente indicato
if(empty($userData)) {
    $_SESSION['err_login'] = "Utente non trovato. Effettuare la registrazione.";
    // var_dump($_SESSION); die;
    header("Location: login.php");
}

$_SESSION['err_login'] = ""; // svuoto il mess di errore 

if($username === $userData['username'] && $password === $userData['password']) {
    // LOGIN RIUSCITO
    $_SESSION['logged_user'] = $username;
    $_SESSION['userid'] = $userData["id"];
    header("Location: index.php");
}
else {
    // LOGIN FALLITO
    $_SESSION['err_login'] = "Utente o password errati. Riprovare.";
    header("Location: login.php");
}

