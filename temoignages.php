<?php
	session_start();
?>
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
		<div class="thebody" style="flex-direction: column;">
			<form class="pure-form" enctype="multipart/form-data" method="post" action="actions/createtemoignageenattente.php">
				<p>
					Votre témoignage sera en attente de validation par un administrateur.
				</p>
				<p class="horitoverti" style="display:flex;">
					<input type="varchar" style="margin:auto;" name="nom" value="Nom" />
					<input type="varchar" style="margin:auto;" name="ville" value="Ville" />
					<textarea type="text" style="margin:auto;" name="content">Votre témoignage</textarea>
					<input type="submit" style="margin:auto;" style="background-color:#84E106;border-color:#84E106;" value="Ajouter un témoignage">
				</p>
			</form>
			<?php
				try {
			    	$bdd = new PDO('mysql:host=localhost;dbname=fourmisvertes;charset=utf8', 'root', ''
			    		// A ajouter pour traquer les erreurs SQL -Error Call to a member function fetch() on a non-object!-
			    		// , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			    	);
				}
				catch(Exception $e) {
				    // En cas d'erreur, on affiche un message et on arrête tout
			        die('Erreur : ' //.$e->getMessage()
			    	);
				}
				$temoignages = $bdd->query('SELECT * FROM temoignages');
				$i = 1;
				$colors = ['#2a6aff', '#ff2b2b', 'yellow', 'cyan', '#2aff43'];
				while ($temoignage = $temoignages->fetch()) {
					if($temoignage['valid']) {
			?>
					    <div class='bordered' style=<?php echo "'margin:0px;background-color:" . $colors[$i%5] . ";border-color:" . $colors[$i%5] . ";"?>>
						    <p class='tvertc'><< <strong><?php echo $temoignage['content']; ?></strong> >></p>
						    <p style='width:100%; text-align:right;'><?php echo $temoignage['nom'] . " ( de " . $temoignage["ville"] . " )"?>
					    	<?php if(isset($_SESSION['admin']) && $_SESSION['admin']=='true') { ?>
					   			<form enctype="multipart/form-data" method="post" action="actions/deletetemoignage.php">
									<p>
										<input type="hidden" name="temoignageid" value=<?php echo "'" . $temoignage['id'] . "'" ?> />
										<input type="submit" value="Supprimer">
									</p>
								</form>
							<?php } ?>
						</div>
			<?php
						$i++;
					}
				}
				$temoignages->closeCursor();
			?>
			<p style='background-color:red;'>A STYLISER</p>
			<?php
			if(isset($_SESSION['admin']) && $_SESSION['admin']=='true') { ?>
				<p>Témoignages en attente de validation:</p>
				<?php
				try {
			    	$bdd = new PDO('mysql:host=localhost;dbname=fourmisvertes;charset=utf8', 'root', ''
			    		// A ajouter pour traquer les erreurs SQL -Error Call to a member function fetch() on a non-object!-
			    		// , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			    	);
				}
				catch(Exception $e) {
				    // En cas d'erreur, on affiche un message et on arrête tout
			        die('Erreur : ' //.$e->getMessage()
			    	);
				}
				$temoignages = $bdd->query('SELECT * FROM temoignages');
				$i = 1;
				$colors = ['blue', 'red', 'yellow', 'cyan', 'green'];
				while ($temoignage = $temoignages->fetch()) {
					if(!$temoignage['valid']) {
			?>
					    <div class='bordered' style=<?php echo "'margin:0px;width:100%;background-color:" . $colors[$i%5] . ";border-color:" . $colors[$i%5] . ";"?>>
						    <p class='tvertc'><< <strong><?php echo $temoignage['content']; ?></strong> >></p>
						    <p style='width:100%; text-align:right;'><?php echo $temoignage['nom'] . " ( de " . $temoignage["ville"] . " )"?>
				   			<form enctype="multipart/form-data" method="post" action="actions/deletetemoignage.php">
								<p>
									<input type="hidden" name="temoignageid" value=<?php echo "'" . $temoignage['id'] . "'" ?> />
									<input type="submit" value="Supprimer">
								</p>
							</form>
							<form enctype="multipart/form-data" method="post" action="actions/validatetemoignage.php">
								<p>
									<input type="hidden" name="temoignageid" value=<?php echo "'" . $temoignage['id'] . "'" ?> />
									<input type="submit" value="Valider">
								</p>
							</form>
						</div>
			<?php
						$i++;
					}
				}
				$temoignages->closeCursor();
			}
			?>







		</div>
		<?php include "partials/footer.html";?>
	</div>
</body>
</html>