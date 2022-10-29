<?php
require "DatoAlimento.php";
require "DAL.php";
session_start();

// DEBUG:    echo "<pre>";var_dump($_POST);var_dump($_SESSION);


// Controllo se l'utente è loggato altrimento lo reindirizzo a login.php
if(array_key_exists("logged_user", $_SESSION) === false || empty($_SESSION['logged_user']))
    header("Location: login.php");


// if(array_key_exists("alim_data", $_SESSION) === false || empty($_SESSION['alim_data']))
    $_SESSION['alim_data'] = GetAllFoodDataByUserid((int)$_SESSION['userid'], (int)$_POST['tipo_pasto']);

$listaAlimenti = GetFoodCatDescrList();

// DEBUG: echo "<pre>";    var_dump($_SESSION['alim_data']);die();
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

    <title>Dietina - Pasto</title>
</head>
<body>

    <div class="container">
        <p> 
            <button id="btn_logout" class=" btn_actions btn-lg" onclick="location.href='logout.php';">LOGOUT</button>
            <button id="btn_back" class=" btn_actions btn-lg" onclick="location.href='index.php';">INDIETRO</button>
        </p>

        <h1 class="mt-5 mb-4">Cerca alimento:</h1>

        <input type="text" id="input_alim" class="input_large form-control my-2 h-25" onkeyup="search()" placeholder="Cerca alimento..." title="Scrivi alimento">
    
        <div style="margin:auto;" class="h5">

            <table class="table .table-striped">
                <thead>
                    <tr>
                        <th class="col-6">Alimento</th>
                        <th class="col-3">Cat.</th>
                        <th class="col-3">Qtà (gr.)</th>
                    </tr>
                </thead>
                
            </table>

            <div style=" overflow-y:scroll;height:180px;">
                <table class="table table-striped bg-light ">

                    <tbody id="tbodyAlim" class="bg-light">

                    <?php
                        $id = 0;

                        foreach($_SESSION["alim_data"] as $el) {
                            $id++;
                            $gramKey = $_SESSION['userid'] == 1 ? "grammi_fab" : "grammi_ste";
                            $catAlimId = ((int)$el["cat_alim"]) -1;

                            $descr = $el["descrizione"];
                            $cat = $listaAlimenti[$catAlimId];
                            $gr = $el[$gramKey];
                            
                            ?>
                                <tr id="tr<?=$id?>" class="w-100" data-bs-toggle="modal" data-bs-target="#modalDettAlim" data-bs-descr="<?=$descr?>" data-bs-cat="<?=$cat?>" data-bs-gr="<?=$gr?>">
                                    <td class="d-inline-block col-6 text-truncate td_descr"><?=$descr ?></td>
                                    <td class="d-inline-block col-3"><?=$cat?></td>
                                    <td class="d-inline-block col-3"><?=$gr ?></td>
                                </tr>
                         
                            <?php
                        }
                    ?>
                        
                 
                    </tbody>

                </table>

            </div>
                
        </div>


          <!-- Modal -->
          <div class="modal fade" id="modalDettAlim" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modalDettAlimTitle">qui va la descr</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>
                            Categoria: <span id="modalDettAlimCat"></span>
                        </h5>
                        <h5>
                            Grammi: <span id="modalDettAlimGr"></span>
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> 
        <!-- fine modal -->


    </div>


    <script type="text/javascript">
        // Aggiunto evento per modal by tr click
        var modal = document.getElementById('modalDettAlim');
        //  var tra = document.getElementById('tr<?=$id?>');
        // console.log(tra.id);

        modal.addEventListener('show.bs.modal', function (event) {
            //Button that triggered the modal
            var tr = event.relatedTarget

            //Extract info from data-bs-* attributes
            var descr = tr.getAttribute('data-bs-descr');
            var cat = tr.getAttribute('data-bs-cat');
            var gr = tr.getAttribute('data-bs-gr');
            
            // Update the modal's content.
            var modalTitle = modal.querySelector('.modal-title');
            var modalCat = document.getElementById("modalDettAlimCat");
            var modalGr = document.getElementById("modalDettAlimGr");

            modalTitle.textContent = descr;
            modalCat.textContent = cat;
            modalGr.textContent = gr;
        });


        function search() {
            var input, filter, tbody, tr, td, txtValue;
            // var input, filter, ul,    li, a,  txtValue;

            input = document.getElementById("input_alim");
            filter = input.value.toUpperCase();
            tbody = document.getElementById("tbodyAlim");
            tr = tbody.getElementsByTagName("tr");

            for (let i = 0; i < tr.length; i++) {
                
                td = tr[i].getElementsByClassName("td_descr")[0];
                txtValue = td.textContent || td.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
      
    </script>

</body>
</html>