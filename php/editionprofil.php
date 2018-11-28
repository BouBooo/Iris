<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1; dbname=espace_membre', 'root', '');  #Connexion à la base de données

if (isset($_SESSION['id']))
{
    $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if (isset($_POST['newname']) AND !empty($_POST['newname']) AND $_POST['newname'] != $user['nom']) 
    {
        $newname = htmlspecialchars($_POST['newname']);
        $insertname = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ?");
        $insertname->execute(array($newname, $_SESSION['id']));
       //header('Location: profil.php?id='.$_SESSION['id']);
    }

    if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) 
    {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        //header('Location: profil.php?id='.$_SESSION['id']);
    }

    if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) 
    {
        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);

        if($mdp1 == $mdp2)
        {
            $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");  //Verification mots de passe identiques
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            //header('Location: profil.php?id='.$_SESSION['id']);
        }
        else
        {
            $msg = "Vos mots de passe doivent être identiques";
        }

    }

    if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) 
    {
        $tailleMax = 2097152;
        $extensionsValides = array('jpg','jpeg','gif','png');
        if ($_FILES['avatar']['size' ] <= $tailleMax) 
        {
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionsValides)) 
            {
                $chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                if($resultat)
                {
                    $updateavatar = $bdd->prepare('UPDATE membres SET avatar = :avatar WHERE id = :id');
                    var_dump($chemin);
                    $updateavatar->execute(array(
                        'avatar' => $_SESSION['id'].".".$extensionUpload,
                        'id' => $_SESSION['id']
                        ));
                }
                else
                {
                    $msg = "Erreur durant l'importation de la photo";
                }
            }
            else
            {
                $msg = "Votre photo de profil doit être au format jpeg, jpg, png, gif";
            }
        }
        else
        {
            $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
        }
    }
    ?>

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Iris</title>
    </head>
    
    <body>
    <div align=center>
    <h2>Edition de mon profil</h2>
    <br /> <br />
        <div align="left">
            <form method="POST" action="" enctype="multipart/form-data">
                <label>Nom:</label>
                <input type="text" name="newname" placeholder="Nom" value="<?php echo $user['nom'];?>"/><br/><br/>
                <label>Mail:</label>
                <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail'];?>"/><br/><br/>
                <label>Mot de passe:</label>
                <input type="password" name="newmdp1" placeholder="Mot de passe"/><br/><br/>
                <label>Confirmation mot de passe:</label>
                <input type="password" name="newmdp2" placeholder="Confirmation mot de passe"/><br/><br/>
                <label>Avatar:</label>
                <input type="file" name="avatar"/><br/><br/>
                <input type="submit" value="Mettre à jour mon profil" name="envoyer"/><br/><br/>


            </form>
            <?php
                if (isset($msg)) 
                {
                    echo $msg;
                }

                if (isset($_POST['newname']) AND $_POST['newname'] == $user['nom']) 
                {
                    //header('Location: profil.php?id='.$_SESSION['id']);
                }



            ?>
        </div>
        
    </div>
    </body>

</html>
<?php
}
else  
{
    header("Location: connexion.php");
}
?>