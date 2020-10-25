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
        header('Location: ../pages/formulaire_modification_imprimantes.php');
        exit;
    }
    else{
        $id = $_POST['id'];
    };
    if( empty($_POST['Marque']) ){
        header('Location: ../pages/formulaire_modification_imprimantes.php');
        exit;
    }
    else{
        // Sinon si $_POST['nom'] n'est pas vide, on met la valeur dans la variable $nom et on continue.
        $Marque = $_POST['Marque'];
    };
    
    if( empty($_POST['Modele']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_imprimantes.php');
        exit;
    }
    else{
        $Modele = $_POST['Modele'];
    };

    if( empty($_POST['Couleur']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_imprimantes.php');
        exit;
    }
    else{
        $Couleur = $_POST['Couleur'];
    };

    if( empty( $_POST['Date_Achat'] ) ){
         // header est utilisé pour rediriger sur une page. 
         header('Location: ../pages/formulaire_modification_imprimantes.php');
         exit;
    }else{
        // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
        $Date_Achat = $_POST['Date_Achat'];
    }
    if( empty( $_POST['Duree_Garantie'] ) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_imprimantes.php');
        exit;
   }else{
       // La valeur n'est pas numérique, on choisit de mettre 0 dans la variable $prix_ht, un prix de 0 sera alors enregistré.
       $Duree_Garantie = $_POST['Duree_Garantie'];
   }
   if( empty($_POST['Code_Bureau']) ){
    // header est utilisé pour rediriger sur une page. 
    header('Location: ../pages/formulaire_modification_imprimantes.php');
    exit;
    }
    else{
    $Code_Bureau = $_POST['Code_Bureau'];
    }
    if( empty($_POST['Nom']) ){
        // header est utilisé pour rediriger sur une page. 
        header('Location: ../pages/formulaire_modification_imprimantes.php');
        exit;
    } else{
        $Nom = $_POST['Nom'];
    };

    // Préparation de la requête
    $requete = $bdd->prepare('UPDATE imprimantes SET Marque=:Marque, Modele=:Modele, Couleur=:Couleur, Date_Achat=:Date_Achat, Duree_Garantie=:Duree_Garantie, Code_Bureau=:Code_Bureau, Nom=:Nom WHERE id=:id');
    
    // Exécution de la requête
    $resultat = $requete->execute([ 
        'id' => $id,
        'Marque' => $Marque, 
        'Modele' => $Modele, 
        'Couleur' => $Couleur,
        'Date_Achat' => $Date_Achat, 
        'Duree_Garantie' => $Duree_Garantie, 
        'Code_Bureau' => $Code_Bureau, 
        'Nom' => $Nom
    ]);

    // Si la requête présente une erreur, l'exécution du code s'arrête
    if (!$resultat) {
        die("Echec de la modification");
    }

    // Redirection du visiteur vers la liste des articles
    header('Location: ../pages/Liste_imprimantes.php');
    exit;

?>