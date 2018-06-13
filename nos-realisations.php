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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
	<div id='allpage'>
		<?php include "partials/header.html";?>
			<strong style="background-color:red;">INVERSER IDS REVERSE QUERY</strong>
		<div class='thebody'>
			<div class='bordered tvertf w100'>
				<h3 class='tvertc'>Productions collectives ou de l'association</h3>
				<p>Quelques exemples de productions collectives, réalisées avec des 			enfants ou adultes, qui après avoir été sensibilisés, après avoir appris, deviennent eux-meme vecteurs de transmission auprès des autres, voisins, amis, famille.</br>
					La création, le jeu, sont des outils ludiques et efficaces pour apprendre 		et faire passer les messages.
				</p>
				<div class="carousel-container">
					<div class="control_prev centr" style="border-style:solid none solid solid;border-color:green;border-radius:30px 0 0 30px;width:50px;"><</div>
					<div class="carousel" style="border-style:solid none solid none;">


						<a class="img3carousel 1" >
							<img src="" class="img3carousel 1" style="width:100%;height:auto;">
						</a>

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
							$reals = $bdd->query('SELECT * FROM realisations');
							$i=2;
							while ($real = $reals->fetch()) {
						?>
								<a class=<?php echo "'img3carousel " . $i . "'" ?> href=<?php echo "'nos-realisations?id=" . $real['id'] . "'" ?> >
							    	<img src=<?php echo "'images/" . $real['photo'] . "'" ?> class=<?php echo "'img3carousel " . $i . "'" ?> style="width:100%;height:auto;max-height:100%;">
							    </a>
						<?php 
								$i++;
							}
							$reals->closeCursor();
						?>



						<a class=<?php echo "'img3carousel " . $i . "'" ?> >
							<img src="" class=<?php echo "'img3carousel " . $i . "'" ?> style="width:100%;height:auto;">
						</a>



					</div>
					<div class="control_next centr" style="border-style:solid solid solid none;border-color:green;border-radius:0 30px 30px 0;width:50px;">></div>
				</div>
				<div style="width:100%;display:flex;justify-content:space-around;">
					<?php for($x=0; $x<=$i/3; $x++) { ?>
						<span style="border-color:green;padding:0px;" class=<?php echo "'bordered " . $x . "'" ?>><?php echo $x+1 ?></span>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
			if(isset($_GET['id'])) {
				try {$bdd = new PDO('mysql:host=localhost;dbname=fourmisvertes;charset=utf8', 'root', '');}
				catch(Exception $e) { die('Erreur : ');}
				$actual = $bdd->prepare('SELECT * FROM realisations WHERE id=?');
				$actual->execute(array($_GET['id']));
				if($a = $actual->fetch()) {
		?>
					<div style="display:flex;justify-content:space-between;width:100%;"><a href=<?php echo "'nos-realisations?id=" . ($_GET['id']-1) . "'" ?>>Précédent</a><a href=<?php echo "'nos-realisations?id=" . ($_GET['id']+1) . "'" ?>>Suivant</a></div>
					<div class='bordered tvertf horitoverti'>
						<h3><?php echo $a['nom'] ?></h3>
						<p><?php echo $a['description'] ?></p>
						<img src=<?php echo "'images/" . $a['photo']. "'" ?> style="max-width:100%;">
						<?php if(isset($_SESSION['admin']) && $_SESSION['admin']=='true') { ?>
				    		<form enctype="multipart/form-data" method="post" action="actions/deleterealisation.php">
								<p>
									<input type="hidden" name="realid" value=<?php echo "'" . $a['id'] . "'" ?> />
									<input type="submit" value="Supprimer">
								</p>
							</form>
						<?php } ?>
					</div>
		<?php	}
			}
		?>
		<?php
			if (isset($_SESSION['admin']) && $_SESSION['admin']=='true') { ?>
				<form enctype="multipart/form-data" method="post" action="actions/createrealisation.php">
					<p>
						<input type="varchar" name="nom" value="nom" />
						<input type="text" name="description" value="description" />
						<input type="file" name="photo">
						<input type="submit" value="Ajouter une réalisation">
					</p>
				</form>	<?php
			}
			?>
		<?php include "partials/footer.html";?>
	</div>
</body>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		var carousel = document.querySelector('.carousel-container');
		items = carousel.querySelectorAll('img');
		counter = 1;
		if (document.documentElement.clientWidth > 750) {
		
		    function moveLeft() {
		    	counter--
				if(counter<=0) {
					counter=items.length-3;
					document.getElementsByClassName(1)[0].className = "img3carousel 1";
					document.getElementsByClassName(2)[0].className = "img3carousel 2";
					document.getElementsByClassName(3)[0].className = "img3carousel 3";
					document.getElementsByClassName(4)[0].className = "img3carousel 4";

					document.getElementsByClassName(items.length)[0].className = "img2carousel " + items.length;
					document.getElementsByClassName(items.length-1)[0].className = "img1carousel " + (items.length-1);
					document.getElementsByClassName(items.length-2)[0].className = "img1carousel " + (items.length-2);
					document.getElementsByClassName(items.length-3)[0].className = "img2carousel " + (items.length-3);
		    	} else {
			        document.getElementsByClassName(counter+4)[0].className = "img3carousel " + (counter+4);
			        document.getElementsByClassName(counter+3)[0].className = "img2carousel " + (counter+3);
			        document.getElementsByClassName(counter+1)[0].className = "img1carousel " + (counter+1);
			        document.getElementsByClassName(counter)[0].className = "img2carousel " + counter;
		    	}
		    };

		    function moveRight() {
				counter++
				if(counter>=items.length-2) {
					counter=1;
					document.getElementsByClassName(items.length-1)[0].className = "img3carousel " + (items.length-1);
					document.getElementsByClassName(items.length-2)[0].className = "img3carousel " + (items.length-2);
					document.getElementsByClassName(items.length-3)[0].className = "img3carousel " + (items.length-3);
					document.getElementsByClassName(items.length)[0].className = "img3carousel " + items.length;

					document.getElementsByClassName(1)[0].className = "img2carousel 1";
					document.getElementsByClassName(2)[0].className = "img1carousel 2";
					document.getElementsByClassName(3)[0].className = "img1carousel 3";
					document.getElementsByClassName(4)[0].className = "img2carousel 4";
				} else {
			        document.getElementsByClassName(counter-1)[0].className = "img3carousel " + (counter-1);
			        document.getElementsByClassName(counter)[0].className = "img2carousel " + counter;
			        document.getElementsByClassName(counter+2)[0].className = "img1carousel " + (counter+2);
			        document.getElementsByClassName(counter+3)[0].className = "img2carousel " + (counter+3);
		    	}
		    };

		    function initialize() {
					document.getElementsByClassName(1)[0].className = "img2carousel 1";
					document.getElementsByClassName(2)[0].className = "img1carousel 2";
					document.getElementsByClassName(3)[0].className = "img1carousel 3";
					document.getElementsByClassName(4)[0].className = "img2carousel 4";
		    };

		} else {

			function moveLeft() {
		    	counter--
				if(counter<=0) {
					counter=items.length-2;
					document.getElementsByClassName(1)[0].className = "img3carousel 1";
					document.getElementsByClassName(2)[0].className = "img3carousel 2";
					document.getElementsByClassName(3)[0].className = "img3carousel 3";

					document.getElementsByClassName(items.length)[0].className = "img2carouselt " + items.length;
					document.getElementsByClassName(items.length-1)[0].className = "img1carouselt " + (items.length-1);
					document.getElementsByClassName(items.length-2)[0].className = "img2carouselt " + (items.length-2);
		    	} else {
			        document.getElementsByClassName(counter+3)[0].className = "img3carousel " + (counter+3);
			        document.getElementsByClassName(counter+2)[0].className = "img2carouselt " + (counter+2);
			        document.getElementsByClassName(counter+1)[0].className = "img1carouselt " + (counter+1);
			        document.getElementsByClassName(counter)[0].className = "img2carouselt " + counter;
		    	}
		    };

		    function moveRight() {
				counter++
				if(counter>=items.length-1) {
					counter=1;
					document.getElementsByClassName(items.length-1)[0].className = "img3carousel " + (items.length-1);
					document.getElementsByClassName(items.length-2)[0].className = "img3carousel " + (items.length-2);
					document.getElementsByClassName(items.length)[0].className = "img3carousel " + items.length;

					document.getElementsByClassName(1)[0].className = "img2carouselt 1";
					document.getElementsByClassName(2)[0].className = "img1carouselt 2";
					document.getElementsByClassName(3)[0].className = "img2carouselt 3";
				} else {
			        document.getElementsByClassName(counter-1)[0].className = "img3carousel " + (counter-1);
			        document.getElementsByClassName(counter)[0].className = "img2carouselt " + counter;
			        document.getElementsByClassName(counter+1)[0].className = "img1carouselt " + (counter+1);
			        document.getElementsByClassName(counter+2)[0].className = "img2carouselt " + (counter+2);
		    	}
		    };
		    
		    function initialize() {
					document.getElementsByClassName(1)[0].className = "img2carouselt 1";
					document.getElementsByClassName(2)[0].className = "img1carouselt 2";
					document.getElementsByClassName(3)[0].className = "img2carouselt 3";
		    };
		}

		function gotoimg(idimg) {
			if(counter>idimg) {
				while(counter>idimg) {
					moveLeft();
				}
			}else if(counter<idimg) {
				while(counter<idimg && counter < items.length-3) {
					moveRight();
				}
			}
		};

		window.onload = function() {
		   	initialize();
		    setInterval(function(){moveRight();}, 3000);
		};

		$('div.control_prev').click(function () {
	        moveLeft();
	    });

		$('div.control_next').click(function () {
	        moveRight();
	    });

		<?php for($x=0; $x<=$i/3; $x++) { ?>
			$(<?php echo "'span." . $x . "'"?>).click(function () {
				gotoimg(<?php echo 3*$x+1 ?>);
			});
		<?php } ?>

	});

</script>
</html>