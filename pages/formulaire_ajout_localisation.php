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
                    <h1>Formulaire d'ajout de localisation</h1>

                    <p>
                        Le formulaire ci-dessous va permettre d'ajouter un bureau dans la table des localisations. 
                    </p>

                    <!-- Ouverture de la balise de formulaire -->
                    <!-- 
                        La balise <form></form> est très importante car c'est à cet endroit que l'on va indiquer le fichier sur lequel se rendre lorsque l'on valide le formulaire.
                        Dans cet exemple ci-dessous, en validant le formulaire nous serons redirigés vers "ajout.php", c'est dans ce fichier que les informations saisies sur le formulaire seront traitées.
                        L'attribut "method" est nécessaire pour déterminer la façon dont les données seront envoyées, vous pouvez l'utiliser tel quel.
                    -->
                    <form action="../actions/Ajout_Localisation.php" method="POST">
                        
                        <!-- Nom de l'article -->
                        <div class="form-group">
                            <label for="Code_Bureau">Code Bureau</label>
                            <input type="text" class="form-control" id="Code_Bureau" name="Code_Bureau">
                        </div>

                        <div class="form-group">
                            <label for="Batiment">Batiment</label>
                            <!--<input type="text" class="form-control" id="ID_Utilisateurs" name="ID_Utilisateurs">-->
                            <select id="Batiment" class="form-control" name="Batiment">                                
                                <option hidden disabled selected value>Choisir ...</option>
                                <?php 
                                    $requete = $bdd->prepare('SELECT DISTINCT Batiment FROM localisation');
                                    $requete->execute();
                                    while( $donnees = $requete->fetch() )
                                    {
                                ?>

                                    <option value='<?php echo $donnees['Batiment']; ?>'>
                                        <?php echo $donnees['Batiment']; ?>
                                    </option>

                                <?php 
                                    }

                                    $requete->closeCursor();
                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Etage">Etage</label>
                            <!--<input type="text" class="form-control" id="ID_Utilisateurs" name="ID_Utilisateurs">-->
                            <select id="Etage" class="form-control" name="Etage">                                
                                <option hidden disabled selected value>Choisir ...</option>
                                <?php 
                                    $requete = $bdd->prepare('SELECT DISTINCT Etage FROM localisation');
                                    $requete->execute();
                                    while( $donnees = $requete->fetch() )
                                    {
                                ?>

                                    <option value='<?php echo $donnees['Etage']; ?>'>
                                        <?php echo $donnees['Etage']; ?>
                                    </option>

                                <?php 
                                    }

                                    $requete->closeCursor();
                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Bureau">Bureau</label>
                            <input type="text" class="form-control" id="Bureau" name="Bureau">
                        </div>

                        <!-- Bouton d'envoi du formulaire -->
                        <button type="submit" class="btn btn-success">Ajouter le bureau</button>
                    </form>
                </div>
            </div>

        </div>

    </body>
</html>