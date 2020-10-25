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
     if( empty($_POST['Code_Bureau']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_localisation.php');
        exit;
    }
    else{
        $Code_Bureau = $_POST['Code_Bureau'];
    };
    if( empty($_POST['Batiment']) ){
        header('Location: ../pages/formulaire_modification_localisation.php');
        exit;
    }
    else{
        // Sinon si $_POST['nom'] n'est pas vide, on met la valeur dans la variable $nom et on continue.
        $Batiment = $_POST['Batiment'];
    };
    
    if( empty($_POST['Etage']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_localisation.php');
        exit;
    }
    else{
        $Etage = $_POST['Etage'];
    };

    if( empty( $_POST['Bureau'] ) ){
         // header est utilisé pour rediriger sur une page. 
         header('Location: ../pages/formulaire_modification_localisation.php');
         exit;
    }else{
        // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
        $Bureau = $_POST['Bureau'];
    }
    

    // Préparation de la requête
    $requete = $bdd->prepare('UPDATE localisation SET Batiment=:Batiment, Etage=:Etage, Bureau=:Bureau WHERE Code_Bureau=:Code_Bureau');
    
    // Exécution de la requête
    $resultat = $requete->execute([ 
        'Code_Bureau' => $Code_Bureau, 
        'Batiment' => $Batiment, 
        'Etage' => $Etage, 
        'Bureau' => $Bureau, 
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête
    if (!$resultat) {
        die("Echec de la modification");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/liste_localisation.php');
    exit;

?>