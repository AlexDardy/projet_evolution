<?php

    // Décommenter la ligne ci-dessous pour voir le contenu de $_POST à l'envoi du formulaire (utile pour le debuggage par exemple)
    // die(var_dump($_POST));

    // Connexion à la base de données
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=pc;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
     if( empty($_POST['id']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification.php');
        exit;
    }
    else{
        $id = $_POST['id'];
    };
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

    // Préparation de la requête
    $requete = $bdd->prepare('UPDATE ordinateurs SET NumeroDeSerie=:NumeroDeSerie, ModeleDePc=:ModeleDePc, Marque=:Marque, Prix=:Prix, DateAchat=:DateAchat WHERE id=:id');
    
    // Exécution de la requête
    $resultat = $requete->execute([ 
        'NumeroDeSerie' => $NumeroSerie, 
        'ModeleDePc' => $ModelePc, 
        'Marque' => $Marque, 
        'Prix' => $Prix, 
        'DateAchat' => $DateAchat, 
        'id' => $id,
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête
    if (!$resultat) {
        die("Echec de la modification");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/liste.php');
    exit;

?>