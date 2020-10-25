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

    if( empty($_POST['Nom']) ){
        header('Location: ../pages/formulaire_ajout_services.php');
        exit;
    }
    else{
        // Sinon si $_POST['nom'] n'est pas vide, on met la valeur dans la variable $nom et on continue.
        $Nom = $_POST['Nom'];
    };
    


    // Insertion du message à l'aide d'une requête préparée
    // Il est important de noter les ":nom", etc...
    // Cela correspond aux valeurs qu'on va insérer dans la requête ci-après.
    $requete = $bdd->prepare('INSERT INTO services(Nom) VALUES (:Nom)');
    
    // On exécute la requête en associant les variables aux emplacements définis précédemment par les ":" dans la requête
    $resultat = $requete->execute([ 
        'Nom' => $Nom,
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête, sinon on continue
    if (!$resultat) {
        die("Echec de l'enregistrement");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/Liste_services.php');
    exit;
?>