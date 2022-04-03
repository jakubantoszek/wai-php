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

			<div class="register">
				Zaloguj się
			</div>
			
			<div class="logowanie">
				<form method="post" action="login">
					<div id="field">
						Login: 
						<input type="text" name="login" required>
					</div>
					</br>
					<div id="field">
						Hasło: 
						<input type="password" name="pwd" required>
					</div>
					</br>
					<input type="submit" value="Zaloguj się"/>
				</form>
				
				<?php if (isset($_SESSION['login_failed'])): ?>
					<div class="break">
						<?= $_SESSION['login_failed'] ?>
					</div>
				<?php endif ?>
				
				</br>
				Nie masz jeszcze konta? <a class="change" href="register">Zarejestruj się</a>
			</div>
			
		</main>

		<footer>
			<div id="foot">Moje hobby - gitary; Autor: Jakub Antoszek</div>
		</footer>
	</div>

</body>

</html>