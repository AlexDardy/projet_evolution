<?php
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["role"])){
		header("Location: login.php");
		exit(); 
	}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <title>Application WEB</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
       <?php
       include 'theme.php'
       ?>
    </head>

    <body>
        
        <?php
        include 'navigation.php';
        ?>


        <?php
            if(isset($_SESSION["role"])){
                if ($_SESSION["role"] == 'Administrateur') {
                    echo '
                    <div class="container">
                    <div class="row">
                        <div class="col-lg">
                        
                            <h1>Outil de gestion de ressources informatiques</h1>
                        
                            <p>
                                <strong>
                                    Cet outil permet de gérer les utilisateurs, le matériel et les services chez ALGATOOLS.<br>
                                    Il permet l\'ajout, la modification et la suppression ainsi que d\'exécuter des requêtes.
                                </strong>
                            </p>
        
        
                            <h1>Menu :</h1>
                            <div class="d-flex justify-content-center">
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item text-center menu-item">
                                        <a class="menu-link" href="Liste_Utilisateurs.php">
                                        <img class="w-75" src="../assets/img/users.svg" alt="Utilisateurs" >
                                        <br>
                                        Utilisateurs
                                        </a>        
                                    </li>
                                    <li class="list-group-item text-center menu-item">
                                        <a class="menu-link" href="Gestion_Materiel.php">
                                        <img class="w-75" src="../assets/img/materiel.svg" alt="Matériel">
                                        <br>
                                        Matériel
                                        </a>
                                    </li>
                                    <li class="list-group-item text-center menu-item">
                                        <a class="menu-link" href="Liste_Services.php">
                                        <img class="w-75" src="../assets/img/services.svg" alt="Services">
                                        <br>
                                        Services
                                        </a>
                                    </li>
                                </ul>
                            </div>
        
                        </div>
                    </div>
                </div>
                ';
                } else {
                    echo '
                    <div class="container">
                        <div class="row">
                        <div class="col-lg">
                            <h1>
                                Bienvenue sur AlgaTools
                            </h1>    
                        </div>
                    </div>
                    ';
                }

            }
        ?>


    </body>

</html>