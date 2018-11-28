<!DOCTYPE html>

<?php

$bdd = new PDO('mysql:host=127.0.0.1; dbname=espace_membre', 'root', '');  #Connexion à la base de données 



?>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Iris</title>
    </head>
    
    <body>
    <div align=center>
    <h3>Inscription</h3>
    <br /> <br />
    <form method="POST" action="">

 
    	<table>                                <!-- Formulaire d'inscription-->
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





          <?php
          if (isset($erreur)) {
              echo $erreur;
          }

          ?>
    </div>
    </body>

</html>