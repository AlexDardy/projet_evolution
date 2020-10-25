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
                    <!-- 
                        Ouverture du formulaire, dans "action" on met cette même page pour revenir dessus une fois le formulaire envoyé.
                     -->
                    <form action="informations_utilisateurs.php" method="post">

                        <!-- Input liste déroulante -->
                        <div class="form-group">
                            <label for="id_utilisateurs">Choix de l'utilisateur à modifier</label>
                            <select id="id_utilisateurs" class="form-control" name="id_utilisateurs">                                
                                <option hidden disabled selected value>Choisir ...</option>
                                <?php 

                                    // Récupérer des données : on prépare la requête et on la met dans la variable $requete...
                                    $requete = $bdd->prepare('SELECT * FROM utilisateurs');
                                    // ...puis on l'exécute
                                    $requete->execute();

                                    while( $donnees = $requete->fetch() )
                                    {
                                ?>

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
                        <button type="submit" class="btn btn-primary">Choisir l'utilisateurs</button>
                    </form>

                    <hr>

                    <h1>Informations Utilisateur</h1>

                    <?php 
                        if( empty($_POST['id_utilisateurs']) == FALSE ){
                            $id_utilisateurs = $_POST['id_utilisateurs'];
                            $requete = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID=:id_utilisateurs');
                            $requete->execute(['id_utilisateurs' => $id_utilisateurs]);
                            $donnees = $requete->fetch();
                            $Nom = $donnees['Nom'];
                            $Prenom = $donnees['Prenom'];
                            $Code_Bureau = $donnees['Code_Bureau'];
                            $Nom_Services = $donnees['Nom_Services'];
                            $requete->closeCursor();
                        }
                        else{
                            $Nom = '';
                            $Prenom = '';
                            $Code_Bureau = '';
                            $Nom_Services = '';
                            $id_utilisateurs = '';                          
                        }
                        
                    ?>

                    <!-- Ouverture de la balise de formulaire -->
                    <h2>Utilisateur</h2>
                    <form>
                        <div class="form-group">
                            <label for="id">Id de l'utilisateur</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $id_utilisateurs; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Nom">Nom</label>
                            <input type="text" class="form-control" id="Nom" name="Nom" value="<?php echo $Nom; ?> " readonly>
                        </div>
                        <div class="form-group">
                            <label for="Prenom">Prenom</label>
                            <input type="text" class="form-control" id="Prenom" name="Prenom" value="<?php echo $Prenom; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Code_Bureau">Code de Bureau</label>
                            <input type="text" class="form-control" id="Code_Bureau" name="Code_Bureau" value="<?php echo $Code_Bureau; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Nom_Services">Nom du Services</label>
                            <input type="text" class="form-control" id="Nom_Services" name="Nom_Services" value="<?php echo $Nom_Services; ?>" readonly>
                        </div>
                    </form>

                    <h2>Téléphones</h2>
                    <?php 
                        if( empty($_POST['id_utilisateurs']) == FALSE ){
                            $id_utilisateurs = $_POST['id_utilisateurs'];
                            $requete = $bdd->prepare('SELECT * FROM telephones WHERE ID_Utilisateurs=:id_utilisateurs');
                            $requete->execute(['id_utilisateurs' => $id_utilisateurs]);
                        }
                        while( $donnees = $requete->fetch() )
                                {
                        ?>
                        <div>
                            <p><?php echo $donnees["Marque"]; ?></p>
                            <p><?php echo $donnees["Modele"]; ?></p>
                            <p><?php echo $donnees["Date_Achat"]; ?></p>
                        </div>
                    <?php
                                }
                            $requete->closeCursor();
                        ?>
                </div>
            </div>

        </div>

    </body>
</html>