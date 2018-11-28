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



			<h3>Chef de projets Informatique H/F </h3>
			<h4>INEOX - Bordeaux (33)</h4>
			<h4>40 000 € - 60 000 € par an - CDI</h4>
			<br/>
			<div id="annonce">
			<p>La société de conseil INEOX, expert en transformation, regroupant des compétences pluridisciplinaires au service de l'innovation, 
			de l'interaction et du développent de la relation Client, recherche de nouveaux talents afin d'intégrer son équipe. </p>
			<p>INEOX intervient auprès de ses Clients, pour les aider dans leurs phases de recherche, d’étude, de développement et de déploiement
			 de solutions technologiques liées au marketing : plateforme digitale, Sales Force Automation, CRM multicanal, Data Management 
			 Platform, Big Data, BI, Web Analytics…</p>

			<p>Dans le cadre de sa croissance exponentielle, INEOX recrute un Chef de projets Informatique H/F :</p>

			<h4>Poste et missions</h4>

			<p>En qualité de Chef de projets informatique, vous aurez pour mission de :</p>

			<ul>
				<li>
					Participer à la conception de solutions : choix d'outils, proposition de solutions alternatives
				</li>
				<li>
					Elaborer des spécifications en fonction des besoins exprimés par le Client
				</li>
				<li>
					A partir de spécifications fonctionnelles ou techniques, planifier la réalisation des développements et paramétrages, 
					en lien direct avec le Client ou dans une équipe projet MOE
				</li>
				<li>
					Participation à la réalisation de développements complexes
				</li>
				<li>
					Assurer le suivi et la qualité des développements
				</li>
				<li>
					Rédiger les différentes documentations : dossier de conception, spécifications techniques, dossier d'exploitation, 
					documentation utilisateur
				</li>
				<li>
					Planifier et suivre les mises en production
				</li>
				<li>
					Assurer la bonne réalisation de la mission (suivi de la qualité, respect des charges et délais…)
				</li>
				<li>
					Assurer le rôle de référent et suivre la montée en compétences de consultant junior
				</li>
				<li>
					Compétences techniques
				</li>
			</ul>

			<p>Le poste à pourvoir nécessite une forte polyvalence, les différentes prestations proposées nécessitent une forte capacité
			 d'adaptation afin de pouvoir répondre à l'environnement technique des différents Clients :</p>

			<p>Prise en main de nouveaux progiciels, réalisation de paramétrages avancés, développement de briques applicatives fortement
			intégrées dans un environnement existant.</p>
			<p>Capacité à s'approprier les concepts de progiciels du marché (outils CRM, BI, SFA,...)</p>

			<h6>Le candidat devra pouvoir justifier de connaissances sur :</h6>
			<ul>
				<li>
					Des outils de CRM et de gestion de campagne marketing : Salesforce, Adobe Campaign, IBM Unica, …
				</li>
				<li>
					Les bases de données (langage SQL), tant en conception (MCD, MPD) qu'en utilisation (SQL, procédures stockées)
				</li>
				<li>
					Les langages courants, plutôt orientés Web : HTML 5, CSS, Java / Javascript, C#, PHP, Ajax...
				</li>
			</ul>

			<h6>Une première expérience sur les sujets suivants serait un plus :</h6>

			<ul>
				<li>
					Business Intelligence
				</li>
				<li>
					BigData
				</li>
				<li>
					Tracking Web
				</li>
			</ul>

			<p>Le candidat devra justifier d’une première expérience d’encadrement d’une équipe dans un environnement 
				réel de production (TMA, suivi de projet, …)</p>

			<h4>Profil :</h4>

			<p>De formation supérieure en informatique BAC+4/5, vous disposez d'une première expérience réussie dans le développement de solutions intégrées au sein d'une entreprise, idéalement dans le domaine du CRM.</p>

			<p>Votre rigueur, esprit d'analyse et de synthèse seront les atouts qui vous permettront d’assurer la réussite de vos missions au sein d’INEOX. De plus, votre autonomie, sens de l'initiative, 
				force de proposition et votre excellence adaptabilité sont autant d’atouts qui vous permettront d’apporter de la valeur ajoutée aux projets.</p>

			<p>La maitrise (parlé, écrit, lu) du Français et de l’anglais sont impératifs. L’espagnol serait un plus.</p>

			<p>Si vous souhaitez :</p>

			<ul>
				<li>
					Intégrer une équipe dynamique et motivée où vos talents, idée et proactivité seront reconnus et encouragés
				</li>
				<li>
					Découvrir une diversité de projets qui vous permettra de connaitre plusieurs secteurs d’activité/métiers
				</li>
				<li>
					Avoir de réelles perspectives d’évolution
				</li>
			</ul>

			<p>Alors REJOIGNEZ NOUS!</p>

			<p>Le poste à pourvoir est basé en Ile de France ou à Bordeaux (mobilité nationale et internationale indispensable)</p>

			<p><b>CDI</b> - Rémunération Fixe attractive + Variable selon le profil. Possibilité de rentrer dans le capital d’INEOX.</p>

			<p>Type d'emploi : <b>CDI</b></p>

			<p>Salaire : <b>40 000,00€ à 60 000,00€ /an</b></p>



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
