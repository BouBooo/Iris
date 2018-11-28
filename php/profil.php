<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1; dbname=espace_membre', 'root', '');  #Connexion à la base de données

if (isset($_GET['id']) AND $_GET['id'] > 0) 
{
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();

?>

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Iris</title>
    </head>
    
    <body>
    <div align=center>
    <h2>Profil de Mr <?php echo $userinfo['nom']; ?></h2>
    <br /> <br />
        Nom = <?php echo $userinfo['nom']; ?>
        <br/>
        Mail = <?php echo $userinfo['mail']; ?>

        <br/>
        <?php
        if (isset($_SESSION['id']) AND ($userinfo['id'] == $_SESSION['id'])) 
        {
        ?>

          <a href="editionprofil.php">Editer mon profil</a>
          <a href="deconnexion.php">Se déconnecter</a>

        <?php
        }
        ?>
    </div>
    </body>

</html>

<?php


}
?>