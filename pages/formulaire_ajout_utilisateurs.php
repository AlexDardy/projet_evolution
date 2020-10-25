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
                <div class="col-lg-12">
                    <h1>Formulaire d'ajout d'utilisateurs</h1>

                    <p>
                        Le formulaire ci-dessous va permettre d'ajouter un utilisateur dans la table des utilisateurs. 
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

                        <div class="form-group">
                            <label for="Prenom">Prenom</label>
                            <input type="text" class="form-control" id="Prenom" name="Prenom">
                        </div>

                        <div class="form-group">
                            <label for="Code_Bureau">Code du Bureau</label>
                            <!--<input type="text" class="form-control" id="ID_Utilisateurs" name="ID_Utilisateurs">-->
                            <select id="Code_Bureau" class="form-control" name="Code_Bureau">                                
                                <option hidden disabled selected value>Choisir ...</option>
                                <?php 
                                    $requete = $bdd->prepare('SELECT * FROM localisation');
                                    $requete->execute();
                                    while( $donnees = $requete->fetch() )
                                    {
                                ?>

                                    <option value='<?php echo $donnees['Code_Bureau']; ?>'>
                                        <?php echo $donnees['Code_Bureau']; ?>
                                    </option>

                                <?php 
                                    }

                                    $requete->closeCursor();
                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Nom_Services">Service</label>
                            <!--<input type="text" class="form-control" id="ID_Utilisateurs" name="ID_Utilisateurs">-->
                            <select id="Nom_Services" class="form-control" name="Nom_Services">                                
                                <option hidden disabled selected value>Choisir ...</option>
                                <?php 
                                    $requete = $bdd->prepare('SELECT * FROM services');
                                    $requete->execute();
                                    while( $donnees = $requete->fetch() )
                                    {
                                ?>

                                    <option value='<?php echo $donnees['Nom']; ?>'>
                                        <?php echo $donnees['Nom']; ?>
                                    </option>

                                <?php 
                                    }

                                    $requete->closeCursor();
                                ?>

                            </select>
                        </div>

                        <!-- Bouton d'envoi du formulaire -->
                        <button type="submit" class="btn btn-success">Ajouter l'Utilisateur</button>
                    </form>
                </div>
            </div>

        </div>

    </body>
</html>