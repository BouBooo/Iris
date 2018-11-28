<?php
session_start();
$bdd = new PDO("mysql:host=127.0.0.1;dbname=espace_membre;charset=utf8","root","");

if(isset($_POST['article_titre'], $_POST['article_salaire'], $_POST['article_contrat'] )){
	if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu']))  {
		$article_titre = htmlspecialchars($_POST['article_titre']);
		$article_contenu = htmlspecialchars($_POST['article_contenu']);
    $article_salaire = htmlspecialchars($_POST['article_salaire']);
    $article_contrat = htmlspecialchars($_POST['article_contrat']);
    $article_profil = htmlspecialchars($_POST['article_profil']);
    $article_mail = htmlspecialchars($_POST['article_mail']);

		$ins = $bdd->prepare('INSERT INTO articles (titre, salaire, contrat, profil, contenu, mail_contact, date_time_publication) VALUES (?, ?, ?, ?, ?, ?, NOW())');
		$ins->execute(array($article_titre, $article_salaire, $article_contrat, $article_profil, $article_contenu, $article_mail));

		$message = 'Votre annonce a bien été publiée';

	}  else  {
		$message = 'Veuillez remplir tous les champs';
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
    <link href="css/align.css" rel="stylesheet">
    <link href="css/redaction.css" rel="stylesheet">

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
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="accueil.php">Appel d'offres</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="profil.php?id=<?= $_SESSION['id'] ?>">Mon profil</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="deconnexion.php">Se déconnecter</a>
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



	<form method="POST">
		<div class="control-group">

		<input class="form-control" type="text" name="article_titre" placeholder="Titre" /><br/>
    <input class="form-control" type="text" name="article_salaire" placeholder="Salaire" /><br/>
    <input class="form-control" type="text" name="article_contrat" placeholder="Type de contrat" /><br/>
    <textarea class="form-control" name="article_profil" placeholder="Profil requis"></textarea><br/>
		<textarea class="form-control" name="article_contenu" placeholder="Descriptif de l'annonce"></textarea><br/>
    <input class="form-control" type="email" name="article_mail" placeholder="Mail de l'annonceur"/>
     <br/>
  </br>
		<input type="submit" class="btn btn-primary btn-xl" value="Envoyer l'annonce"/><br/>




		<?php if(isset($message))  { echo $message; }  ?>

    <br/>
    <br/>
    <a class="btn btn-primary btn-xl" href="accueil.php">Précédent</a>

		</div>
	</form>

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



    </div>
    </body>

</html>
