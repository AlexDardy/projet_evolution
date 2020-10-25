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

    <!-- Cette page contient la liste des enregistrements de la base de données -->

    <!-- 
        Toute la partie "head" ainsi que la barre de navigation est la même que pour la page index. 
        Une amélioration est possible avec la fonction PHP require() pour éviter de réécrire la même portion de code sur chaque page.
        Rendez-vous sur https://www.php.net/manual/fr/language.control-structures.php pour plus d'informations.
    -->
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

            <hr>


            <h1>Gestion des utilisateurs :</h1>

            <h1>Ordinateurs</h1>

            <!-- Ci-dessous une liste extraite à partir de la base de données -->
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

                            <!-- 
                                Nous allons écrire ci-dessous du code PHP pour communiquer avec la base de données.

                                Le code PHP s'écrit entre les balises :
                                <?php 

                                ?>

                                Ce qui signifie que tout ce qui est écrit entre ces balises sera interprêté comme du code PHP et exécuté.
                             -->
                            <?php


                                
                                try
                                {
                                    // On commence par créer une connexion avec la base de données avec la ligne ci-dessous. Les erreurs seront affichées s'il y en a.
                                    // On stocke le résultat de cette connexion dans une variable $bdd qui sera utilisée par la suite pour exécuter les requêtes.
                                    $bdd = new PDO('mysql:host=localhost;dbname=evolution;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                                }
                                catch(Exception $e)
                                {
                                    // Affiche l'erreur si celle-ci se produit et interrompt l'exécution de la suite du code.
                                    die('Erreur : '.$e->getMessage());
                                }

                                
                                $requete = $bdd->prepare('SELECT * FROM Utilisateurs');
                                $requete->execute();


                                
                                while( $donnees = $requete->fetch() )
                                {
                            ?>

                               
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
                            
                            <?php
                                // Ci-dessous on ferme le } du while puis on utilise "closeCursor" pour indiquer que l'on a fini d'utiliser le résultat de la requête.
                                }

                                $requete->closeCursor();
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <h1>Ecrans</h1>

            <!-- Ci-dessous une liste extraite à partir de la base de données -->
            <div class="row">
                <div class="col-lg">

                    <table class="table table-striped">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marque</th>
                            <th>Modele</th>
                            <th>Date_Achat</th>
                            <th>Duree_Garantie</th>
                            <th>ID_Utilisateurs</th>
                        </tr>
                        </thead>

            <tbody>

                <!-- 
                    Nous allons écrire ci-dessous du code PHP pour communiquer avec la base de données.

                    Le code PHP s'écrit entre les balises :
                    <?php 

                    ?>

                    Ce qui signifie que tout ce qui est écrit entre ces balises sera interprêté comme du code PHP et exécuté.
                 -->
                <?php


                    
                    try
                    {
                        // On commence par créer une connexion avec la base de données avec la ligne ci-dessous. Les erreurs seront affichées s'il y en a.
                        // On stocke le résultat de cette connexion dans une variable $bdd qui sera utilisée par la suite pour exécuter les requêtes.
                        $bdd = new PDO('mysql:host=localhost;dbname=evolution;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    }
                    catch(Exception $e)
                    {
                        // Affiche l'erreur si celle-ci se produit et interrompt l'exécution de la suite du code.
                        die('Erreur : '.$e->getMessage());
                    }

                    
                    $requete = $bdd->prepare('SELECT * FROM Ecrans');
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
                        <?php echo $donnees['Date_Achat']; ?>
                    </td>
                    <td>
                        <?php echo $donnees['Duree_Garantie']; ?>
                    </td>
                    <td>
                        <?php echo $donnees['ID_Utilisateurs']; ?>
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

<h1>Liste des Imprimantes</h1>

<!-- Ci-dessous une liste extraite à partir de la base de données -->
<div class="row">
    <div class="col-lg">

        <table class="table table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marque</th>
                    <th>Modele</th>
                    <th>Couleur</th>
                    <th>Date d'achat</th>
                    <th>Duree de Garantie</th>
                    <th>Code_Bureau</th>
                    <th>Nom</th>
                </tr>
            </thead>

            <tbody>

                <!-- 
                    Nous allons écrire ci-dessous du code PHP pour communiquer avec la base de données.

                    Le code PHP s'écrit entre les balises :
                    <?php 

                    ?>

                    Ce qui signifie que tout ce qui est écrit entre ces balises sera interprêté comme du code PHP et exécuté.
                 -->
                <?php


                    try
                    {
                        // On commence par créer une connexion avec la base de données avec la ligne ci-dessous. Les erreurs seront affichées s'il y en a.
                        // On stocke le résultat de cette connexion dans une variable $bdd qui sera utilisée par la suite pour exécuter les requêtes.
                        $bdd = new PDO('mysql:host=localhost;dbname=evolution;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    }
                    catch(Exception $e)
                    {
                        // Affiche l'erreur si celle-ci se produit et interrompt l'exécution de la suite du code.
                        die('Erreur : '.$e->getMessage());
                    }

                    // On va ensuite préparer la requête pour récupérer les données souhaitées,
                    // on la met dans une variable qu'on appelle $requete...
                    $requete = $bdd->prepare('SELECT * FROM imprimantes');
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
                    // Ci-dessous on ferme le } du while puis on utilise "closeCursor" pour indiquer que l'on a fini d'utiliser le résultat de la requête.
                    }

                    $requete->closeCursor();
                ?>

            </tbody>
        </table>
    </div>
</div>

<h1>Liste des Ecrans</h1>

<!-- Ci-dessous une liste extraite à partir de la base de données -->
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
                    <th>ID_Utilisateurs</th>
                </tr>
            </thead>

            <tbody>

                <!-- 
                    Nous allons écrire ci-dessous du code PHP pour communiquer avec la base de données.

                    Le code PHP s'écrit entre les balises :
                    <?php 

                    ?>

                    Ce qui signifie que tout ce qui est écrit entre ces balises sera interprêté comme du code PHP et exécuté.
                 -->
                <?php

                    try
                    {
                        // On commence par créer une connexion avec la base de données avec la ligne ci-dessous. Les erreurs seront affichées s'il y en a.
                        // On stocke le résultat de cette connexion dans une variable $bdd qui sera utilisée par la suite pour exécuter les requêtes.
                        $bdd = new PDO('mysql:host=localhost;dbname=evolution;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    }
                    catch(Exception $e)
                    {
                        // Affiche l'erreur si celle-ci se produit et interrompt l'exécution de la suite du code.
                        die('Erreur : '.$e->getMessage());
                    }

                    // On va ensuite préparer la requête pour récupérer les données souhaitées,
                    // on la met dans une variable qu'on appelle $requete...
                    $requete = $bdd->prepare('SELECT * FROM Telephones');
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
                        <?php echo $donnees['Mobile']; ?>
                    </td>
                    <td>
                        <?php echo $donnees['Date_Achat']; ?>
                    </td>
                    <td>
                        <?php echo $donnees['Duree_Garantie']; ?>
                    </td>
                    <td>
                        <?php echo $donnees['ID_Utilisateurs']; ?>
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

        </div>

    </body>

</html>