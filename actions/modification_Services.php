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
    if( empty($_POST['Nom']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_services.php');
        exit;
    }
    else{
        $Nom = $_POST['Nom'];
    };
    if( empty($_POST['Ancien_nom']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_services.php');
        exit;
    }
    else{
        $Ancien_nom = $_POST['Ancien_nom'];
    };
    
    

    // Préparation de la requête
    $requete = $bdd->prepare('UPDATE services SET Nom=:Nom WHERE Nom=:Ancien_nom');
    
    // Exécution de la requête
    $resultat = $requete->execute([ 
        'Nom' => $Nom, 
        'Ancien_nom' => $Ancien_nom,
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête
    if (!$resultat) {
        die("Echec de la modification");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/liste_services.php');
    exit;

?>