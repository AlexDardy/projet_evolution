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
            <h1>Liste des Ecrans</h1>

            <a href="Liste_Ecrans_Garantie.php">Afficher des écrans à renouveler dans les 3 mois</a>
            <!-- Ci-dessous une liste extraite à partir de la base de données -->
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
                                <th>ID Utilisateur</th>
                                <th>Code Bureau</th>
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

                                // Nous sommes à présent à l'intérieur des balises PHP, vous pouvez constater que la syntaxe des commentaires est différente. Un double slash permet de faire un commentaire sur une seule ligne.
                                /*
                                    On peut également faire un commentaire
                                    sur plusieurs lignes 
                                    à l'aide de cette syntaxe.
                                */

                                /* 
                                    Le bloc "try catch" si dessus signifie que l'on va tenter d'exécuter ce qui se trouve à l'intérieur des { } situées après le "try".
                                    Si le code présente une erreur (appelé "Exception"), alors ce qui se trouve dans les { } après le catch sera exécuté.
                                
                                */
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
                                $countSql = "SELECT COUNT(ID) FROM ecrans";
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
                                $requete = $bdd->prepare('SELECT ecrans.ID, ecrans.Marque, ecrans.Modele, ecrans.Date_Achat, ecrans.Duree_Garantie, ecrans.ID_Utilisateurs, utilisateurs.Code_Bureau
                                FROM ecrans, utilisateurs 
                                WHERE ecrans.ID_Utilisateurs = utilisateurs.ID 
                                LIMIT :debut, :nbDisplay;');
                                $requete->bindValue(':debut', $debut, PDO::PARAM_INT);
                                $requete->bindValue(':nbDisplay', $nbDisplay, PDO::PARAM_INT);
                                $requete->execute();


                                /*$requete = $bdd->prepare('SELECT ecrans.ID, ecrans.Marque, ecrans.Modele, ecrans.Date_Achat, ecrans.Duree_Garantie, ecrans.ID_Utilisateurs, utilisateurs.Code_Bureau
                                FROM ecrans, utilisateurs
                                WHERE ecrans.ID_Utilisateurs = utilisateurs.ID;');*/
                                /*$requete->execute();*/
                                // A partir de là nous pourrons utiliser la variable $requête pour avoir accès au résultat de la requête.

                                /* 
                                    Pour afficher le résultat nous allons utiliser une structure de code PHP (qui existe dans de nombreux langages) :

                                    while(condition){
                                        instructions...
                                    }
                                
                                    Le code "while" (signifiant "tant que") est une boucle, cela signifie qu'il va effectuer en boucle les instructions situées entre { } tant que la condition présente dans les parenthèses est respectée. 
                                    Dans notre cas, "while" va passer en revue chaque ligne de résultat de la requête une par une (avec "fetch") et les afficher dans le tableau tant qu'il y en a. 
                                    Quand tout aura été passé en revue, fetch ne retournera plus aucun résultat et while s'arrêtera, l'exécution du code pourra alors passer à la suite.
                                    
                                    Pour résumer, on pourrait traduire la ligne ci-dessous par :
                                    "Passe en revue chaque ligne du résultat de la requête, met le contenu de la ligne dans la variable $donnees, affiche les résultat dans une ligne de tableau HTML puis passe à l'enregistrement suivant. Arrête-toi lorsque tous les enregistrements ont lus."  
                                */
                                while( $donnees = $requete->fetch() )
                                {
                            ?>

                            <!-- 
                                La ligne du tableau ci-dessous se trouve entre les { } du while, cela signifie que cette ligne sera répétée pour chaque enregistrement retourné par la requête.
                                
                                Pour afficher quelque chose en PHP on utilise "echo" suivi de ce qu'on veut afficher.
                                $donnees['nom'] signifie "le champ 'nom' présent dans la variable $donnees". 
                                Grâce à "echo" on va afficher à chaque passage de la boucle le champ "nom" de l'enregistrement en cours.
                            -->
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
                                <td>
                                    <?php echo $donnees['Code_Bureau']; ?>
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

    </body>

</html>