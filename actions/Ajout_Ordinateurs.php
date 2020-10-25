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

    if( empty($_POST['Marque']) ){
        header('Location: ../pages/formulaire_ajout_ordinateurs.php');
        exit;
    }
    else{
        // Sinon si $_POST['nom'] n'est pas vide, on met la valeur dans la variable $nom et on continue.
        $Marque = $_POST['Marque'];
    };
    
    if( empty($_POST['Modele']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_ajout_ordinateurs.php');
        exit;
    }
    else{
        $Modele = $_POST['Modele'];
    };

    if( empty( $_POST['Taille_disque'] ) ){
         // header est utilisé pour rediriger sur une page. 
         header('Location: ../pages/formulaire_ajout_ordinateurs.php');
         exit;
    }else{
        // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
        $Taille_disque = $_POST['Taille_disque'];

    }
    if( empty( $_POST['Taille_Memoire'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_ajout_ordinateurs.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $Taille_Memoire = $_POST['Taille_Memoire'];
   }
   if( empty( $_POST['Date_Achat'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_ajout_ordinateurs.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $Date_Achat = $_POST['Date_Achat'];
   }
   if( empty( $_POST['Duree_Garantie'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_ajout_ordinateurs.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $Duree_Garantie = $_POST['Duree_Garantie'];
   }
   if( empty( $_POST['ID_Utilisateurs'] ) ){
       $ID_Utilisateurs = null;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $ID_Utilisateurs = $_POST['ID_Utilisateurs'];
   }

   //Génération d'un nouvel ID ordinateur incrémenté
   $requete_last_id = $bdd->prepare('SELECT MAX(CAST(SUBSTRING(ID,3, LENGTH(ID)) AS SIGNED)) AS LAST_ID from ordinateurs');
   $requete_last_id->execute();
   $last_id = $requete_last_id->fetch();
   $last_id = $last_id['LAST_ID'];
   $new_id = $last_id + 1;
   if ($new_id < 10) {
    $new_id = "PC00".$new_id;
   } elseif ($new_id < 100) {
       $new_id = "PC0".$new_id;
   } else {
       $new_id = "PC".$new_id;
   }


    // Insertion du message à l'aide d'une requête préparée
    // Il est important de noter les ":nom", etc...
    // Cela correspond aux valeurs qu'on va insérer dans la requête ci-après.
    $requete = $bdd->prepare('INSERT INTO ordinateurs(ID, Marque, Modele, Taille_disque, Taille_Memoire, Date_Achat, Duree_Garantie, ID_Utilisateurs) VALUES(:ID, :Marque, :Modele, :Taille_disque, :Taille_Memoire, :Date_Achat, :Duree_Garantie, :ID_Utilisateurs)');
    
    // On exécute la requête en associant les variables aux emplacements définis précédemment par les ":" dans la requête
    $resultat = $requete->execute([ 
        'ID' => $new_id,
        'Marque' => $Marque, 
        'Modele' => $Modele, 
        'Taille_disque' => $Taille_disque, 
        'Taille_Memoire' => $Taille_Memoire,
        'Date_Achat' => $Date_Achat,
        'Duree_Garantie' => $Duree_Garantie,
        'ID_Utilisateurs' => $ID_Utilisateurs,
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête, sinon on continue
    if (!$resultat) {
        die("Echec de l'enregistrement");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/Liste_ordinateurs.php');
    exit;
?>