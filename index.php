<?php
session_start();

// Controllo se l'utente è loggato altrimento lo reindirizzo a login.php
if(array_key_exists("logged_user", $_SESSION) === false || empty($_SESSION['logged_user']))
    header("Location: login.php");

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- BOOTSTRAP -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">

    <title>Dietina</title>
</head>
<body>
    
    <div class="container">
        <p> 
            <button id="btn_logout" class=" btn_actions btn-lg" onclick="location.href='logout.php';">LOGOUT</button>
        </p>

        <h1 class="my-5 h1">
            Ciao, <?=$_SESSION['logged_user']?> 
        </h1>

        <h3>Scegli il pasto della giornata</h3>
        <hr>

        <form action="pasto_giornata.php" method="post">

            <input type="hidden" name="tipo_pasto" value="1">
            
            <button class="btn_pasto">
                <p>
                    COLAZIONE
                </p>
            </button>

        </form>


        <form action="pasto_giornata.php" method="post">

            <input type="hidden" name="tipo_pasto" value="2">

            <button class="btn_pasto">
                <p>
                    SPUNTINO
                </p>
            </button>

        </form>



        <form action="pasto_giornata.php" method="post">

            <input type="hidden" name="tipo_pasto" value="3">

            <button class="btn_pasto">
                <p>
                    PRANZO
                </p>
            </button>

        </form>


        <form action="pasto_giornata.php" method="post">

            <input type="hidden" name="tipo_pasto" value="2"> <!-- codice uguale a spuntino per ora -->

            <button class="btn_pasto">
                <p>
                    MERENDA
                </p>
            </button>

        </form>


        <form action="pasto_giornata.php" method="post">

            <input type="hidden" name="tipo_pasto" value="5">

            <button class="btn_pasto">
                <p>
                    CENA
                </p>
            </button>

        </form>

    </div>

</body>
</html>
