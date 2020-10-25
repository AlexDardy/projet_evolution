<?php

    // Décommenter la ligne ci-dessous pour voir le contenu de $_POST à l'envoi du formulaire (utile pour le debuggage par exemple)
    // die(var_dump($_POST));

    // Connexion à la base de données
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=evolution;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
     if( empty($_POST['id']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_map_role.php');
        exit;
    }
    else{
        $id = $_POST['id'];
    };
    if( empty($_POST['Nom']) ){
        header('Location: ../pages/formulaire_modification_map_role.php');
        exit;
    }
    else{
        // Sinon si $_POST['nom'] n'est pas vide, on met la valeur dans la variable $nom et on continue.
        $Nom = $_POST['Nom'];
    };
    

    // Préparation de la requête
    $requete = $bdd->prepare('UPDATE map_role SET Nom=:Nom WHERE id=:id');
    
    // Exécution de la requête
    $resultat = $requete->execute([ 
        'Nom' => $Nom,   
        'id' => $id,
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête
    if (!$resultat) {
        die("Echec de la modification");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/liste_map_role.php');
    exit;

?>