<?php session_start(); ?>
<!doctype html>

<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Page d'accueil</title>
	<meta name="association" content="Les Fourmis Vertes">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div id='allpage'>
		<?php include "partials/header.html";?>
			<?php 
				try {
			    	$bdd = new PDO('mysql:host=localhost;dbname=fourmisvertes;charset=utf8', 'root', ''
			    		// A ajouter pour traquer les erreurs SQL -Error Call to a member function fetch() on a non-object!-
			    		// , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
			    	);
				}
				catch(Exception $e) {
			        die('Erreur : '.$e->getMessage());
				}
				$different_types = $bdd->query('SELECT DISTINCT type FROM outilspedagogiques');
				while ($onetype = $different_types->fetch()) {
			?>
					<h3 class='tviolet'><?php echo $onetype['type'] ?></h3>
					<div class='bordered bviolet vertical'>
			<?php
					$outilsped = $bdd->query("SELECT * FROM outilspedagogiques WHERE type='$onetype[type]'");
					while ($outil = $outilsped->fetch()) {
			?>
						<div class='thebody horitoverti'>
					    	<p style='width:30%;'>
					    		<a class='lienressource' href=<?php echo $outil['lien'] ?> ><strong> <?php echo $outil['nom'] ?> </strong></a>
						    </p>
						    <p style='width:70%; '>
						    	<?php echo $outil['commentaire'] ?>
						    </p>
						    	<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'true') { ?>
							    	<form enctype="multipart/form-data" method="post" action="actions/deleteoutil.php">
										<p>
											<input type="hidden" name="outilid" value=<?php echo "'" . $outil['id'] . "'" ?> />
											<input type="submit" value="Supprimer">
										</p>
									</form>
								<?php } ?>
							</br>
						</div>
			<?php
					}
					$outilsped->closeCursor(); // Termine le traitement de la requête
					?></div><?php
				}
				$different_types->closeCursor(); // Termine le traitement de la requête
			?>

			<?php
				if (isset($_SESSION['admin']) && $_SESSION['admin']=='true') { ?>
					<form enctype="multipart/form-data" method="post" action="actions/createoutil.php">
						<p>
							<input type="varchar" name="nom" value="nom" />
							<input type="varchar" name="type" value="type(Liens Web, Revues & livres adultes...)" />
							<input type="text" name="commentaire" value='commentaire'>
							<input type="text" name="lien" value='lien'>
							<input type="submit" value="Ajouter un outil">
						</p>
					</form>	<?php
				}
			?>
		<?php include "partials/footer.html";?>
	</div>
</body>
</html>