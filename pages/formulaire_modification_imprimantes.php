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
                    <form action="formulaire_modification_imprimantes.php" method="post">

                        <!-- Input liste déroulante -->
                        <div class="form-group">
                            <label for="id_imprimantes">Choix de l'imprimante à modifier</label>
                            <select id="id_imprimantes" class="form-control" name="id_imprimantes">                                
                                <option hidden disabled selected value>Choisir ...</option>
                                <?php 

                                    // Récupérer des données : on prépare la requête et on la met dans la variable $requete...
                                    $requete = $bdd->prepare('SELECT * FROM imprimantes');
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
                        <button type="submit" class="btn btn-primary">Choisir l'imprimante</button>
                    </form>

                    <hr>

                    <h1>Formulaire de modification d'imprimantes</h1>

                    <?php 

                        
                        if( empty($_POST['id_imprimantes']) == FALSE ){

                            // Si la condition est respectée, on va chercher l'enregistrement correspondant à cet id dans la base de données.
                            
                            // On commence par créer une variable $id_imprimantes contenant cette valeur
                            $id_imprimantes = $_POST['id_imprimantes'];


                            // Préparation de la requête pour récupérer l'enregistrement
                            // Il est important de noter le ":id_imprimantes", cela correspond à une valeur qu'on va insérer dans la requête par la suite.
                            $requete = $bdd->prepare('SELECT * FROM imprimantes WHERE ID=:id_imprimantes');
                            

                            // On exécute la requête en lui passant la variable contenant l'id à chercher. Cette valeur sera insérée à la place de :id_imprimantes dans la requête
                            /*
                                Il est à noter qu'on peut faire la même chose avec plusieurs valeurs. Exemple : 
                                $requete = $bdd->prepare('SELECT * FROM articles WHERE id=:valeur1 AND nom=:valeur2 ');
                                $requete->execute(['valeur1' => $variable1, 'valeur2' => $variable2]);
                            */
                            $requete->execute(['id_imprimantes' => $id_imprimantes]);


                            // On place le résultat dans la variable $donnees
                            $donnees = $requete->fetch();


                            // On crée les variables contenant les valeurs de l'enregistrement récupéré, de cette manière nous pourrons les utiliser comme valeurs par défaut dans le formulaire.
                            $Marque = $donnees['Marque'];
                            $Modele = $donnees['Modele'];
                            $Couleur = $donnees['Couleur'];
                            $Date_Achat = $donnees['Date_Achat'];
                            $Duree_Garantie = $donnees['Duree_Garantie'];
                            $Code_Bureau = $donnees['Code_Bureau'];
                            $Nom = $donnees['Nom'];

                            $requete->closeCursor();
                        }
                        else{
                            // Dans le cas où aucun formulaire n'a été envoyé pour le chargement de la page (ce qui arrive tant qu'on n'a sélectionné aucun article dans la liste déroulante) 
                            // on crée tout de même les variables sans mettre de valeur (chaine de caractère vide) car elles sont utilisées dans le formulaire ci-dessous et il y aura une erreur si elles sont appelées sans exister. 
                            $Marque = '';
                            $Modele = '';
                            $Couleur = '';
                            $Date_Achat = '';
                            $Duree_Garantie = '';
                            $Code_Bureau = '';
                            $Nom = ''; 
                            $id_imprimantes = '';                          
                        }
                        
                    ?>

                    <!-- Ouverture de la balise de formulaire -->
                    <form action="../actions/modification_imprimantes.php" method="POST">
                        
                        <!-- ID de l'article -->
                        <!-- 
                            Cet input est désactivé pour éviter la modification grâce à l'attribut "readonly", en effet on ne souhaite en aucun cas modifier l'id !! 
                            Il est présent à titre informatif.
                            On remarque également l'attribut "value" qui permet d'indiquer une valeur par défaut, cette valeur par défaut correspond aux variables créées ci-dessus.
                        -->
                        <div class="form-group">
                            <label for="id">Id de l'imprimante</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $id_imprimantes; ?>" readonly>
                        </div>

                        <!-- Nom de l'article -->
                        <div class="form-group">
                            <label for="Marque">Marque</label>
                            <input type="text" class="form-control" id="Marque" name="Marque" value="<?php echo $Marque; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Modele">Modèle</label>
                            <input type="text" class="form-control" id="Modele" name="Modele" value="<?php echo $Modele; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Couleur">Couleur</label>
                            <input type="text" class="form-control" id="Couleur" name="Couleur" value="<?php echo $Couleur; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Date_Achat">Date d'achat</label>
                            <input type="date" class="form-control" id="Date_Achat" name="Date_Achat" value="<?php echo $Date_Achat; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Duree_Garantie">Duree de garantie</label>
                            <input type="text" class="form-control" id="Duree_Garantie" name="Duree_Garantie" value="<?php echo $Duree_Garantie; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Code_Bureau">Code_Bureau</label>
                            <input type="text" class="form-control" id="Code_Bureau" name="Code_Bureau" value="<?php echo $Code_Bureau; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Nom">Nom</label>
                            <input type="text" class="form-control" id="Nom" name="Nom" value="<?php echo $Nom; ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier l'imprimante</button>
                    </form>
                </div>
            </div>

        </div>

    </body>
</html>