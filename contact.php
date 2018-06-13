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
			<div class='bordered prct45'>
				<h3 class='tvertc'>Nous situer</h3>
				<p><p>Notre siège se situe à la maison des associations, 35/37 avenue de la résistance, 93100 Montreuil.</p></br>

				<p>Notre adresse postale :
				93 rue Alexandre Dumas 75020 Paris</p><br/>

				<p>Pour venir nous voir, notre local se situe au
				79 rue de la réunion, 75020 PARIS
				(métro Alexandre Dumas , Maraicher ou Buzenval)</p><br/>

				<p>Nous n'accueillons pas le public et nous sommes souvent sur le terrain, aussi est-il plus prudent de nous appeler avant de passer :
				06 03 56 27 39  ou  01 43 56 83 96 (attention le répondeur est hors service)</p></br>
				<a href="https://www.google.fr/maps/place/79+Rue+de+la+R%C3%A9union,+75020+Paris/@48.8561515,2.4006007,18z/data=!4m2!3m1!1s0x47e66d887499884f:0x7f8d278f4889ef44"><img src="images/position-maps.jpg" alt="voir sur Google Maps" class='responsiveimg' style='width:100%;'></a>
			</div>
			<div class='bordered prct45'>
				<h3 class='tvertc'>Formulaire de contact</h3>
				<?php include "partials/contact-form.html";?>
			</div>
		</div>
		<?php include "partials/footer.html";?>
	</div>
</body>
</html>