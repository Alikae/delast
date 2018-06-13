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
		<div class='thebody'>
			<div class='vertical'>
				<div class='bordered tvertf' >
					<h3 class='tvertc'>Les Fourmis Vertes</h3>
					<p>Nous modestes petites fourmis, sommes de grandes passionnées, engagées au quotidien sur le terrain. Nos antennes sont très sensibles à la biodiversité de la nature, mais aussi des humains, à l'investissement individuel et collectif de nos lieux de vie, nos quartiers, nos villes.</p><br/>

					<p>Pour nous, sensibiliser à l'environnement est plus qu'un gagne pain, c'est du militantisme.
					Nous transmettons nos valeurs par la créativité car nous sommes persuadées que l'apprentissage ne peut se faire que par la reconnaissance et la valorisation de chacun(e).</p><br/>

					<p>On ne naît pas "éco-citoyen", on le devient, petit à petit, et de modestes changements de comportements peuvent faire boule de neige... Nous n'avons pas de baguette magique, mais nous constatons au fil des années que notre travail porte ses fruits.</p><br/>
				</div>
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
						$fourmis = $bdd->query('SELECT * FROM fourmis');
						$i = 0;
						while ($fourmi = $fourmis->fetch()) {
							$i += 1 ?>
						    <div class='bordered responsive50to90'>
						    	<h3 class='tvertc'><?php echo $fourmi['nom']; ?></h3>
						    	<img src=<?php echo "'images/" . $fourmi['photo'] . "'" ?> style='float:left;margin-right:10px;'>
					    		<strong><?php echo $fourmi['rolestatut']; ?></strong></br><?php echo $fourmi['description']?>
					    		<?php if(isset($_SESSION['admin']) && $_SESSION['admin']=='true') { ?>
					    			<form enctype="multipart/form-data" method="post" action="actions/deletefourmi.php">
										<p>
											<input type="hidden" name="fourmiid" value=<?php echo "'" . $fourmi['id'] . "'" ?> />
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
						$fourmis->closeCursor();
					?>
				</div>
				<?php
					if (isset($_SESSION['admin']) && $_SESSION['admin']=='true') { ?>
						<form enctype="multipart/form-data" method="post" action="actions/createfourmi.php">
							<p>
								<input type="varchar" name="nom" value="nom" />
								<input type="varchar" name="role" value="role" />
								<input type="text" name="description" value="description" />
								<input type="file" name="photo">
								<input type="submit" value="Ajouter une fourmi">
							</p>
						</form>	<?php
					}
				?>
			</div>
		</div>
		<?php include "partials/footer.html";?>
	</div>
</body>
</html>