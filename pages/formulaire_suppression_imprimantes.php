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
        <!-- 
            Connexion à la base de données
         -->
         <?php 
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=evolution;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch(Exception $e)
            {
                    die('Erreur : '.$e->getMessage());
            }
        ?>

        <div class="container">

            <div class="row">
                <div class="col-lg">
                <h1>Formulaire de suppression d'imprimantes</h1>

                    <form action="../actions/suppression_imprimantes.php" method="post">

                        <!-- Input liste déroulante -->
                        <div class="form-group">
                            <label for="id_imprimantes">Choix de le telephone à supprimer</label>
                            <select id="id_imprimantes" class="form-control" name="id_imprimantes">
                                <option value='' selected>Choisir...</option>
                                
                                <!-- 
                                    Ci-dessous on va utiliser PHP pour remplir la liste déroulante avec les enregistrements de la base de données.
                                    Chaque <option></option> correspondra à une ligne de la table.
                                 -->
                                <?php 

                                    // Récupérer des données : on prépare la requête et on la met dans la variable $requete...
                                    $requete = $bdd->prepare('SELECT * FROM imprimantes');
                                    // ...puis on l'exécute
                                    $requete->execute();

                                    while( $donnees = $requete->fetch() )
                                    {
                                ?>

                                    <!-- 
                                        La valeur de l'option correspond à l'id de l'article, on utilisera cet id pour la requête de suppression.
                                        On affiche le nom de l'article à l'utilisateur.
                                     -->
                                    <option value='<?php echo $donnees['ID']; ?>'>
                                        <?php echo $donnees['ID']; ?>
                                    </option>

                                <?php 
                                    }

                                    $requete->closeCursor();
                                ?>

                            </select>
                        </div>


                        <!-- Bouton d'envoi du formulaire -->
                        <button type="submit" class="btn btn-danger">Supprimer l'imprimantes</button>
                    </form>

                </div>
            </div>

        </div>

    </body>
</html>