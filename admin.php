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
		<form method="post" action="actions/adminconnect.php">
			<p>
				<input type="text" name="nom" value="" />
				<input type="text" name="password" value="" />
				<input type="submit" value="Connexion">
			</p>
		</form>
		<?php include "partials/footer.html";?>
	</div>
</body>
</html>