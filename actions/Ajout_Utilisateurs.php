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
        header('Location: ../pages/formulaire_ajout_utilisateurs.php');
        exit;
    }
    else{
        // Sinon si $_POST['nom'] n'est pas vide, on met la valeur dans la variable $nom et on continue.
        $Nom = $_POST['Nom'];
    };
    
    if( empty($_POST['Prenom']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_ajout_utilisateurs.php');
        exit;
    }
    else{
        $Prenom = $_POST['Prenom'];
    };

    if( empty( $_POST['Code_Bureau'] ) ){
         // header est utilisé pour rediriger sur une page. 
         header('Location: ../pages/formulaire_ajout_utilisateurs.php');
         exit;
    }else{
        // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
        $Code_Bureau = $_POST['Code_Bureau'];

    }
    if( empty( $_POST['Nom_Services'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_ajout_utilisateurs.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $Nom_Services = $_POST['Nom_Services'];
   }

   //Génération d'un nouvel ID Ecran incrémenté
   $requete_last_id = $bdd->prepare('SELECT MAX(CAST(SUBSTRING(ID,3, LENGTH(ID)) AS SIGNED)) AS LAST_ID from utilisateurs');
   $requete_last_id->execute();
   $last_id = $requete_last_id->fetch();
   $last_id = $last_id['LAST_ID'];
   $new_id = $last_id + 1;
    if ($new_id < 10) {
        $new_id = "U000".$new_id;
    } elseif ($new_id < 100) {
        $new_id = "U00".$new_id;
    } elseif ($new_id < 999) {
        $new_id = "U0".$new_id;
    } else {
       $new_id = "U".$new_id;
   }


    // Insertion du message à l'aide d'une requête préparée
    // Il est important de noter les ":nom", etc...
    // Cela correspond aux valeurs qu'on va insérer dans la requête ci-après.
    $requete = $bdd->prepare('INSERT INTO utilisateurs(ID, Nom, Prenom, Code_Bureau, Nom_Services) VALUES(:ID, :Nom, :Prenom, :Code_Bureau, :Nom_Services)');
    
    // On exécute la requête en associant les variables aux emplacements définis précédemment par les ":" dans la requête
    $resultat = $requete->execute([ 
        'ID' => $new_id,
        'Nom' => $Nom, 
        'Prenom' => $Prenom, 
        'Code_Bureau' => $Code_Bureau, 
        'Nom_Services' => $Nom_Services,
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête, sinon on continue
    if (!$resultat) {
        die("Echec de l'enregistrement");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/Liste_utilisateurs.php');
    exit;
?>