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
                <div class="col-lg-12">
                    <h1>Formulaire d'ajout d'un rôle</h1>

                    <p>
                        Le formulaire ci-dessous va permettre d'ajouter un rôle dans la table des rôles. 
                    </p>

                    <!-- Ouverture de la balise de formulaire -->
                    <!-- 
                        La balise <form></form> est très importante car c'est à cet endroit que l'on va indiquer le fichier sur lequel se rendre lorsque l'on valide le formulaire.
                        Dans cet exemple ci-dessous, en validant le formulaire nous serons redirigés vers "ajout.php", c'est dans ce fichier que les informations saisies sur le formulaire seront traitées.
                        L'attribut "method" est nécessaire pour déterminer la façon dont les données seront envoyées, vous pouvez l'utiliser tel quel.
                    -->
                    <form action="../actions/Ajout_Utilisateurs.php" method="POST">
                        
                        <!-- Nom de l'article -->
                        <div class="form-group">
                            <label for="Nom">Nom</label>
                            <input type="text" class="form-control" id="Nom" name="Nom">
                        </div>

                        <!-- Bouton d'envoi du formulaire -->
                        <button type="submit" class="btn btn-success">Ajouter map_role</button>
                    </form>
                </div>
            </div>

        </div>

    </body>
</html>