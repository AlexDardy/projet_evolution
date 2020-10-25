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
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
            <a class="navbar-brand" href="index.php">Cours</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Sommaire</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="mise_en_forme.php">Mettre en forme</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="liste.php">Afficher</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="formulaire_ajout.php">Ajouter</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="formulaire_suppression.php">Supprimer</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="formulaire_modification.php">Modifier</a>
                    </li>
                    
                </ul>
            </div>
        </nav>

        <!-- 
            Connexion à la base de données
         -->
         <?php 
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=pc;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch(Exception $e)
            {
                    die('Erreur : '.$e->getMessage());
            }
        ?>

        <div class="container">

            <div class="row">
                <div class="col-lg">

                    <hr>

                    <div class="alert alert-info" role="alert">
                        Ouvrez cette page (formulaire_suppression.php) dans un éditeur de texte pour avoir plus de renseignements. 
                    </div>

                    <h1>Supprimer des enregistrements</h1>

                    <p>
                        Nous allons voir ci-dessous comment supprimer un enregistrement. Nous allons suivre la procédure suivante :
                    </p>
                    <ol>
                        <li>On crée un formulaire contenant une liste déroulante des articles pour choisir celui à supprimer</li>
                        <li>On met un bouton pour envoyer le formulaire vers une page où sera traitée la suppression</li>
                        <li>Une fois l'article supprimé, on redirige vers la liste des articles</li>
                    </ol>

                    <form action="../actions/suppression.php" method="post">

                        <!-- Input liste déroulante -->
                        <div class="form-group">
                            <label for="id_ordinateur">Choix de l'article à supprimer</label>
                            <select id="id_ordinateur" class="form-control" name="id_ordinateur">
                                <option value='' selected>Choisir...</option>
                                
                                <!-- 
                                    Ci-dessous on va utiliser PHP pour remplir la liste déroulante avec les enregistrements de la base de données.
                                    Chaque <option></option> correspondra à une ligne de la table.
                                 -->
                                <?php 

                                    // Récupérer des données : on prépare la requête et on la met dans la variable $requete...
                                    $requete = $bdd->prepare('SELECT * FROM ordinateurs');
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
                                        <?php echo $donnees['NumeroDeSerie']; ?>
                                    </option>

                                <?php 
                                    }

                                    $requete->closeCursor();
                                ?>

                            </select>
                        </div>


                        <!-- Bouton d'envoi du formulaire -->
                        <button type="submit" class="btn btn-danger">Supprimer l'article</button>
                    </form>

                </div>
            </div>

        </div>

    </body>
</html>