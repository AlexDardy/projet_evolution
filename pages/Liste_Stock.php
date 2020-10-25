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
                    <h2>Matériel en stock</h2>

                    <h3>Ordinateurs</h3>
                    <div class="row">
                <div class="col-lg">

                    <table class="table table-striped table-sm table-light">

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

                                ?>
                            <?php
                                try
                                {
                                    $bdd = new PDO('mysql:host=localhost;dbname=evolution;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                                }
                                catch(Exception $e)
                                {
                                    // Affiche l'erreur si celle-ci se produit et interrompt l'exécution de la suite du code.
                                    die('Erreur : '.$e->getMessage());
                                }
                                // On va ensuite préparer la requête pour récupérer les données souhaitées,
                                // on la met dans une variable qu'on appelle $requete...
                                $countSql = "SELECT COUNT(ID) FROM Ordinateurs WHERE ID_Utilisateurs IS NULL";
                                $query = $bdd->query($countSql);
                                $nbRows = $query->fetch(PDO::FETCH_COLUMN);
                                if (empty($_GET['p'])) {
                                    $p = 1;
                                } else {
                                    $p = (int) $_GET['p'];
                                }
                                $nbDisplay = 15;
                                $debut = $p * $nbDisplay - $nbDisplay;
                                $pagination = (int) ceil($nbRows/$nbDisplay);  
                                $requete = $bdd->prepare('SELECT * FROM Ordinateurs
                                WHERE ID_Utilisateurs IS NULL
                                LIMIT :debut, :nbDisplay;');
                                $requete->bindValue(':debut', $debut, PDO::PARAM_INT);
                                $requete->bindValue(':nbDisplay', $nbDisplay, PDO::PARAM_INT);
                                $requete->execute();

                                
                                // ...puis on l'exécute
                                $requete->execute();
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
                            
                            <?php
                                }

                                $requete->closeCursor();
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>


                <h3>Ecrans(s)</h3>

                <div class="row">
                <div class="col-lg">

                    <table class="table table-striped table-sm table-light">

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

                                ?>

                            <?php

                                try
                                {
 
                                    $bdd = new PDO('mysql:host=localhost;dbname=evolution;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                                }
                                catch(Exception $e)
                                {
                                    // Affiche l'erreur si celle-ci se produit et interrompt l'exécution de la suite du code.
                                    die('Erreur : '.$e->getMessage());
                                }

                                // On va ensuite préparer la requête pour récupérer les données souhaitées,
                                // on la met dans une variable qu'on appelle $requete...
                                $countSql = "SELECT COUNT(ID) FROM ecrans WHERE ID_Utilisateurs IS NULL";
                                $query = $bdd->query($countSql);
                                $nbRows = $query->fetch(PDO::FETCH_COLUMN);
                                if (empty($_GET['p'])) {
                                    $p = 1;
                                } else {
                                    $p = (int) $_GET['p'];
                                }
                                $nbDisplay = 15;
                                $debut = $p * $nbDisplay - $nbDisplay;
                                $pagination = (int) ceil($nbRows/$nbDisplay);  
                                $requete = $bdd->prepare('SELECT * FROM ecrans
                                WHERE ID_Utilisateurs IS NULL
                                LIMIT :debut, :nbDisplay;');
                                $requete->bindValue(':debut', $debut, PDO::PARAM_INT);
                                $requete->bindValue(':nbDisplay', $nbDisplay, PDO::PARAM_INT);
                                $requete->execute();

                                // ...puis on l'exécute
                                $requete->execute();
                                // A partir de là nous pourrons utiliser la variable $requête pour avoir accès au résultat de la requête.

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
                                // Ci-dessous on ferme le } du while puis on utilise "closeCursor" pour indiquer que l'on a fini d'utiliser le résultat de la requête.
                                }

                                $requete->closeCursor();
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>


                <h3>Téléphone(s)</h3>
                <div class="row">
                <div class="col-lg">

                    <table class="table table-striped table-sm table-light">

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

                                ?>


                            <?php


                                try
                                {
 
                                    $bdd = new PDO('mysql:host=localhost;dbname=evolution;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                                }
                                catch(Exception $e)
                                {
                                    // Affiche l'erreur si celle-ci se produit et interrompt l'exécution de la suite du code.
                                    die('Erreur : '.$e->getMessage());
                                }

                                // On va ensuite préparer la requête pour récupérer les données souhaitées,
                                // on la met dans une variable qu'on appelle $requete...
                                $countSql = "SELECT COUNT(ID) FROM telephones WHERE ID_Utilisateurs IS NULL";
                                $query = $bdd->query($countSql);
                                $nbRows = $query->fetch(PDO::FETCH_COLUMN);
                                if (empty($_GET['p'])) {
                                    $p = 1;
                                } else {
                                    $p = (int) $_GET['p'];
                                }
                                $nbDisplay = 15;
                                $debut = $p * $nbDisplay - $nbDisplay;
                                $pagination = (int) ceil($nbRows/$nbDisplay);  
                                $requete = $bdd->prepare('SELECT * FROM telephones
                                WHERE ID_Utilisateurs IS NULL
                                LIMIT :debut, :nbDisplay;');
                                $requete->bindValue(':debut', $debut, PDO::PARAM_INT);
                                $requete->bindValue(':nbDisplay', $nbDisplay, PDO::PARAM_INT);
                                $requete->execute();

                                // A partir de là nous pourrons utiliser la variable $requête pour avoir accès au résultat de la requête.


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
                                // Ci-dessous on ferme le } du while puis on utilise "closeCursor" pour indiquer que l'on a fini d'utiliser le résultat de la requête.
                                }

                                $requete->closeCursor();
                            ?>

                        </tbody>
                    </table>
                    <ul class="pagination justify-content-end">
                        <?php
                            $customPagination = 0;
                            while ($customPagination < $pagination) {
                                echo '<li class="page-item"><a class="page-link" href="?p='. ($customPagination+1) . '">'. ($customPagination+1).'</a></li>';
                                $customPagination++;
                            }
                        ?>
                    </ul>
                </div>
            </div>

            </div>

        </div>

    </body>
</html>