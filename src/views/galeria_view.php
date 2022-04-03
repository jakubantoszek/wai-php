<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Moje hobby - gitary</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" href="static/style.css" type="text/css"/>
	<link rel="shortcut icon" href="#" />
</head>

<body>

	<div id="container">
		<header>
			<div id="text">Moje hobby - gitary</div>
		</header>

		<?php include_once 'partial/nav.php'; ?>
		
		<main>
		
		<?php if ($total > 0): ?>
			<div class="site">
				Strona <?= $_SESSION['strona'] ?>
			</div>
			
			<?php require_once 'partial/gallery.php' ?>
				
			<div style="clear:both;"></div>

			<div id="paging" style="min-height:60px;">
				<?php if ($_SESSION['strona'] > 1): ?>
					<a href="change&n=-1"><button class="strony" style="float:left;">Poprzednia strona</button></a>
				<?php endif ?>
				
				<?php if ($_SESSION['strona'] < $pageNumber): ?>
					<a href="change&n=1"><button class="strony" style="float:right;">Następna strona</button></a>
				<?php endif ?>
			</div>	
		
		<?php else: ?>
			<p>Brak zdjęć w galerii</p>
		<?php endif ?>
			
		</main>

		<footer>
			<div id="foot">Moje hobby - gitary; Autor: Jakub Antoszek</div>
		</footer>
	</div>

</body>

</html>