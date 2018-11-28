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
                            $insertmbr = $bdd->prepare("INSERT INTO membres(nom, mail, motdepasse) VALUES (?,?,?)");  #Envoi des données d'inscription vers la bdd
                            $insertmbr->execute(array($nom, $mail, $mdp));
                            $_SESSION['comptecree'] = "Votre compte a bien été créé !";
                            header('Location: index.php');
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
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/style_inscription.css" />
        <title>Iris</title>
    </head>
    
    <body>

        <h1 id="title"><img src="../img/logo.png" width="100" height="100"/></h1>


        <div align=center>
        <h2>Inscription</h2>
        <br /> <br />
        <form method="POST" action="">

     
        	<table id="formulaire">                               <!-- Formulaire d'inscription-->
        		<tr> 
        		    <td align="right">
        		    	<label for="nom">Nom:</label>
        		    </td>
        		    <td>
        			    <input type="text" placeholder="Votre nom" id="nom" name="nom" value="<?php if (isset($nom)) { echo  $nom;  } ?>"/>
        		    </td>
        		</tr>
        		<tr>
        		    <td align="right">
        		    	<label for ="mail">Mail:</label>
        		    </td>
        		    <td>
        			    <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if (isset($mail)) { echo  $mail;  } ?>"/>
        		    </td>
        		</tr>
        		<tr>
        		    <td align="right">
        		    	<label for="mail2">Confirmation du mail:</label>
        		    </td>
        		    <td>
        			    <input type="email" placeholder="" id="mail2" name="mail2" value="<?php if (isset($mail2)) { echo  $mail2;  } ?>"/>
        		    </td>
        		</tr>
        		<tr>
        		    <td align="right">
        		    	<label for="mdp">Mot de passe:</label>
        		    </td>
        		    <td>
        			    <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"/>
        		    </td>
        		</tr>
        		<tr>
        		    <td align="right">
        		    	<label for="mdp">Confirmation mot de passe:</label>
        		    </td>
        		    <td>
        			    <input type="password" placeholder="" id="mdp2" name="mdp2"/>
        		    </td>
        		</tr>
        		<tr>
        			<td></td>
        			<td>
        				<input type="submit" name="forminscription" value="Je m'inscris"/>
        			</td>
        		</tr>
        		
        	</table>

        	
        </form>

        <div id="footer">

            <div id="1"><a href="facebook.com"><img src=""/></a> </div>   <!-- LIEN RESEAUX SOCIAUX-->


        </div>




          <?php
          if (isset($erreur)) {
              echo $erreur;
          }

          ?>
    </div>
    </body>

</html>