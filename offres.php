<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1; dbname=espace_membre', 'root', '');  #Connexion à la base de données 

if (isset($_POST['formconnexion'])) 
{    
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if (!empty($mailconnect) AND !empty($mdpconnect)) 
    {
        $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
        $requser->execute (array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();

        if ($userexist == 1) 
        {
            var_dump($userexist);
            $userinfo = $requser->fetch();                #Récupération infos utilisateur
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['nom'] = $userinfo['nom'];           
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location: profil.php?id=".$_SESSION['id']);   #Redirection profil
        }
        else
        {
            $erreur = "Mauvaise identification";                    #Erreurs

        }



    }
    else  
    {
        $erreur = "Tous les champs doivent être complétés";
    }
}





?>


<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Iris</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>


    <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        
        <a class="navbar-brand js-scroll-trigger" href="index.php">IRIS</a> 

        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="offres.php">Appel d'offres</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="connexion.php">Connexion</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="inscription.php">Inscription</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <!--<img class="img-fluid mb-5 d-block mx-auto" src="img/iris.jpg" alt="" width="200" heigth="200">-->
        <!--<h1 class="text-uppercase mb-0"></h1>-->
        <hr class="star-light">
        <h2 class="font-weight-light mb-0">Votre site de recherche d'emploi</h2>
      </div>
    </header>




        <div align=center>
        </br>
    

    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Mes annonces</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="annonce1.php">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <p>Développeur Web </p>
              <p>SAGE - Bordeaux (33)</p>
              <p>CDI</p>

              <hr class="star-light">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="annonce2.php">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <p>Chef de projets Informatique H/F</p>
              <p>INEOX - Bordeaux (33)</p>
              <p>40 000 € - 60 000 € par an - CDI</p>

              <hr class="star-light">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="annonce3.php">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <p>Stage Développeur web et mobile</p> 
              <p>Le Web Français - Bordeaux (33)</p>
              <p>Stage</p>

              <hr class="star-light">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="annonce4.php">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <p>Développeur Web Fullstack </p> 
              <p>Lumi THD - Bordeaux (33)</p>
              <p>Temps plein, Stage, CDI</p>

              <hr class="star-light">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="annonce5.php">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <p>Technicien informatique</p> 
              <p>SB2P - Pessac (33)</p>
              <p>25 000 € par an - CDI</p>

              <hr class="star-light">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="annonce6.php">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <p>Développeur informatique C# H/F </p> 
              <p>ANTSYS - Bordeaux (33)</p>
              <p>30 000 € - 32 000 € par an - Temps plein, CDI</p>

              <hr class="star-light">
            </a>
          </div>
        </div>
      </div>
    </section>

   
    <!-- Footer -->
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Notre Localisation</h4>
            <p class="lead mb-0">33000 BORDEAUX</p>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Où nous trouver</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/">
                  <i class="fa fa-fw fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://plus.google.com/">
                  <i class="fa fa-fw fa-google-plus"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-linkedin"></i>
                </a>           
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class="text-uppercase mb-4">Liens</h4>
            <p class="lead mb-0">Pour plus de renseignement vous pouvez visitez les sites 
              <a href="http://www.cesi.fr/">du CESI</a> , 
              <a href="https://www.econocom.com/fr">d'Econocom</a> et 
              <a href="https://www.thalesgroup.com/fr">de Thales</a>
          .</p>
          </div>
        </div>
      </div>
    </footer>

        


        
    </form>



    </div>
    </body>

</html>