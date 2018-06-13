<?php
	session_start();

	if ($_SESSION['admin']=='true') {
		$uploaddir = '../images/partenaires/';
		$imagename = basename($_FILES['logo']['name']);
		while (file_exists($uploaddir . $imagename)) {
			$imagename = 'a' . $imagename;
		}
		$photourl = $uploaddir . $imagename;


		echo "<p>";

		if (move_uploaded_file($_FILES['logo']['tmp_name'], $photourl)) {
		  echo "File is valid, and was successfully uploaded.\n";
		} else {
		   echo "Upload failed";
		}

		echo "</p>";
		echo '<pre>';
		echo 'Here is some more debugging info:';
		print_r($_FILES);
		print "</pre>";
		try {
	    	$bdd = new PDO('mysql:host=localhost;dbname=fourmisvertes;charset=utf8', 'root', ''
	    		// A ajouter pour traquer les erreurs SQL -Error Call to a member function fetch() on a non-object!-
	    		// , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
	    	);
			$req = $bdd->prepare("INSERT INTO partenaires (type, nom, logo) VALUES (?, ?, ?)");
			$req->execute(array($_POST['type'], $_POST['nom'], $imagename));
		} catch(Exception $e) {
		    // En cas d'erreur, on affiche un message et on arrête tout
	        die('Erreur : ' .$e->getMessage()
	    	);
		}
	}
	header('Location: /delast/ils-nous-ont-fait-confiance.php');
?>