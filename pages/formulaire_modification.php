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
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
            <a class="navbar-brand" href="index.php">Cours</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Sommaire</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="mise_en_forme.php">Mettre en forme</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="liste.php">Afficher</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="formulaire_ajout.php">Ajouter</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="formulaire_suppression.php">Supprimer</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="formulaire_modification.php">Modifier</a>
                    </li>
                    
                </ul>
            </div>
        </nav>

        <!-- 
            Connexion à la base de données
         -->
        <?php 
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=pc;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch(Exception $e)
            {
                    die('Erreur : '.$e->getMessage());
            }
        ?>

        <div class="container">

            <div class="row">
                <div class="col-lg">

                    <hr>

                    <div class="alert alert-info" role="alert">
                        Ouvrez cette page (formulaire_modification.php) dans un éditeur de texte pour avoir plus de renseignements sur la modification d'enregistrements. 
                    </div>

                    <h1>Modifier des enregistrements</h1>

                    <p>
                        Nous allons voir ci-dessous comment modifier un enregistrement. Nous allons suivre la procédure suivante :
                    </p>
                    <ol>
                        <li>On crée un 1er formulaire contenant une liste déroulante des articles pour choisir celui à modifier.</li>
                        <li>On met un bouton pour valider ce choix et ainsi être redirigé vers cette même page avec l'id de l'article à modifier.</li>
                        <li>Le formulaire de modification est le même que celui de création mais on préremplit les valeurs en récupérant l'article grâce à son id.</li>
                        <li>Lorsque le formulaire de modification est envoyé, on met à jour l'enregistrement dans la table.</li>
                        <li>Une fois le traitement terminé, on redirige vers la liste des articles.</li>
                    </ol>

                    <!-- 
                        Ouverture du formulaire, dans "action" on met cette même page pour revenir dessus une fois le formulaire envoyé.
                     -->
                    <form action="formulaire_modification.php" method="post">

                        <!-- Input liste déroulante -->
                        <div class="form-group">
                            <label for="id_ordinateur">Choix de l'article à modifier</label>
                            <select id="id_ordinateur" class="form-control" name="id_ordinateur">
                                <option value='' selected>Choisir...</option>
                                
                                <?php 

                                    // Récupérer des données : on prépare la requête et on la met dans la variable $requete...
                                    $requete = $bdd->prepare('SELECT * FROM ordinateurs');
                                    // ...puis on l'exécute
                                    $requete->execute();

                                    while( $donnees = $requete->fetch() )
                                    {
                                ?>

                                    <option value='<?php echo $donnees['ID']; ?>'>
                                        <?php echo $donnees['NumeroDeSerie']; ?>
                                    </option>

                                <?php 
                                    }

                                    $requete->closeCursor();
                                ?>

                            </select>
                        </div>


                        <!-- Bouton d'envoi du formulaire -->
                        <button type="submit" class="btn btn-primary">Choisir l'ordinateur</button>
                    </form>

                    <hr>

                    <h1>Formulaire de modification</h1>

                    <?php 

                        /* 
                            On définit les valeurs qui seront utilisées ci-dessous dans le formulaire.
                            
                            Deux possibilités :
                            1) Aucun article n'a été choisi et donc $_POST est vide, le formulaire ne sera donc pas rempli.
                            2) Un article a été choisi et on a donc $_POST['id_ordinateur'] contenant l'id de l'article, on va pouvoir récupérer l'enregistrement correspondant dans la base de données pour préremplir le formulaire.

                            Pour info, 'id_ordinateur' correspond à l'attribut "name" de la liste déroulante.
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
                            Ci-dessous, on va avoir la condition suivante : empty( $_POST['id_ordinateur'] ) == FALSE
                            
                            Si on la décompose cela donne :
                            $_POST['id_ordinateur'] correspond à la valeur de l'input "id_ordinateur" qui a été envoyée par un formulaire au chargement de la page. Si aucun input ne correspond à ce nom, alors $_POST['id_ordinateur'] sera vide, dans le cas contraire il contiendra la valeur de l'input.
                            empty() est une fonction PHP qui permet de vérifier si la variable qu'on met entre parenthèses est vide ou non. Si la variable est vide, la fonction retourne la valeur TRUE, sinon FALSE.
                            empty( $_POST['id_ordinateur] ) signifie donc qu'on va avoir TRUE si $_POST['id_ordinateur'] est vide ou FALSE s'il contient une valeur.
                            == permet de dire "est-il égal à... ?" dans notre cas, cela donne "la fonction empty() retourne-t-elle la valeur FALSE ?". Il est indispensable de mettre 2 fois le symbole == dans ce cas de figure.

                            Pour résumer, notre condition correspond à la question suivante : "a-t-on une valeur pour un input appelé 'id_ordinateur' ?"
                        */
                        if( empty($_POST['id_ordinateur']) == FALSE ){

                            // Si la condition est respectée, on va chercher l'enregistrement correspondant à cet id dans la base de données.
                            
                            // On commence par créer une variable $id_ordinateur contenant cette valeur
                            $id_ordinateur = $_POST['id_ordinateur'];


                            // Préparation de la requête pour récupérer l'enregistrement
                            // Il est important de noter le ":id_ordinateur", cela correspond à une valeur qu'on va insérer dans la requête par la suite.
                            $requete = $bdd->prepare('SELECT * FROM ordinateurs WHERE ID=:id_ordinateur');
                            

                            // On exécute la requête en lui passant la variable contenant l'id à chercher. Cette valeur sera insérée à la place de :id_ordinateur dans la requête
                            /*
                                Il est à noter qu'on peut faire la même chose avec plusieurs valeurs. Exemple : 
                                $requete = $bdd->prepare('SELECT * FROM articles WHERE id=:valeur1 AND nom=:valeur2 ');
                                $requete->execute(['valeur1' => $variable1, 'valeur2' => $variable2]);
                            */
                            $requete->execute(['id_ordinateur' => $id_ordinateur]);


                            // On place le résultat dans la variable $donnees
                            $donnees = $requete->fetch();


                            // On crée les variables contenant les valeurs de l'enregistrement récupéré, de cette manière nous pourrons les utiliser comme valeurs par défaut dans le formulaire.
                            $NumeroSerie = $donnees['NumeroDeSerie'];
                            $ModelePc = $donnees['ModeleDePc'];
                            $Marque = $donnees['Marque'];
                            $Prix = $donnees['Prix'];
                            $DateAchat = $donnees['DateAchat'];

                            $requete->closeCursor();
                        }
                        else{
                            // Dans le cas où aucun formulaire n'a été envoyé pour le chargement de la page (ce qui arrive tant qu'on n'a sélectionné aucun article dans la liste déroulante) 
                            // on crée tout de même les variables sans mettre de valeur (chaine de caractère vide) car elles sont utilisées dans le formulaire ci-dessous et il y aura une erreur si elles sont appelées sans exister. 
                            $NumeroSerie = '';
                            $ModelePc = '';
                            $Marque = '';
                            $Prix = '';
                            $DateAchat = '';
                            $id_ordinateur = '';                          
                        }
                        
                    ?>

                    <!-- Ouverture de la balise de formulaire -->
                    <form action="../actions/modification.php" method="POST">
                        
                        <!-- ID de l'article -->
                        <!-- 
                            Cet input est désactivé pour éviter la modification grâce à l'attribut "readonly", en effet on ne souhaite en aucun cas modifier l'id !! 
                            Il est présent à titre informatif.
                            On remarque également l'attribut "value" qui permet d'indiquer une valeur par défaut, cette valeur par défaut correspond aux variables créées ci-dessus.
                        -->
                        <div class="form-group">
                            <label for="id">Id de l'ordinateur</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $id_ordinateur; ?>" readonly>
                        </div>

                        <!-- Nom de l'article -->
                        <div class="form-group">
                            <label for="NumeroSerie">Numéro de série</label>
                            <input type="text" class="form-control" id="NumeroSerie" name="NumeroSerie" value="<?php echo $NumeroSerie; ?>">
                        </div>

                        <div class="form-group">
                            <label for="ModelePc">Modèle de Pc</label>
                            <input type="text" class="form-control" id="ModelePc" name="ModelePc" value="<?php echo $ModelePc; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Marque">Marque</label>
                            <input type="text" class="form-control" id="Marque" name="Marque" value="<?php echo $Marque; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Prix">Prix</label>
                            <input type="text" class="form-control" id="Prix" name="Prix" value="<?php echo $Prix; ?>">
                        </div>

                        <div class="form-group">
                            <label for="DateAchat">Date d'achat</label>
                            <input type="date" class="form-control" id="DateAchat" name="DateAchat" value="<?php echo $DateAchat; ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier l'ordinateur</button>
                    </form>
                </div>
            </div>

        </div>

    </body>
</html>