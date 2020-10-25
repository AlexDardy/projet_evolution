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


        <div class="container">

            <div class="row">
                <div class="col-lg">

                    <hr>

                    <div class="alert alert-info" role="alert">
                        Ouvrez cette page (formulaire_ajout.php) dans un éditeur de texte pour avoir des renseignements sur la création de formulaire. 
                    </div>

                    <h1>Formulaires</h1>

                    <p>
                        Les formulaires sont couramment utilisés sur tous types de sites web et applications. Ils permettent aux utilisateurs d'entrer des données qui pourront être traitées et/ou enregistrées en base de données.
                        <br>
                        Différents types de champs (nommés "input") existent suivant la manière d'entrer des données (texte, case à cocher, liste déroulante, etc.). Vous trouverez ci-dessous plusieurs exemples.
                    </p>

                    <!-- 
                        La balise <form></form> permet d'inclure un formulaire. 
                        Ce formulaire permet à un utilisateur de saisir des données qui pourront être traitées par le site.
                        Cela peut être aussi bien la création d'enregistrement, la modification, etc.
                        
                        A l'intérieur de la balise <form></form> nous allons intégrer des champs de formulaire avec la balise <input>, ce sont ces balises qui permettront à l'utilisateur de saisir des données.
                        La balise <form></form> contient 2 attributs, "action" et "method", que nous verrons plus en détail dans l'exemple ci-après. Ces attributs servent à déterminer le comportement du formulaire lorsqu'il est envoyé. 
                    -->
                    <form action="#" method="post">

                        <!-- 
                            La balise <input> représente des champs de formulaire.
                            Ci-dessous vous retrouverez différents types de champs de formulaire : 
                            - Texte
                            - Checkbox (case à cocher)
                            - Bouton radio
                            - Liste déroulante 
                            - Bouton submit (pour envoyer le formulaire)

                            La seule balise indispensable est <input>, la balise <label></label> est fortement conseillé car il s'agit de l'intitulé du champ de formulaire.
                            Les balises <div> et les classes servent à la mise en forme du formulaire.

                            Vous pouvez les réutiliser tels quels (en modifiant les attributs "id" et "name" pour qu'ils correspondent à ce qu'ils représentent)
                        -->


                        <!-- Input texte -->
                        <!-- 
                            Les champs de type "text" sont les plus courants, ils permettent d'entrer des chaines de caractères (string). 
                            Dans une balise input, il est nécessaire d'ajouter un attribut "name" qui va permettre d'identifier l'input. 
                            Ce nom sera utilisé lors du traitement du formulaire.
                        -->
                        <div class="form-group">
                            <label for="exemple_texte">Texte</label>
                            <input type="text" class="form-control" name="exemple_texte" id="exemple_texte" aria-describedby="exemple_aide_texte">
                            <small id="exemple_aide_texte" class="form-text text-muted">Exemple de message d'aide.</small>
                        </div>


                        <!-- Input password -->
                        <!-- 
                            Variante du type texte, le type "password" permet de cacher le texte saisi pour éviter les regards indiscrets.  
                        -->
                        <div class="form-group">
                            <label for="exemple_password">Mot de passe</label>
                            <input type="password" class="form-control" id="exemple_password" name="exemple_password">
                        </div>


                        <!-- Input checkbox -->
                        <!-- 
                            Les cases à cocher sont très pratiques pour les champs de type "booleen" (vrai ou faux).  
                            Une checkbox est utile pour limiter le choix des utilisateurs dans la saisie, on peut cocher aucun, plusieurs ou toutes les cases.
                        -->
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="exampleCheck" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Option 1</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="exampleCheck" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2">Option 2</label>
                        </div>


                        <!-- Input bouton radio -->
                        <!-- 
                            A la différente ces cases à cocher, les boutons radio ne permettent qu'un seul choix parmi une liste définie.
                        -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Option 1 radio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                Option 2 radio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                            <label class="form-check-label" for="exampleRadios3">
                                Option 3 radio
                            </label>
                        </div>
                        

                        <!-- Input liste déroulante -->
                        <!-- 
                            Les listes déroulantes <select></select> permettent de choisir parmi plusieurs choix prédéterminés. 
                            Bien que les choix puissent être entrés manuellement, ils peuvent également provenir d'une base de données comme nous le verrons par la suite. 
                            Chaque <option></option> représente un choix de la liste déroulante, ce qui est écrit entre ces balises représente le texte visible par l'utilisateur.
                            L'attribut "value" indique la valeur de l'option, c'est à dire ce qui sera envoyé avec le formulaire.
                            L'attribut "selected" indique l'option saisie par défaut lorsque la page est chargée.
                        -->
                        <div class="form-group">
                            <label for="exampleSelect">Liste déroulante</label>
                            <select id="exampleSelect" name="exampleSelect" class="form-control">
                                <option value='' selected>Choisir</option>
                                <option value='choix_1'>choix 1</option>
                                <option value='choix_2'>choix 2</option>
                                <option value='choix_3'>choix 3</option>
                            </select>
                        </div>


                        <!-- Bouton d'envoi du formulaire -->
                        <!-- 
                            Le bouton "submit" permet d'envoyer les données du formulaire pour les traiter. 
                            Les données sont envoyées au lien situé dans l'attribut "action" de la balise <form></form>.
                            Elles pourront être récupérées par la suite grâce à la variable $_POST qui est une variable globale, c'est à dire qu'elle est générée automatiquement par PHP et peut être appelée n'importe quand (qu'il y ait quelque chose dedans ou non).
                        -->
                        <button type="submit" class="btn btn-primary">Envoi du formulaire</button>
                    </form>

                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-lg-12">
                    <h1>Formulaire d'ajout d'ordinateurs</h1>

                    <p>
                        Le formulaire ci-dessous va permettre d'ajouter un ordinateur dans la table des ordinateurs. 
                    </p>

                    <!-- Ouverture de la balise de formulaire -->
                    <!-- 
                        La balise <form></form> est très importante car c'est à cet endroit que l'on va indiquer le fichier sur lequel se rendre lorsque l'on valide le formulaire.
                        Dans cet exemple ci-dessous, en validant le formulaire nous serons redirigés vers "ajout.php", c'est dans ce fichier que les informations saisies sur le formulaire seront traitées.
                        L'attribut "method" est nécessaire pour déterminer la façon dont les données seront envoyées, vous pouvez l'utiliser tel quel.
                    -->
                    <form action="../actions/ajout.php" method="POST">
                        
                        <!-- Nom de l'article -->
                        <div class="form-group">
                            <label for="NumeroSerie">Numéro de Serie</label>
                            <input type="text" class="form-control" id="NumeroSerie" name="NumeroSerie">
                        </div>

                        <div class="form-group">
                            <label for="ModelePc">Modèle de Pc</label>
                            <input type="text" class="form-control" id="ModelePc" name="ModelePc">
                        </div>

                        <div class="form-group">
                            <label for="Marque">Marque</label>
                            <input type="text" class="form-control" id="Marque" name="Marque">
                        </div>

                        <div class="form-group">
                            <label for="Prix">Prix</label>
                            <input type="text" class="form-control" id="Prix" name="Prix">
                        </div>

                        <div class="form-group">
                            <label for="DateAchat">Date d'achat</label>
                            <input type="date" class="form-control" id="DateAchat" name="DateAchat">
                        </div>

                        <!-- Bouton d'envoi du formulaire -->
                        <button type="submit" class="btn btn-success">Ajouter l'ordinateur</button>
                    </form>
                </div>
            </div>

        </div>

    </body>
</html>