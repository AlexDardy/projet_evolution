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
                    <form action="informations_services.php" method="post">

                        <!-- Input liste déroulante -->
                        <div class="form-group">
                            <label for="Nom">Choix du service à modifier</label>
                            <select id="Nom" class="form-control" name="Nom">                                
                                <option hidden disabled selected value>Choisir ...</option>
                                <?php 

                                    // Récupérer des données : on prépare la requête et on la met dans la variable $requete...
                                    $requete = $bdd->prepare('SELECT * FROM services');
                                    // ...puis on l'exécute
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
                        <button type="submit" class="btn btn-primary">Choisir le service</button>
                    </form>

                    <hr>

                    <h1>Informations Service</h1>

                    <?php 
                        if( empty($_POST['Nom']) == FALSE ){
                            $Nom_Services = $_POST['Nom'];
                            $requete = $bdd->prepare('SELECT * FROM services WHERE services.Nom=:Nom');
                            $requete->execute(['Nom' => $Nom_Services]);
                            $donnees = $requete->fetch();
                            $Nom = $donnees['Nom'];
                            $requete->closeCursor();
                        }
                        elseif ($_GET['Nom']) {
                            $Nom_Services = $_GET['Nom'];
                            $requete = $bdd->prepare('SELECT * FROM services WHERE services.Nom=:Nom');
                            $requete->execute(['Nom' => $Nom_Services]);
                            $donnees = $requete->fetch();
                            $Nom = $donnees['Nom'];
                            $requete->closeCursor();
                        }
                        else{
                            $Nom = '';                         
                        }
                        
                    ?>

                    <!-- Ouverture de la balise de formulaire -->
                        
                        <form>
                            <div class="form-group">
                                <label for="id">Nom du service</label>
                                <input type="text" class="form-control" id="id" name="id" value="<?php echo $Nom_Services; ?>" readonly>
                            </div>
                        </form>



                    <h2>Imprimantes</h2>
                    <table class="table table-striped table-sm table-light">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Marque</th>
                                        <th>Modele</th>
                                        <th>Couleur</th>
                                        <th>Date_Achat</th>
                                        <th>Duree_Garantie</th>
                                        <th>Code_Bureau</th>
                                        <th>Nom du service</th>
                                    </tr>
                                </thead>
                        <tbody>
                            <?php 
                                if( empty($_POST['Nom']) == FALSE ){
                                    $Nom_Services = $_POST['Nom'];
                                    $requete = $bdd->prepare('SELECT imprimantes.*
                                    FROM imprimantes
                                    WHERE imprimantes.Nom = :Nom;');
                                    $requete->execute(['Nom' => $Nom_Services]);
                                }
                                elseif ($_GET['Nom']) {
                                    $Nom_Services = $_GET['Nom'];
                                    $requete = $bdd->prepare('SELECT imprimantes.*
                                    FROM imprimantes
                                    WHERE imprimantes.Nom = :Nom;');
                                    $requete->execute(['Nom' => $Nom_Services]);
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
                                            <?php echo $donnees['Couleur']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Date_Achat']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Duree_Garantie']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Code_Bureau']; ?>
                                        </td>
                                        <td>
                                            <?php echo $donnees['Nom']; ?>
                                        </td>
                                    </tr>
                                <?php
                                            }
                                        $requete->closeCursor();
                                    ?>
                        </tbody>
                    </table>
                    <h2>Utilisateurs</h2>
                    <table class="table table-striped table-sm table-light">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Code_Bureau</th>
                                    </tr>
                                </thead>
                        <tbody>
                                <?php 
                                    if( empty($_POST['Nom']) == FALSE ){
                                        $Nom_Services = $_POST['Nom'];
                                        $requete = $bdd->prepare('SELECT utilisateurs.*
                                        FROM utilisateurs
                                        WHERE utilisateurs.Nom_Services=:Nom;');
                                        $requete->execute(['Nom' => $Nom_Services]);
                                    }
                                    elseif ($_GET['Nom']) {
                                        $Nom_Services = $_GET['Nom'];
                                        $requete = $bdd->prepare('SELECT utilisateurs.*
                                        FROM utilisateurs
                                        WHERE utilisateurs.Nom_Services=:Nom;');
                                        $requete->execute(['Nom' => $Nom_Services]);
                                    }

                                    while( $donnees = $requete->fetch() )
                                    {
                            ?>


                                    <tr>
                                        <td>
                                            <?php
                                                $folder_path = "informations_utilisateurs.php?id_utilisateurs=" . $donnees['ID'];
                                                echo '<a href="' . $folder_path . '"> '. $donnees['ID'] .' </a>';
                                            ?>
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