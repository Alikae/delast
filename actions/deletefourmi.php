<?php
	session_start();
	if ($_SESSION['admin']=='true') {
		try {
	    	$bdd = new PDO('mysql:host=localhost;dbname=fourmisvertes;charset=utf8', 'root', ''
	    		// A ajouter pour traquer les erreurs SQL -Error Call to a member function fetch() on a non-object!-
	    		// , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
	    	);
	    	$req = $bdd->prepare('SELECT photo FROM fourmis WHERE id=?');
	    	$req->execute(array((int)$_POST['fourmiid']));
			$photo = $req->fetch();
			$req->closeCursor();
			$req = $bdd->prepare("DELETE FROM fourmis WHERE id=?;");
			$req->execute(array((int)$_POST['fourmiid']));
			$req->closeCursor();
			unlink('../images/' . $photo['photo']);
		} catch(Exception $e) {
		    // En cas d'erreur, on affiche un message et on arrête tout
	        die('Erreur : ' .$e->getMessage()
	    	);
		}
	}
	header('Location: /delast/mais-qui-sont-ces-fourmis.php');
?>