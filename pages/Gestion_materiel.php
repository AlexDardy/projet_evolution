<?php
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(isset($_SESSION["role"])) {
        if($_SESSION["role"] != "Administrateur") {
            header("Location: index.php");
		    exit();
        }
	} else {
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


        <div class="container">

            <div class="row">
                <div class="col-lg">
                
                    <h1>Gestion du materiel</h1>
                

                    <ol>
                        <li>
                            <a href="Liste_Ordinateurs.php">Afficher les Ordinateurs</a>
                        </li>
                        <li>
                            <a href="Liste_Ecrans.php">Afficher les Ecrans</a>
                        </li>
                        <li>
                            <a href="Liste_Imprimantes.php">Afficher les Imprimantes</a>
                        </li>
                        <li>
                            <a href="Liste_Telephones.php">Afficher les Telephones</a>
                        </li>
                        <li>
                            <a href="Liste_Stock.php">Afficher le stock</a>
                        </li>
                    </ol>

                </div>
            </div>

            <div class="row">
                <div class="col-lg">


                </div>
            </div>

        </div>


    </body>

</html>