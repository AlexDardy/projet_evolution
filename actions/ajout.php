<?php

    // Connexion à la base de données
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=pc;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

    if( empty($_POST['NumeroSerie']) ){
        header('Location: ../pages/formulaire_ajout.php');
        exit;
    }
    else{
        // Sinon si $_POST['nom'] n'est pas vide, on met la valeur dans la variable $nom et on continue.
        $NumeroSerie = $_POST['NumeroSerie'];
    };
    
    if( empty($_POST['ModelePc']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_ajout.php');
        exit;
    }
    else{
        $ModelePc = $_POST['ModelePc'];
    };

    if( empty( $_POST['Marque'] ) ){
         // header est utilisé pour rediriger sur une page. 
         header('Location: ../pages/formulaire_ajout.php');
         exit;
    }else{
        // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
        $Marque = $_POST['Marque'];
    }

    if( is_numeric( $_POST['Prix'] ) ){
        // La valeur est numérique, on la met dans la variable $prix_ht
        $Prix = $_POST['Prix'];
    }else{
        // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
        $Prix = 0;
    }
    if( empty( $_POST['DateAchat'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_ajout.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $DateAchat = $_POST['DateAchat'];
   }

    // Insertion du message à l'aide d'une requête préparée
    // Il est important de noter les ":nom", etc...
    // Cela correspond aux valeurs qu'on va insérer dans la requête ci-après.
    $requete = $bdd->prepare('INSERT INTO ordinateurs(NumeroDeSerie, ModeleDePc, Marque, Prix, DateAchat) VALUES(:NumeroDeSerie, :ModeleDePc, :Marque, :Prix, :DateAchat)');
    
    // On exécute la requête en associant les variables aux emplacements définis précédemment par les ":" dans la requête
    $resultat = $requete->execute([ 
        'NumeroDeSerie' => $NumeroSerie, 
        'ModeleDePc' => $ModelePc, 
        'Marque' => $Marque, 
        'Prix' => $Prix, 
        'DateAchat' => $DateAchat 
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête, sinon on continue
    if (!$resultat) {
        die("Echec de l'enregistrement");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/liste.php');
    exit;
?>