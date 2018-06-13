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
		<h3 class='tvertc'>Revue de Presse</h3>
		<div class='thebody horitoverti'>
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
						$presses = $bdd->query('SELECT * FROM revuedepresse');
						$i = 0;
						while ($presse = $presses->fetch()) {
							$i += 1 ?>
						    <div class='bordered responsive50to90'>
						    	<a href=<?php echo "'images/presse/" . $presse['photo'] . "'" ?>><h3 class='tvertc'><?php echo $presse['nom']; ?></h3>
						    	<img src=<?php echo "'images/presse/" . $presse['photo'] . "'" ?> style='float:left;margin-right:10px;width:100%;height:auto;'>
					    		<?php echo $presse['description']?></a>
					    		<?php if(isset($_SESSION['admin']) && $_SESSION['admin']=='true') { ?>
					    			<form enctype="multipart/form-data" method="post" action="actions/deletepresse.php">
										<p>
											<input type="hidden" name="presseid" value=<?php echo "'" . $presse['id'] . "'" ?> />
											<input type="submit" value="Supprimer">
										</p>
									</form>
									<?php } ?>
					   		</div>
					<?php
							if ($i % 2 == 0) {
								?></div><div class='thebody horitoverti'><?php
							}
						}
		//				$presse->closeCursor();
					?>
				</div>
				<?php
					if (isset($_SESSION['admin']) && $_SESSION['admin']=='true') { ?>
						<form enctype="multipart/form-data" method="post" action="actions/createpresse.php">
							<p>
								<input type="varchar" name="nom" value="nom" />
								<input type="text" name="description" value="description" />
								<input type="file" name="photo">
								<input type="submit" value="Ajouter presse">
							</p>
						</form>	<?php
					}
				?>
		<?php include "partials/footer.html";?>
	</div>
</body>
</html>