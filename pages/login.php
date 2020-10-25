<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <title>Application WEB</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <?php
       include 'theme.php'
       ?>
        <style type="text/css">
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        </style>
    </head>
<body>
    <?php
    session_start(); 
    include 'navigation.php';
        

    if (isset($_POST['username'])){
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $bdd = new PDO('mysql:host=localhost;dbname=evolution;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $requete = $bdd->prepare("SELECT utilisateurs.ID, utilisateurs.Mot_De_Passe, map_role.Nom 
        FROM `utilisateurs` INNER JOIN `map_role` ON utilisateurs.ID = map_role.ID 
        WHERE utilisateurs.ID='$username' and utilisateurs.Mot_De_Passe='".hash('sha256', $password)."'");
        $requete->execute();
        $data = array();
        while($donnees = $requete->fetch()) {
            array_push($data,$donnees['Nom']);
        }
        $requete->closeCursor();
        print_r($data);
        if(!empty($data)) {
            if (in_array("Standard", $data)) {
                $_SESSION['role'] = "Standard";
            }
            if (in_array("Administrateur", $data)) {
                $_SESSION['role'] = "Administrateur";
            }
            echo "<script>window.location.href='index.php';</script>";
            exit;
        }else{
            $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
    }
    ?>
    <div class="container mt-5">
        <form class="form-signin" action="" method="post" name="login">
            <h1 class="h3 mb-3 font-weight-normal">Connectez-vous</h1>
            <div class="form-group">
                <label for="username">Identifiant</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-lg blue-button btn-block">Se connecter</button>
        </form>
    </div>
</body>
</html>