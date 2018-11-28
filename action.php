<?php
$bdd = new PDO("mysql:host=127.0.0.1;dbname=espace_membre;charset=utf8","root","");

if(isset($_GET['t'],$_GET['id']) AND !empty($_GET['t']) AND !empty($_GET['id']))  {

	$getid = (int) $_GET['id'];
	$gett = (int) $_GET['t'];

	$check = $bdd->prepare('SELECT id FROM articles WHERE id = ?');
	$check->execute(array($getid));

	if($check->rowCount() == 1){
		if($gett == 1){
			$ins = $bdd->prepare('INSERT INTO likes (id_article) VALUES (?)');
			$ins->execute(array($getid));
		}
		elseif($gett == 2) {
			$ins = $bdd->prepare('INSERT INTO dislikes (id_article) VALUES (?)');
			$ins->execute(array($getid));
		} 
		header('Location: http://localhost/boot/article.php?id='.$getid);
	} else {
		exit('Erreur fatale');
	}
} else {
	exit('Erreur fatale');
}