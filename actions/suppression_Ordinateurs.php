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


    /* 
        Création de la variable $id
    */
    if( empty($_POST['id_ordinateurs']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_suppression_ordinateurs.php');
        exit;
    }
    else{
        $id = $_POST['id_ordinateurs'];
    };


    // Préparation de la requête
    $requete = $bdd->prepare('DELETE FROM ordinateurs WHERE ID=:id');
    
    // Exécution de la requête
    $resultat = $requete->execute([ 
        'id' => $id,
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête
    if (!$resultat) {
        die("Echec de la suppression");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/liste_ordinateurs.php');
    exit;

?>