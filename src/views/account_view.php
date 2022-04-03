<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Moje hobby - gitary</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" href="static/style.css" type="text/css"/>
</head>

<body>

	<div id="container">
		<header>
			<div id="text">Moje hobby - gitary</div>
		</header>

		<?php include_once 'partial/nav.php'; ?>

		<main>

			<div id="account">
				Twoje konto
			</div>
			
			<p>
			<?php if (isset($_SESSION['user'])): ?>
				Jesteś zalogowany jako <?= $_SESSION['user'] ?> <br/>
				Twój adres e-mail : <?= $_SESSION['mail'] ?>
			</p>
			<?php else: ?>
				<p>Nie udało się załadować danych użytkownika</p>
			<?php endif ?>
			
			<a href="logout">
				<div id="logout">
					WYLOGUJ SIĘ
				</div>
			</a>
			
			
		</main>

		<footer>
			<div id="foot">Moje hobby - gitary; Autor: Jakub Antoszek</div>
		</footer>
	</div>

</body>

</html>