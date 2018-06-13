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
		<div class='vertical'>
			<?php
				try {
				    $bdd = new PDO('mysql:host=localhost;dbname=fourmisvertes;charset=utf8', 'root', ''
				   		// A ajouter pour traquer les erreurs SQL -Error Call to a member function fetch() on a non-object!-
				   		// , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				   	);
				} catch(Exception $e) {
			        die('Erreur : ' //.$e->getMessage()
			    	);
				}
				$different_types = $bdd->query('SELECT DISTINCT type FROM partenaires');
				while ($onetype = $different_types->fetch()) {
			?>
					<h3 class='tviolet'><?php echo $onetype['type'] ?></h3>
					<div style='display:flex; margin:10px; padding:10px;' class='horitoverti'>
			<?php
					$partenaires = $bdd->query("SELECT * FROM partenaires WHERE type='$onetype[type]'");
					$i = 0;
					while ($partenaire = $partenaires->fetch()) {
						$i += 1
			?>
						<div class='thebody respon33to100'>
							<div style='width:50%;text-align:right;margin-right:15px;'>
						    		<?php echo $partenaire['nom'] ?>
						    </div>
						    <div style='width:50%;'><img src=<?php echo "'images/partenaires/" . $partenaire['logo'] . "'" ?> style='float:left;width:auto;max-height:30px;'>
						    </div>
						    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'true') { ?>
							    <form enctype="multipart/form-data" method="post" action="actions/deletepartenaire.php">
									<p>
										<input type="hidden" name="partenaireid" value=<?php echo "'" . $partenaire['id'] . "'" ?> />
										<input type="submit" value="Supprimer">
									</p>
								</form>
							<?php } ?>
						</div>
			<?php
						if ($i % 3 == 0) {
							?></div><div style='display:flex; margin:10px; padding:10px;'><?php
						}
					}
					$partenaires->closeCursor();
					?></div><?php
				}
				$different_types->closeCursor();
			?>

			<?php
				if (isset($_SESSION['admin']) && $_SESSION['admin']=='true') { ?>
					<form enctype="multipart/form-data" method="post" action="actions/createpartenaire.php">
						<p>
							<input type="varchar" name="nom" value="nom" />
							<input type="varchar" name="type" value="type(Financement, Villes...)" />
							<input type="file" name="logo">
							<input type="submit" value="Ajouter un partenaire">
						</p>
					</form>	<?php
				}
			?>
		</div>
		<?php include "partials/footer.html";?>
	</div>
</body>
</html>