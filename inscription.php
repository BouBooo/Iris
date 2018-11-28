<!DOCTYPE html>

<?php

$bdd = new PDO('mysql:host=127.0.0.1; dbname=espace_membre', 'root', '');  #Connexion à la base de données 

if (isset($_POST['forminscription'])) 
{
    $nom = htmlspecialchars($_POST['nom']);      #Vérification des caractères 
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);     
        $mdp = sha1($_POST['mdp']);                  #Hachage des mdp
        $mdp2 = sha1($_POST['mdp2']);


    if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) 
    {

        $nomlength = strlen($nom);
        if ($nomlength <= 255) 
        {
            if ($mail == $mail2)
            {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if ($mailexist == 0) 
                    {
                      
                        if ($mdp == $mdp2) 
                        {
                            $insertmbr = $bdd->prepare("INSERT INTO membres(nom, mail, motdepasse, avatar) VALUES (?,?,?,?)");  #Envoi des données d'inscription vers la bdd
                            $insertmbr->execute(array($nom, $mail, $mdp, "default.png"));
                            $_SESSION['comptecree'] = "Votre compte a bien été créé !";
                            header('Location: connexion.php');

                        }

                        else 
                        {
                           $erreur = "Vos deux mots de passe doivent être identiques";
                        }

                    }
                    else 
                    {
                        $erreur = "Adresse mail déjà utilisée";
                    }
                       
                }

                else  
                {
                    $erreur = "Votre adresse mail n'est pas valide";
                }


            }
            else
            {
                $erreur = "Vos deux adresses mail doivent être identiques";
            }
        }

        else   
        {
            $erreur = "Votre nom ne doit pas dépasser 255 caractères";
        }


    }
    else {
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
    <link href="css/inscription.css" rel="stylesheet">

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
          <br/>
        <h2>Inscription</h2>
        <br /> <br />
        <form method="POST" action="">

      
        	<table id="formulaire">                               <!-- Formulaire d'inscription-->
        		<tr> 
        		    <td align="left">
         		    	<!--<label for="nom">Nom:</label>
        		    </td>-->
        		    <td>
        			    <input class="form-control" type="text" placeholder="Votre nom" id="nom" name="nom" value="<?php if (isset($nom)) { echo  $nom;  } ?>"/>
        		    </td>
        		</tr>
        		<tr>
        		    <td align="left">
        		    	<!--<label for ="mail">Mail:</label>
        		    </td>-->
        		    <td>
        			    <input class="form-control" type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if (isset($mail)) { echo  $mail;  } ?>"/>
        		    </td>
        		</tr>
        		<tr>
        		    <td align="left">
        		    	<!--<label for="mail2">Confirmation du mail:</label>
        		    </td>-->
        		    <td>
        			    <input class="form-control" type="email" placeholder="Confirmation de l'email" id="mail2" name="mail2" value="<?php if (isset($mail2)) { echo  $mail2;  } ?>"/>
        		    </td>
        		</tr>
        		<tr>
        		    <td align="left">
        		    	<!--<label for="mdp">Mot de passe:</label>
        		    </td>-->
        		    <td>
        			    <input class="form-control" type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"/>
        		    </td>
        		</tr>
        		<tr>
        		    <td align="left">
        		    	<!--<label for="mdp">Confirmation mot de passe:</label>
        		    </td>-->
        		    <td>
        			    <input class="form-control" type="password" placeholder="Confirmation de votre mot de passe" id="mdp2" name="mdp2"/>
        		    </td>
        		</tr>
        		<tr>
        			<td></td>
        			<td>
        				<input type="submit" name="forminscription" value="Je m'inscris" class="btn btn-primary btn-xl"/>
        			</td>
        		</tr>
        		
        	</table>


        	
        </form>

        <hr class="star-dark mb-5">

        <p>Déjà membre? <a href="connexion.php">Connectez-vous !</a></p>



          <?php
          if (isset($erreur)) {
              echo '<span style="color:red">'.$erreur.'</span>';
          }

          ?>
    </div>
    <br/>
  
    <!-- Portfolio Grid Section -->
    <!--
    <section class="portfolio" id="portfolio">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0"></h2>
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
              <img class="img-fluid" src="" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-3">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-4">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-5">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-6">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fa fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="" alt="">
            </a>
          </div>
        </div>
      </div>
    </section> -->

   
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