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
		<?php if(isset($_SESSION['admin']) && $_SESSION['admin']=='true'){echo 'Vous êtes connecté';} ?>
		<div class='thebody horitoverti'>
			<div class='bordered tvertf prct45 respon90'>
				<h3 class='tvertc'>L'association "les fourmis vertes"</h3>
				<p>Depuis plus de dix ans, les fourmis vertes transmettent leur savoir-faire et leurs convictions auprès d'enfants et d'adultes pour les amener à prendre conscience de notre environnement, de mieux vivre ensemble entre nous et avec le monde du viavant, de l'école à la maison, du quartier à la planète, ... La plupart de nos actions se décomposent en deux temps :</p>
				<ul>
					<li>Sensibilisation, apprentissage par le biais d'outils pédagogiques adaptés : diaporamas, vidéos, théatre, exercices, jeux, travaux pratiques, expériences, visites, ...</li>
					<li>Réalisation d'une production finale de qualité, pour valoriser les acquis, transmettre, entraîner les autres...</li>
				</ul>
				<h3 class='tviolet'>Publics concernés :</h3>
				<ul>
					<li>Scolaires</li>
					<li>Para-scolaires</li>
					<li>Structures de quartier</li>
					<li>Habitants</li>
					<li>Autre</li>
				</ul>
			</div>
			<div class='bordered tvertf prct45 respon90'>
				<h3 class='tvertc'>Présentation de l'API</h3>
				<p class="horizontal">
					<img src="images/vignette-video-api.jpg" alt="Vignette de la vidéo sur l'API" class='responsiveimg'>
					<p class='spacearoundhoriz'>
						<a href="http://new.fourmisvertes.eu/interface/fourmis/video/video-api-version-courte.html"><strong>Version courte</strong></a>
						<a href="http://new.fourmisvertes.eu/interface/fourmis/video/video-api-version-longue.html"><strong>Version longue</strong></a>
					</p>
					<p>L' API est le fruit de plusieurs années d'expérience d'animations sur le terrain. Ce projet, que nous avons imaginé en 2010, a été élaboré en collaboration avec trois bailleurs sociaux et les ESH, répond à des besoins de sensibilisation aux écogestes dans l'habitat auprès d'un public de tout âge.</p>
					<p>Nous intervenons en pied d'immeuble, à la sortie de l'école, ... pour toucher un large public, et mettons tout en oeuvre pour le convaincre de la necessité et de l'utilité de devenir (ou être plus encore) "écocitoyen", pour son propre intérêt économique, pour préserver sa santé ... et celle de notre planète.</p>
				</p> 
			</div>
		</div>
		<div>
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
				$temoignages = $bdd->query('SELECT * FROM temoignages WHERE valid=1 ORDER BY RAND() LIMIT 1');
				$temoignage = $temoignages->fetch()
			?>
			    <div class='bordered' style='margin:0px;background-color:#4dff4d;border-color:#4dff4d;'>
				    <p><< <strong><?php echo $temoignage['content']; ?></strong> >></p>
					<p style='width:100%; text-align:right;'><?php echo $temoignage['nom'] . " ( de " . $temoignage["ville"] . " )"?>
				</div>
			<?php
				$temoignages->closeCursor();
			?>
		</div>
		<?php include "partials/footer.html";?>
	</div>
</body>
</html>