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
        header('Location: ../pages/formulaire_modification_ordinateurs.php');
        exit;
    }
    else{
        $id = $_POST['id'];
    };
    if( empty($_POST['Marque']) ){
        header('Location: ../pages/formulaire_modification_ordinateurs.php');
        exit;
    }
    else{
        // Sinon si $_POST['nom'] n'est pas vide, on met la valeur dans la variable $nom et on continue.
        $Marque = $_POST['Marque'];
    };
    
    if( empty($_POST['Modele']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_ordinateurs.php');
        exit;
    }
    else{
        $Modele = $_POST['Modele'];
    };

    if( empty( $_POST['Taille_disque'] ) ){
         // header est utilisé pour rediriger sur une page. 
         header('Location: ../pages/formulaire_modification_ordinateurs.php');
         exit;
    }else{
        // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
        $Taille_disque = $_POST['Taille_disque'];
    }
    if( empty( $_POST['Taille_Memoire'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_ordinateurs.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $Taille_Memoire = $_POST['Taille_Memoire'];
   }
   if( empty( $_POST['Date_Achat'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_ordinateurs.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $Date_Achat = $_POST['Date_Achat'];
   }if( empty( $_POST['Duree_Garantie'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_ordinateurs.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $Duree_Garantie = $_POST['Duree_Garantie'];
   }
   if( empty( $_POST['ID_Utilisateurs'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_ordinateurs.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $ID_Utilisateurs = $_POST['ID_Utilisateurs'];
   }

    // Préparation de la requête
    $requete = $bdd->prepare('UPDATE ordinateurs SET Marque=:Marque, Modele=:Modele, Taille_Disque=:Taille_Disque, Taille_Memoire=:Taille_Memoire, Date_Achat=:Date_Achat, Duree_Garantie=:Duree_Garantie, ID_Utilisateurs=:ID_Utilisateurs WHERE ID=:ID');
    
    // Exécution de la requête
    $resultat = $requete->execute([ 
        'Marque' => $Marque, 
        'Modele' => $Modele, 
        'Taille_Disque' => $Taille_disque, 
        'Taille_Memoire' => $Taille_Memoire,
        'Date_Achat' => $Date_Achat,
        'Duree_Garantie' => $Duree_Garantie,
        'ID_Utilisateurs' => $ID_Utilisateurs,
        'ID' => $id,
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête
    if (!$resultat) {
        die("Echec de la modification");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/liste_ordinateurs.php');
    exit;

?>