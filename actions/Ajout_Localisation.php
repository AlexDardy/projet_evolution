<?php

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
        header('Location: ../pages/formulaire_ajout_localisation.php');
        exit;
    }
    else{
        // Sinon si $_POST['nom'] n'est pas vide, on met la valeur dans la variable $nom et on continue.
        $Code_Bureau = $_POST['Code_Bureau'];
    };
    
    if( empty($_POST['Batiment']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_ajout_localisation.php');
        exit;
    }
    else{
        $Batiment = $_POST['Batiment'];
    };

    if( empty( $_POST['Etage'] ) ){
         // header est utilisé pour rediriger sur une page. 
         header('Location: ../pages/formulaire_ajout_localisation.php');
         exit;
    }else{
        // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
        $Etage = $_POST['Etage'];

    }
    if( empty( $_POST['Bureau'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_ajout_localisation.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $Bureau = $_POST['Bureau'];
   }



    // Insertion du message à l'aide d'une requête préparée
    // Il est important de noter les ":nom", etc...
    // Cela correspond aux valeurs qu'on va insérer dans la requête ci-après.
    $requete = $bdd->prepare('INSERT INTO localisation(Code_Bureau, Batiment, Etage, Bureau) VALUES (:Code_Bureau, :Batiment, :Etage, :Bureau)');
    
    // On exécute la requête en associant les variables aux emplacements définis précédemment par les ":" dans la requête
    $resultat = $requete->execute([ 
        'Code_Bureau' => $Code_Bureau, 
        'Batiment' => $Batiment, 
        'Etage' => $Etage, 
        'Bureau' => $Bureau,
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête, sinon on continue
    if (!$resultat) {
        die("Echec de l'enregistrement");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/Liste_localisation.php');
    exit;
?>