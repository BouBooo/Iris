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
            if(isset($_POST['rememberme']))  
            {
              setcookie('email',$mailconnect,time()+365*24*3600,null,null,false,true);
              setcookie('password',$mdpconnect,time()+365*24*3600,null,null,false,true);

            }
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
    <link href="css/annonce.css" rel="stylesheet">


  </head>


    <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        
        <a class="navbar-brand js-scroll-trigger" href="index.html">IRIS</a> 

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
    <h2>Annonce</h2>
    <br /> <br />

        <h3>Développeur Web Fullstack </h3> 
        <h4>Lumi THD - Bordeaux (33)</h4>
        <h4>Temps plein, Stage, CDI</h4>
        <h4>Développeur Web Fullstack</h4>
        <br/>

        <div id="annonce">
          <p>Notre objectif ? Accélérer et optimiser le déploiement de la fibre optique partout en France, jusqu'à la "mamie du Cantal" !</p>
          <p>Un déploiement massif de la fibre a débuté : toute la France doit être couverte !Pour répondre à cette vague, nous aidons les collectivités, opérateurs et constructeurs en leur fournissant des plans optimisés et fiables. Pour cela nous avons développé une plateforme permettant d’optimiser la localisation et le dimensionnement des câbles et réseaux de fibres optiques. A l’aide d’une solide connaissance de l'ingénierie FTTH nous développons des algorithmes associant théorie des graphes, big data et donnée géographique(SIG). Nous faisons face à une forte croissance et souhaitons étoffer l’équipe. Nous recherchons actuellement plusieurs profils dont un CDI back-end pour contribuer au développement de la plateforme</p>

          <h4>Les missions à remplir</h4>

          <ul>
            <li>
              Travail de l’ergonomie avec l’aide de web designers et de l’équipe client: parcours client simplifié, identification des points de blocage et résolution, support client interne
            </li>
            <li>
              Ajout de nouvelles fonctionnalités (blog, ticketing, SSO, GED, dashboard...)
            </li>
            <li>
              Amélioration des temps de calcul et des performances de la plateforme
            </li>
            <li>
              Mise en place d’un système de monitoring/ Logging / Analytics(stack ELK)
            </li>

          </ul> 
          <br/>


          <h5>Profil recherché</h5>

              <ul>
                <li>
                  Compétences et/ou capacitéde monter en puissance en Python (frameworkDjango), JQuery/Node.js, CSS/graphisme, authentification web et un zeste d’admin sys orienté open source et conteneurs(Debian, Nginx, Docker)
                </li>
                <li>
                  Esprit Start up: autonomie, proactivité, envie d'apprendre et d'innover.
                </li>
              </ul> 
            <br/><br/>


            <h6>Les atouts de Lumi:</h6>

          <ul>
            <li>
              Vous rejoindrez une entreprise en expansion (notre CA et l’équipe double tous les ans)-Vous aurez une réelle latitude d'action dans votre périmètre et travaillerez sur des technos ‘state of the art’
            </li>
            <li>
              Vous serez entouré de geeks passionnés d’innovation, aimant la liberté des petites structures et exigeants sur les services que nous développons
            </li>
            <li>
              Vous découvrirez les méthodes agiles dans une startup dynamique qui prend soin de son équipe (restaurants pour fêter les succès, bonne mutuelle, tickets restaurants, events semestriels etc.)
            </li>
          </ul> 

            <p>Envoyez-nous votre CV pour que nous convenions d’un rendez-vous.</p>



            <p>Rémunération: <b>32 à 40k€</b></p>

            <p>Type d'emploi : <b>Temps plein, Stage, CDI</b></p>

        

      </div>



    <!-- Portfolio Grid Section -->
    <!--
    <section class="portfolio" id="portfolio">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Mes Projets</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-1">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/cabin.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-2">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/cake.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-3">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/circus.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-4">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/game.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-5">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/safe.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-6">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/submarine.png" alt="">
            </a>
          </div>
        </div>
      </div>
    </section>
  -->

   
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
          </p>
          </div>
        </div>
      </div>
    </footer>

        


        
    </form>



    </div>
    </body>

</html>