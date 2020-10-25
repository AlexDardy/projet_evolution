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
        header('Location: ../pages/formulaire_modification_utilisateurs.php');
        exit;
    }
    else{
        $id = $_POST['id'];
    };
    if( empty($_POST['Nom']) ){
        header('Location: ../pages/formulaire_modification_utilisateurs.php');
        exit;
    }
    else{
        // Sinon si $_POST['nom'] n'est pas vide, on met la valeur dans la variable $nom et on continue.
        $Nom = $_POST['Nom'];
    };
    
    if( empty($_POST['Prenom']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_utilisateurs.php');
        exit;
    }
    else{
        $Prenom = $_POST['Prenom'];
    };

    if( empty( $_POST['Code_Bureau'] ) ){
         // header est utilisé pour rediriger sur une page. 
         header('Location: ../pages/formulaire_modification_utilisateurs.php');
         exit;
    }else{
        // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
        $Code_Bureau = $_POST['Code_Bureau'];
    }
    if( empty( $_POST['Nom_Services'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_utilisateurs.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $Nom_Services = $_POST['Nom_Services'];
   }

    // Préparation de la requête
    $requete = $bdd->prepare('UPDATE utilisateurs SET Nom=:Nom, Prenom=:Prenom, Code_Bureau=:Code_Bureau, Nom_Services=:Nom_Services WHERE id=:id');
    
    // Exécution de la requête
    $resultat = $requete->execute([ 
        'Nom' => $Nom, 
        'Prenom' => $Prenom, 
        'Code_Bureau' => $Code_Bureau, 
        'Nom_Services' => $Nom_Services,  
        'id' => $id,
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête
    if (!$resultat) {
        die("Echec de la modification");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/liste_utilisateurs.php');
    exit;

?>