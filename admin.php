<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1; dbname=espace_membre', 'root', '');  #Connexion à la base de données 

if(!isset($_SESSION['admin']) OR intval($_SESSION['admin']) != 1)  {
    header('Location: refus.php');
}

  if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
  	$confirme = (int) $_GET['confirme'];

  	$req = $bdd->prepare('UPDATE membres SET confirme = 1 WHERE id = ?');  # 0 -> 1 Membre confirmé
  	$req->execute(array($confirme));
  }



  if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
  	$supprime = (int) $_GET['supprime'];

  	$req = $bdd->prepare('DELETE FROM membres WHERE id = ?');  # 0 -> 1 Membre delete
  	$req->execute(array($supprime));
  }





  $membres = $bdd->prepare('SELECT * FROM membres ORDER BY id DESC');
  $membres->execute();


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
        <img class="img-fluid mb-5 d-block mx-auto" src="img/irisgif.gif" alt="" width="200" heigth="200">
        <h1 class="text-uppercase mb-0"></h1>
        <hr class="star-light">
        <h2 class="font-weight-light mb-0">Votre site de recherche d'emploi</h2>
      </div>
    </header>
  </br>
</br>
    <table cellspacing="0" cellpadding="0" border="1" bordercolor="blue" width="60%" align="center">
      <tr>
      <th width="20%">Id</th>
      <td width="60%">Nom de compte</td>
      <td width="20%">Confirmation</td>
      <td width="20%">Suppression</td>
      </tr>
        <?php 
        
        while($m = $membres->fetch()) { ?>
        <tr>
      <td width="20%"><?= $m['id'] ?></td>
      <td width="60%"><?= $m['nom'] ?></td>
      <td width="20%"><?php if($m['confirme'] == 0) { ?>  <a href="admin.php?confirme=<?= $m['id'] ?>">Confirmer </a></td><?php } else {  echo "Confirmé ! ";  } ?>
      <td width="20%"><a href="admin.php?supprime=<?= $m['id'] ?>">Supprimer </a></li></td></tr>
      <?php } if (!isset($m) || empty($m)) {} ?>
    </table>

    <br/>
    <br/>

    <!--<ul>
      <?php while($c = $commentaires->fetch()) { ?>
      <li><?= $c['id'] ?> : <?= $c['nom'] ?> <?php if($c['confirme'] == 0) { ?> -  <a href="admin.php?confirme=<?= $c['id'] ?>">Confirmer </a><?php } ?> 
        -  <a href="admin.php?supprime=<?= $c['id'] ?>">Supprimer </a></li>   -->
      <!--<?php } ?>-->
    <!--</ul>-->




   
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
