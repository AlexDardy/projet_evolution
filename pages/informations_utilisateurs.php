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
                        <button type="submit" class="btn btn-primary">Choisir l'utilisateur</button>
                    </form>

                    <hr>

                    <h1>Informations Utilisateur</h1>

                    <div class="row">
                    <div class="col-lg">

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Code_Bureau</th>
                                <th>Nom_Services</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                elseif ($_GET['id_utilisateurs']) {
                                    $id_utilisateurs = $_GET['id_utilisateurs'];
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
                                    <tr>
                                        <td>
                                            <?php echo $donnees['ID']; ?> 
                                        </td>
                                        <td>
                                            <?php echo $donnees['Nom']; ?> 
                                        </td>
                                        <td>
                                            <?php echo $donnees['Prenom']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Code_Bureau']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Nom_Services']; ?>
                                        </td>
                                    </tr>
                        </tbody>
                    </table> 
                            <?php
                            $requete->closeCursor();
                        ?>



                    <h2>Ordinateur</h2>
                <div class="row">
                <div class="col-lg">

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Marque</th>
                                <th>Modele</th>
                                <th>Taille_Disque</th>
                                <th>Taille_Memoire</th>
                                <th>Date_Achat</th>
                                <th>Duree_Garantie</th>
                            </tr>
                        </thead>

                            <tbody>
                                    <?php 
                                        if( empty($_POST['id_utilisateurs']) == FALSE ){
                                            $id_utilisateurs = $_POST['id_utilisateurs'];
                                            $requete = $bdd->prepare('SELECT * FROM ordinateurs WHERE ID_Utilisateurs=:id_utilisateurs');
                                            $requete->execute(['id_utilisateurs' => $id_utilisateurs]);
                                        }

                                        elseif ($_GET['id_utilisateurs']) {
                                            $id_utilisateurs = $_GET['id_utilisateurs'];
                                            $requete = $bdd->prepare('SELECT * FROM ordinateurs WHERE ID_Utilisateurs=:id_utilisateurs');
                                            $requete->execute(['id_utilisateurs' => $id_utilisateurs]);
                                        }
                                        $donnees = $requete->fetch();
                                        $requete->closeCursor();
                                    ?>
                                                
                                    <tr>
                                        <td>
                                            <?php echo $donnees['ID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Marque']; ?> 
                                        </td>
                                        <td>
                                            <?php echo $donnees['Modele']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Taille_Disque']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Taille_Memoire']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Date_Achat']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Duree_Garantie']; ?>
                                        </td>
                                    </tr>
                            </tbody>
                    </table> 
                            <?php
                            $requete->closeCursor();
                            ?>


                <h2>Ecran(s)</h2>
                    <div class="row">
                <div class="col-lg">

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Marque</th>
                                <th>Modele</th>
                                <th>Date d'achat</th>
                                <th>Duree de Garantie</th>
                            </tr>
                        </thead>

                        <tbody>
                                <?php 
                                    if( empty($_POST['id_utilisateurs']) == FALSE ){
                                        $id_utilisateurs = $_POST['id_utilisateurs'];
                                        $requete = $bdd->prepare('SELECT * FROM ecrans WHERE ID_Utilisateurs=:id_utilisateurs');
                                        $requete->execute(['id_utilisateurs' => $id_utilisateurs]);
                                    }
                                    elseif ($_GET['id_utilisateurs']) {
                                        $id_utilisateurs = $_GET['id_utilisateurs'];
                                        $requete = $bdd->prepare('SELECT * FROM ecrans WHERE ID_Utilisateurs=:id_utilisateurs');
                                        $requete->execute(['id_utilisateurs' => $id_utilisateurs]);
                                    }
                                    while( $donnees = $requete->fetch() )
                                            {
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $donnees['ID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Marque']; ?> 
                                        </td>
                                        <td>
                                            <?php echo $donnees['Modele']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Date_Achat']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Duree_Garantie']; ?>
                                        </td>
                                    </tr>
                        <?php
                            }
                            $requete->closeCursor();
                        ?>
                        </tbody>
                    </table> 


                </div>
                </div>


                    <h2>Téléphone(s)</h2>
                    <div class="row">
                <div class="col-lg">

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Marque</th>
                                <th>Modele</th>
                                <th>Mobile</th>
                                <th>Date d'achat</th>
                                <th>Duree de Garantie</th>
                            </tr>
                        </thead>

                        <tbody>
                                <?php 
                                    if( empty($_POST['id_utilisateurs']) == FALSE ){
                                        $id_utilisateurs = $_POST['id_utilisateurs'];
                                        $requete = $bdd->prepare('SELECT * FROM telephones WHERE ID_Utilisateurs=:id_utilisateurs');
                                        $requete->execute(['id_utilisateurs' => $id_utilisateurs]);
                                    }
                                    elseif ($_GET['id_utilisateurs']) {
                                        $id_utilisateurs = $_GET['id_utilisateurs'];
                                        $requete = $bdd->prepare('SELECT * FROM telephones WHERE ID_Utilisateurs=:id_utilisateurs');
                                        $requete->execute(['id_utilisateurs' => $id_utilisateurs]);
                                    }
                                    while( $donnees = $requete->fetch() )
                                            {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $donnees['ID']; ?>
                                    </td>
                                    <td>
                                        <?php echo $donnees['Marque']; ?> 
                                    </td>
                                    <td>
                                        <?php echo $donnees['Modele']; ?>
                                    </td>
                                    <td>
                                        <?php echo $donnees['Mobile']; ?>
                                    </td>
                                    <td>
                                        <?php echo $donnees['Date_Achat']; ?>
                                    </td>
                                    <td>
                                        <?php echo $donnees['Duree_Garantie']; ?>
                                    </td>
                                </tr>
                        <?php
                            }
                            $requete->closeCursor();
                        ?>
                        </tbody>
                    </table> 


                </div>
            </div>

        </div>

    </body>
</html>