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
                    <form action="formulaire_modification_utilisateurs.php" method="post">

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
                                        <?php echo $donnees['ID'].' - '.$donnees['Nom'].' '.$donnees['Prenom']; ?>
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

                    <h1>Formulaire de modification utilisateur</h1>

                    <?php 

                        /* 
                            On définit les valeurs qui seront utilisées ci-dessous dans le formulaire.
                            
                            Deux possibilités :
                            1) Aucun article n'a été choisi et donc $_POST est vide, le formulaire ne sera donc pas rempli.
                            2) Un article a été choisi et on a donc $_POST['id_utilisateurs'] contenant l'id de l'article, on va pouvoir récupérer l'enregistrement correspondant dans la base de données pour préremplir le formulaire.

                            Pour info, 'id_utilisateurs' correspond à l'attribut "name" de la liste déroulante.
                        */

                        /*
                            Nous allons utiliser la structure PHP suivante :

                            if(condition){
                                instructions si la condition est vraie...
                            }
                            else{
                                instructions si la condition est fausse...
                            }
                        
                            La structure IF est la base de tous les langages de programmation. Nous testons une condition (qui peut être une égalité ou autre) et si celle-ci est respectée on exécute ce qu'il y a à l'intérieur des { }, sinon on ignore ces instructions et on passe à la suite.
                            S'il y a un "else" à la suite du "if" (optionnel), on exécutera ce qu'il y a dans les { } si la condition n'est PAS respectée.
                        */

                        /* 
                            Ci-dessous, on va avoir la condition suivante : empty( $_POST['id_utilisateurs'] ) == FALSE
                            
                            Si on la décompose cela donne :
                            $_POST['id_utilisateurs'] correspond à la valeur de l'input "id_utilisateurs" qui a été envoyée par un formulaire au chargement de la page. Si aucun input ne correspond à ce nom, alors $_POST['id_utilisateurs'] sera vide, dans le cas contraire il contiendra la valeur de l'input.
                            empty() est une fonction PHP qui permet de vérifier si la variable qu'on met entre parenthèses est vide ou non. Si la variable est vide, la fonction retourne la valeur TRUE, sinon FALSE.
                            empty( $_POST['id_utilisateurs] ) signifie donc qu'on va avoir TRUE si $_POST['id_utilisateurs'] est vide ou FALSE s'il contient une valeur.
                            == permet de dire "est-il égal à... ?" dans notre cas, cela donne "la fonction empty() retourne-t-elle la valeur FALSE ?". Il est indispensable de mettre 2 fois le symbole == dans ce cas de figure.

                            Pour résumer, notre condition correspond à la question suivante : "a-t-on une valeur pour un input appelé 'id_utilisateurs' ?"
                        */
                        if( empty($_POST['id_utilisateurs']) == FALSE ){

                            // Si la condition est respectée, on va chercher l'enregistrement correspondant à cet id dans la base de données.
                            
                            // On commence par créer une variable $id_utilisateurs contenant cette valeur
                            $id_utilisateurs = $_POST['id_utilisateurs'];


                            // Préparation de la requête pour récupérer l'enregistrement
                            // Il est important de noter le ":id_utilisateurs", cela correspond à une valeur qu'on va insérer dans la requête par la suite.
                            $requete = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID=:id_utilisateurs');
                            

                            // On exécute la requête en lui passant la variable contenant l'id à chercher. Cette valeur sera insérée à la place de :id_utilisateurs dans la requête
                            /*
                                Il est à noter qu'on peut faire la même chose avec plusieurs valeurs. Exemple : 
                                $requete = $bdd->prepare('SELECT * FROM articles WHERE id=:valeur1 AND nom=:valeur2 ');
                                $requete->execute(['valeur1' => $variable1, 'valeur2' => $variable2]);
                            */
                            $requete->execute(['id_utilisateurs' => $id_utilisateurs]);


                            // On place le résultat dans la variable $donnees
                            $donnees = $requete->fetch();


                            // On crée les variables contenant les valeurs de l'enregistrement récupéré, de cette manière nous pourrons les utiliser comme valeurs par défaut dans le formulaire.
                            $Nom = $donnees['Nom'];
                            $Prenom = $donnees['Prenom'];
                            $Code_Bureau = $donnees['Code_Bureau'];
                            $Nom_Services = $donnees['Nom_Services'];

                            $requete->closeCursor();
                        }
                        else{
                            // Dans le cas où aucun formulaire n'a été envoyé pour le chargement de la page (ce qui arrive tant qu'on n'a sélectionné aucun article dans la liste déroulante) 
                            // on crée tout de même les variables sans mettre de valeur (chaine de caractère vide) car elles sont utilisées dans le formulaire ci-dessous et il y aura une erreur si elles sont appelées sans exister. 
                            $Nom = '';
                            $Prenom = '';
                            $Code_Bureau = '';
                            $Nom_Services = '';
                            $id_utilisateurs = '';                          
                        }
                        
                    ?>

                    <!-- Ouverture de la balise de formulaire -->
                    <form action="../actions/modification_utilisateurs.php" method="POST">
                        
                        <!-- ID de l'article -->
                        <!-- 
                            Cet input est désactivé pour éviter la modification grâce à l'attribut "readonly", en effet on ne souhaite en aucun cas modifier l'id !! 
                            Il est présent à titre informatif.
                            On reNom également l'attribut "value" qui permet d'indiquer une valeur par défaut, cette valeur par défaut correspond aux variables créées ci-dessus.
                        -->
                        <div class="form-group">
                            <label for="id">Id de l'utilisateur</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $id_utilisateurs; ?>" readonly>
                        </div>

                        <!-- Nom de l'article -->
                        <div class="form-group">
                            <label for="Nom">Nom</label>
                            <input type="text" class="form-control" id="Nom" name="Nom" value="<?php echo $Nom; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Prenom">Prenom</label>
                            <input type="text" class="form-control" id="Prenom" name="Prenom" value="<?php echo $Prenom; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Code_Bureau">Code de Bureau</label>
                            <input type="text" class="form-control" id="Code_Bureau" name="Code_Bureau" value="<?php echo $Code_Bureau; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Nom_Services">Nom du Service</label>
                            <input type="text" class="form-control" id="Nom_Services" name="Nom_Services" value="<?php echo $Nom_Services; ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier l'utilisateur</button>
                    </form>
                </div>
            </div>

        </div>

    </body>
</html>