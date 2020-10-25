<!DOCTYPE html>
<html>

    <!-- 
        Ceci est un commentaire HTML. Il ne sera pas traité par le navigateur et non affiché sur la page. 
        Vous pouvez l'écrire sur une ou plusieurs lignes.
        Les commentaires sont utiles pour mettre des annotations pour les développeurs par exemple.
        A la fin du commentaire, n'oubliez pas de clôturer avec les caractères suivants 
    -->

    <!-- 
        La balise <head></head> contient les informations nécessaires au navigateur pour interpréter la page, 
        c'est aussi là que l'on va mettre le titre du site et généralement les liens vers des ressources externes à la page (feuille de style CSS par exemple). 
    -->
    <head>
        <!-- Les balises <meta> sont utilisées pour donner des informations au navigateur, notamment sur l'encodage utilisé sur la page -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <!-- La balise <title></title> contient le titre de la page, ce titre sera affiché sur l'onglet du navigateur -->
        <title>Application WEB</title>

        <!-- La balise ci-dessous est utilisée pour permettre à la page de s'adapter correctement à la taille de l'écran -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- 
            Les balises "link" permettent par exemple d'indiquer un lien vers un fichier .css qui sera utilisé pour styliser la page 
            Ci-dessous nous allons utiliser le framework CSS "Bootstrap" Ce framework est un cadre mettant à disposition des développeurs un ensemble d'outils pour simplifier la mise en page des pages web. 
            Il met notamment à disposition des styles préexistants ainsi qu'une façon de gérer les différentes taille d'écran (PC bureau, tablette, portable)    
            Plus d'informations sur https://getbootstrap.com/
        -->        
        <?php
       include 'theme.php'
       ?>
    </head>

    <!-- Le code qui permettra d'afficher des données sur la page doit être à l'intérieur des balises <body></body> -->
    <body>

        <!-- 
            Les balises <div></div> sont la base de la structure d'une page web. Chaque div représente un bloc qui contient de l'information.
            Les classes "container", "row" et "col-..." font partie du framework Bootstrap. 
        -->
        
        <!-- 
            Les classes (attribut "class") permettent d'associer des mots-clefs aux balises ce qui va permettre notamment de leur attribuer un style visuel ou un comportement spécifique avec Javascript.
            L'attribut "id" fonctionne de la même manière à la différence qu'une seule balise peut avoir un id donné sur une page.
            Plusieurs balises peuvent donc partager les mêmes classes, contrairement aux id qui permettent d'identifier une balise unique. 
        -->

        <!-- 
            Ci-dessous la barre de navigation. Nous mettons en forme cette barre grâce à des classes fournies par Bootstrap.
            Il n'est pas nécessaire de comprendre le fonctionnement de chaque classe, vous pouvez simplement les utiliser telles quelles pour obtenir la mise en page et le comportement souhaité.
            Vous trouverez plus de renseignement sur https://getbootstrap.com/
         -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
            <a class="navbar-brand" href="index.php">Cours</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    
                    <!-- Page index.php, représente la page d'accueil de notre site. Nous avons choisi d'y mettre le sommaire. -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Sommaire</a>
                    </li>

                    <!-- La mise en forme d'une page -->
                    <li class="nav-item active">
                        <a class="nav-link" href="mise_en_forme.php">Mettre en forme</a>
                    </li>

                    <!-- Afficher des données de la base -->
                    <li class="nav-item">
                        <a class="nav-link" href="liste.php">Afficher</a>
                    </li>

                    <!-- Envoyer des données avec les formulaires -->
                    <li class="nav-item">
                        <a class="nav-link" href="formulaire_ajout.php">Ajouter</a>
                    </li>

                    <!-- Modifier des données avec les formulaires -->
                    <li class="nav-item">
                        <a class="nav-link" href="formulaire_modification.php">Modifier</a>
                    </li>

                    <!-- Supprimer des données avec les formulaires -->
                    <li class="nav-item">
                        <a class="nav-link" href="formulaire_suppression.php">Supprimer</a>
                    </li>
                    
                </ul>
            </div>
        </nav>

        <!-- 
            Spécificité BOOTSTRAP :
            Le corps de la page est situé dans une <div> à laquelle on attribue la classe "container".

            A l'intérieur de cette <div>, nous allons mettre une succession de <div> portant la classe "row" (qui signifie "ligne"). Chaque "row" représente un bloc dans notre page.
            A l'intérieur de ces "row", on va ajouter une div portant la classe "col-lg" qui signifie "affiche une colonne sur large écran".

            La combinaison de ces classes fournies par Boostrap permet de gérer l'adaptation automatique de la page à la taille de l'écran.

            Pour une mise en forme simple vous pouvez garder cette structure telle que présentée ci-dessous. 
            Si vous souhaitez avoir une mise en page plus complexe, avec un affichage sur plusieurs colonnes par exemple, rendez-vous sur https://getbootstrap.com/docs/4.4/layout/grid/ pour en apprendre davantage sur le système de grille fourni par Boostrap.
         -->
        <div class="container">
            <div class="row">
                <div class="col-lg">

                    <hr>

                    <div class="alert alert-info" role="alert">
                        Ouvrez cette page (mise_en_forme.php) dans un éditeur de texte pour avoir des renseignements sur la façon dont les éléments sont créés. 
                    </div>

                    <!-- 
                        Ci-dessous un exemple simple : 
                        - une balise <h1></h1> contenant un titre de 1er niveau
                        - une balise <p></p> contenant un paragraphe de texte.
                        - Au sein du paragraphe, les retours à la ligne se font grace à la balise <br>. Il est à noter que cette balise fait partie des exceptions de balises qui ne se ferment pas.

                        Les caractères &lt; et &gt; permettent d'afficher des < > sans que le navigateur n'interprète ça comme une balise.
                     -->
                    <h1>Titre de 1er niveau écrit avec la balise h1</h1>

                    <p>
                        Les retours à la ligne dans le fichiers ne sont pas pris en compte dans l'affichage de la page.





                        En observant le fichier mise_en_forme.php vous constaterez que 5 lignes ont été sautées entre cette phrase et la précédente, pourtant les 2 se suivent sur le navigateur.                     
                        
                        <br>
                        Pour revenir à la ligne et en sauter, il faut utiliser la balise &lt;br&gt;.
                        <br>
                        <br>
                        Le texte va automatiquement utiliser toute la largeur délimitée par le bloc dans lequel il se trouve. Exemple : 
                        <br>
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dapibus posuere justo, quis consectetur sapien mattis pretium. Phasellus id euismod tellus. Donec dapibus est id turpis imperdiet cursus. Aliquam facilisis quam nec rhoncus dictum. Sed sit amet elementum lacus. Cras cursus, libero vel ullamcorper ultrices, tellus odio venenatis nunc, sed auctor felis nibh vitae neque. Cras nec elementum ante. Nullam in urna lacinia, cursus felis sagittis, consectetur lacus. 
                        <br>
                        Mauris lobortis a velit sit amet pretium. Morbi auctor eget libero rutrum luctus. Nulla facilisi. Praesent ultrices sapien aliquam, sodales dui ac, elementum purus. In mollis pellentesque quam tempor rhoncus. Duis nunc orci, varius eget elementum eget, tempus ut nisi. Vestibulum condimentum neque eget est fringilla ornare. Aenean id nulla sit amet diam tristique suscipit vel vitae ligula. Nullam euismod eget leo ut consequat. Phasellus elementum diam eu elit rutrum, in malesuada mi dictum. Aliquam erat volutpat. 
                    </p>

                    <hr>

                    <h1>Les tableaux</h1>

                    <p>
                        Les tableaux permettent d'afficher des données mises en forme en colonnes et lignes. 
                        <br>
                        Par défaut un tableau HTML ne contient pas d'espaces ni de bordures. Pour le mettre en forme il faut utiliser du CSS (non abordé dans ce cours).
                        <br>
                        
                        <!-- 
                            La balise <h2></h2> représente un titre de niveau 2. On pourra faire de la même manière des titres de niveau 3, 4, etc...
                         -->
                        <h2>Exemple de tableau sans mise en forme : </h2>

                        <!-- 
                            En HTML, un tableau se fait grâce à la balise <table></table>. Vous verrez ci-dessous une structure simple de tableau.
                            La première partie <thead></thead> représente l'en-tête, la partie <tbody></tbody> représente le corps du tableau.
                            Le découpage se fait ensuite en lignes avec les balises <tr></tr> 
                            puis chacune des lignes se découpe en colonnes avec les balises <td></td> (ou bien <th></th> pour l'en-tête).
                         -->
                        <table>
                            <thead>
                                <tr>
                                    <th>En-tête 1</th>
                                    <th>En-tête 2</th>
                                    <th>En-tête 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ligne 1 colonne 1</td>
                                    <td>ligne 1 colonne 2</td>
                                    <td>ligne 1 colonne 3</td>
                                </tr>
                                <tr>
                                    <td>ligne 2 colonne 1</td>
                                    <td>ligne 2 colonne 2</td>
                                    <td>ligne 2 colonne 3</td>
                                </tr>
                                <tr>
                                    <td>ligne 3 colonne 1</td>
                                    <td>ligne 3 colonne 2</td>
                                    <td>ligne 3 colonne 3</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>

                        <!-- 
                            Ci-dessous on ajoute des classes fournies par Boostrap pour améliorer la mise en page du tableau facilement :
                            - la classe "table" va ajouter des espacements et des séparations aux lignes et colonnes pour le rendre plus lisible.
                            - la classe "table-bordered" va ajouter des bordures du tableau.
                            - la classe "table-striped" va colorer une ligne sur 2 du tableau.

                            N'hésitez pas à essayer d'enlever chacune des classes séparément puis d'actualiser la page pour voir le résultat en direct !
                         -->
                        <h2>Exemple à l'aide des classes fournies par Bootstrap : </h2>
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>En-tête 1</th>
                                    <th>En-tête 2</th>
                                    <th>En-tête 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ligne 1 colonne 1</td>
                                    <td>ligne 1 colonne 2</td>
                                    <td>ligne 1 colonne 3</td>
                                </tr>
                                <tr>
                                    <td>ligne 2 colonne 1</td>
                                    <td>ligne 2 colonne 2</td>
                                    <td>ligne 2 colonne 3</td>
                                </tr>
                                <tr>
                                    <td>ligne 3 colonne 1</td>
                                    <td>ligne 3 colonne 2</td>
                                    <td>ligne 3 colonne 3</td>
                                </tr>
                            </tbody>
                        </table>
                    <p>

                    <!-- 
                        Plus de renseignements sur les tableaux :
                        https://developer.mozilla.org/fr/docs/Web/HTML/Element/table
                        https://www.w3schools.com/html/html_tables.asp

                        Et pour la mise en page des tableaux avec Bootstrap :
                        https://getbootstrap.com/docs/4.0/content/tables/
                     -->


                    <hr>

                    <h1>Les liens</h1>

                    <!-- 
                        La balise <a></a> représente un lien vers une autre page.
                        Le chemin de l'autre page est indiquée dans l'attribut "href" (attribut obligatoire pour faire fonctionner la balise).

                        Attention ! Le chemin doit être indiqué à partir de l'emplacement de cette page, pour remonter d'un niveau dans les dossiers il faudra donc utilise "../" en début de chemin.
                    -->
                    Exemple de lien vers une page du même site : <a href="index.php">Index du site</a>
                    <br>
                    Exemple de lien vers une page externe au site : <a href="https://getbootstrap.com/docs/4.5/getting-started/introduction/">Documentation bootstrap</a>

                    <hr>

                    <h1>Les listes</h1>

                    <!-- 
                        Les balises <ul> et <li> permettent de faire des listes (ul signifie "unordered list", ou "liste non ordonnée"). 
                        L'ouverture de <ul> indique le début de la liste et </ul> la fin.
                        Chaque élément de la liste se trouve entre l'ouverture et la fermeture de <ul> et est représenté dans une balise <li></li>

                        A l'intérieur des <li></li>, on peut mettre du texte, des liens,...
                    -->
                    <p>
                        Exemple de liste non ordonnée (tirets) :
                        <br>
                        
                        <ul>
                            <li>Premier point (texte)</li>
                            <li>
                                <a href="index.php">Deuxième point (lien)</a>
                            </li>
                            <li>
                                Troisième point (texte)
                            </li>
                        </ul>
                    </p>
                    
                    <!-- 
                        En remplaçant ul par ol, on crée à la place une "liste ordonnée" (ordered list), cela signifie que les éléments seront numérotés.
                     -->
                    <p>
                        Exemple de liste ordonnée (numéros) :
                        <br>
                        
                        <ol>
                            <li>Premier point</li>
                            <li>Deuxième point</li>
                            <li>Troisième point</li>
                        </ol>
                    </p>
                </div>
            </div>
        </div>

    </body>
</html>