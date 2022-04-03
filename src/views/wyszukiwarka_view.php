<!DOCTYPE HTML>

<html>

<head>
	<meta charset="utf-8" />
	<title>Moje hobby - gitary</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" href="static/style.css" type="text/css"/>
	<script type="text/javascript" src="static/search.js"></script>
</head>

<body>

	<div id="container">
		<header>
			<div id="text">Moje hobby - gitary</div>
		</header>

		<?php include_once 'partial/nav.php'; ?>
		
		<main>
			<div class="field">
				<div style="padding-bottom:10px;">Wpisz tytuł zdjęcia, którego szukasz</div>
				<input type="text" name="query" style="font-size:1.2em;" autocomplete="off" onkeyup="search_image(this.value)"/>
			</div>
			
			<div id="result">
			</div>
		</main>
		
		<footer>
			<div id="foot">Moje hobby - gitary; Autor: Jakub Antoszek</div>
		</footer>
	
	</div>

</body>

</html>