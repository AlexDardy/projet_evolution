<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <a class="navbar-brand" href="index.php">
                        <img src="../assets/img/Logo_AlgaTools.PNG" width="50" height="50" class="d-inline-block align-middle" alt="">
                        AlgaTools
                    </a>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>



                    <?php
                        if(isset($_SESSION["role"])){
                            if ($_SESSION["role"] == 'Standard') {
                            echo '
                            <li class="nav-item dropdown show">               
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Requêtes
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="informations_utilisateurs.php?id_utilisateurs=U0001">Informations Materiel</a>  
                                </div>
                            </li>
                            ';
                        }
                    }
                    ?>



                    <?php
                        if(isset($_SESSION["role"])){
                            if ($_SESSION["role"] == 'Administrateur') {
                            echo '
                            <li class="nav-item dropdown show">               
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Afficher les listes
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="Liste_Utilisateurs.php">Lister les utilisateurs</a>
                                    <a class="dropdown-item" href="Liste_Ordinateurs.php">Lister les ordinateurs</a>
                                    <a class="dropdown-item" href="Liste_Ecrans.php">Lister les écrans</a>
                                    <a class="dropdown-item" href="Liste_Telephones.php">Lister les téléphones</a>
                                    <a class="dropdown-item" href="Liste_Localisation.php">Lister les localisations</a>
                                    <a class="dropdown-item" href="Liste_Services.php">Lister les services</a>
                                    <a class="dropdown-item" href="Liste_imprimantes.php">Lister les imprimantes</a>
                                    <a class="dropdown-item" href="Liste_Stock.php">Lister le stock</a>
                                    <a class="dropdown-item" href="Liste_map_role.php">Lister les map_role</a>  
                                </div>
                            </li>
                            ';
                        }
                    }
                    ?>
                

                    <?php
                    if(isset($_SESSION["role"])){
                        if ($_SESSION["role"] == 'Administrateur') {
                            echo '
                    <li class="nav-item dropdown show">               
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ajouter
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="formulaire_ajout_utilisateurs.php">Ajouter un utilisateur</a>
                            <a class="dropdown-item" href="formulaire_ajout_ordinateurs.php">Ajouter un ordinateur</a>
                            <a class="dropdown-item" href="formulaire_ajout_ecrans.php">Ajouter un écran</a>
                            <a class="dropdown-item" href="formulaire_ajout_telephones.php">Ajouter un telephone</a>
                            <a class="dropdown-item" href="formulaire_ajout_localisation.php">Ajouter une localisation</a>
                            <a class="dropdown-item" href="formulaire_ajout_services.php">Ajouter un service</a>
                            <a class="dropdown-item" href="formulaire_ajout_imprimantes.php">Ajouter une imprimante</a>
                            <a class="dropdown-item" href="formulaire_ajout_map_role.php">Ajouter un map_role</a>
                        </div>
                    </li>
                    ';
                        }
                    }
                    ?>

                    <?php
                        if(isset($_SESSION["role"])){
                            if ($_SESSION["role"] == 'Administrateur') {
                                echo '
                            <li class="nav-item dropdown show">               
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Supprimer
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="formulaire_suppression_utilisateurs.php">Supprimer un utilisateur</a>
                                    <a class="dropdown-item" href="formulaire_suppression_ordinateurs.php">Supprimer un ordinateur</a>
                                    <a class="dropdown-item" href="formulaire_suppression_ecrans.php">Supprimer un écran</a>
                                    <a class="dropdown-item" href="formulaire_suppression_telephone.php">Supprimer un telephone</a>
                                    <a class="dropdown-item" href="formulaire_suppression_localisation.php">Supprimer une localisation</a>
                                    <a class="dropdown-item" href="formulaire_suppression_services.php">Supprimer un service</a>
                                    <a class="dropdown-item" href="formulaire_suppression_imprimantes.php">Supprimer une imprimante</a>
                                    <a class="dropdown-item" href="formulaire_suppression_map_role.php">Supprimer un map_role</a>
                                </div>
                            </li>
                        ';
                            }
                        }
                    ?>

                    <?php
                        if(isset($_SESSION["role"])){
                            if ($_SESSION["role"] == 'Administrateur') {
                                echo '
                            <li class="nav-item dropdown show">               
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Modifier
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="formulaire_modification_utilisateurs.php">Modifier un utilisateur</a>
                                    <a class="dropdown-item" href="formulaire_modification_ordinateurs.php">Modifier un ordinateur</a>
                                    <a class="dropdown-item" href="formulaire_modification_ecrans.php">Modifier un écran</a>
                                    <a class="dropdown-item" href="formulaire_modification_telephones.php">Modifier un telephone</a>
                                    <a class="dropdown-item" href="formulaire_modification_localisation.php">Modifier une localisation</a>
                                    <a class="dropdown-item" href="formulaire_modification_services.php">Modifier un service</a>
                                    <a class="dropdown-item" href="formulaire_modification_imprimantes.php">Modifier une imprimante</a>
                                    <a class="dropdown-item" href="formulaire_modification_map_role.php">Modifier un map_role</a>
                                </div>
                            </li>
                        ';
                            }
                        }
                    ?>
                </ul>
                <div>
                        <?php
                            if(isset($_SESSION["role"])){
                                echo 
                                '<a class="btn text-white" href="logout.php">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-x-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                </svg>
                                    Déconnexion
                                </a>';
                            } else {
                                echo 
                                '<a class="btn text-white" href="login.php">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                                    Connexion
                                </a>';
                            }
                        ?>
                    </div>
            </div>
        </nav>