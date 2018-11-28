<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1; dbname=espace_membre', 'root', '');  #Connexion à la base de données 

if(isset($_SESSION['id']) AND !empty($_SESSION['id']))  {
	if(isset($_POST['envoi_message']))  {
		if(isset($_POST['destinataire'],$_POST['message'],$_POST['objet']) AND !empty($_POST['destinataire']) AND !empty($_POST['message']) AND !empty($_POST['objet'])) {
			$destinataire = htmlspecialchars($_POST['destinataire']);
			$message = htmlspecialchars($_POST['message']);
			$objet = htmlspecialchars($_POST['objet']);

			$id_destinataire = $bdd->prepare('SELECT id FROM membres WHERE mail = ?');
			$id_destinataire->execute(array($destinataire));
		
			$dest_exist = $id_destinataire->rowCount();

			if($dest_exist == 1) {
				$id_destinataire = $id_destinataire->fetch();
				$id_destinataire = $id_destinataire['id'];

				$ins = $bdd->prepare('INSERT INTO messages(id_expediteur,id_destinataire,message,objet) VALUES (?,?,?,?)');
				$ins->execute(array($_SESSION['id'],$id_destinataire,$message,$objet));

				$error = "Votre message a été envoyé avec succès";

			}
			else
			{
				$error = "Cet utilisateur n'existe pas";
			}


		}else {
			$error = "Vous devez compléter tous les champs";
		}
	}

	$destinataires = $bdd->query('SELECT mail FROM membres ORDER BY mail');

	if(isset($_GET['r']) AND !empty($_GET['r'])) {
		$r = htmlspecialchars($_GET['r']);
	}
	if(isset($_GET['o']) AND !empty($_GET['o'])) {
		$o = urldecode($_GET['o']);
		$o = htmlspecialchars($_GET['o']);
		$o = "RE: ".$o;
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
    	<div align="center">
        <br/>
        <br/>

        <a class="btn btn-primary btn-xl" href="reception.php">Boîte de réception</a> <br/> <br/> 

		<form method="POST">
			

			<!--<select name="destinataire">
				<?php while($d = $destinataires->fetch())  { ?>
				<option><?= $d['mail'] ?></option>
				<?php } ?>
			</select>-->

			
			<label>Destinataire: </label>
      <div class="control-group">
			<input type="text" name="destinataire" <?php if(isset($r)) {  echo'value="'.$r.'"'; } else { echo 'value='.$_GET['mail'];} ?>/>
			<br/> <br/>
			<input type="text" name="objet" placeholder="Objet:"  <?php if(isset($o)) {  echo'value="'.$o.'"'; } ?>/>
			<br/> <br/>
			<textarea placeholder="Message: " name="message"></textarea>	
			<br/> <br/>
			<input type="submit" value="Envoyer" name="envoi_message" class="btn btn-primary btn-xl"/>
			<br/> <br/>
			<?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>';  }  ?>
		</form>
			</div>
    </div>
      <br/>
      <br/>


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
          .</p>
          </div>
        </div>
      </div>
    </footer>

        


        
    </form>



    </div>
    </body>

</html>

	<?php
		}
		else  {
			header("Location: connexion.php");
		}
	?>