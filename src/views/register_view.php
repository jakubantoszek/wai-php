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
				Zarejestruj się
			</div>
			
			<div id="logowanie">
				<form method="post" action="adduser">
					<div id="field">
						Adres e-mail:
						<input type="mail" name="e-mail" required>
					</div>
					</br>
					
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
					
					<div id="field">
						Powtórz hasło: 
						<input type="password" name="pwd2" required>
					</div>
					</br>
					
					<input type="submit" value="Utwórz konto"/>
				</form>
				
				<?php if (isset($_SESSION['register_text'])): ?>
					<div class="break">
						<?= $_SESSION['register_text'] ?>
					</div>
				<?php endif ?>
				
				</br>
				Masz już założone konto? <a class="change" href="logowanie">Zaloguj się</a>
				</br></br>
			</div>
		</main>

		<footer>
			<div id="foot">Moje hobby - gitary; Autor: Jakub Antoszek</div>
		</footer>
	</div>

</body>

</html>