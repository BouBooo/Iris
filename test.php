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

  </head>

  <body id="page-top">


<section id="contact">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Connexion</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
            <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
            <form name="sentMessage" id="contactForm" novalidate="novalidate">

              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Adresse mail</label>
                  <input class="form-control" type="email" name="mailconnect" placeholder="Mail">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
                <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Password</label>
                  <input class="form-control" type="text" name="mdpconnect" placeholder="Mot de passe">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
  
              <br>
              <div id="success"></div>
              <div class="form-group">
                    <input type="submit" name="formconnexion" value="Se connecter" class="btn btn-primary btn-xl" />
              </div>
            </form>
              <p>Pas encore membre ? <a href="inscription.php">Inscrivez-vous</a></p>
              <?php
          if (isset($erreur)) {
              echo '<span style="color:red">'.$erreur.'</span>';
          }

          ?>
    </div>
          </div>
        </div>
      </div>
    </section>



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>

</html>
