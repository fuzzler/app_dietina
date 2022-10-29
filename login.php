<?php
session_start();

// Controllo se l'utenza è loggata (per evitare inutilmente che qualcuno entri nella pagina di login)
if(array_key_exists("logged_user", $_SESSION))
    if(empty($_SESSION['logged_user']) === false)
        header("Location: index.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <!-- BOOTSTRAP -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="style.css">
    
    <title>Login</title>

</head>
<body>

    <h1>Esegui il login</h1>

    <form action="verifica_login.php" method="post">

        <input class="input_large my-3" type="text" name="username" id="username" placeholder="Inserisci stefa"> <br>
        <input class="input_large my-3" type="password" name="password" id="password" placeholder="non server la pw"> <br><br>
        <input class="btn_actions btn-lg" type="submit" value="LOGIN">
        <p class="err_msg">
            <?php
                if(array_key_exists('err_login', $_SESSION))
                    echo $_SESSION['err_login'];
            ?>
        </p>

    </form>
</body>
</html>