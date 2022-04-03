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
		
		<?php if ($total > 0): ?>
		<div class="site">
			Strona <?= $_SESSION['strona'] ?>
		</div>
		
			<form method="post" action="delete">
			
				<?php foreach($images as $image): ?>
					
					<div class="uploaded_image">
						<a href="static/<?= $image['watermarked'] ?>" />
							<img src="static/<?= $image['miniatura'] ?>" class="gitarzysta" />
						</a>
						<div class="opis">
							Tytuł : <?= $image['name'] ?>
							</br>
							Autor : <?= $image['author'] ?>
							<?php if($image['private'] == 1): ?>
								</br>
								zdjęcie prywatne
							<?php endif ?>
							</br>
							
							<input type="checkbox" name="wybrane[]" value="<?= $image['_id'] ?>" />
						</div>
					</div>
					
				<?php endforeach ?>
				
				<?php for($i = 0; $i < $puste; $i++): ?>
					<div class="empty"></div>
				<?php endfor ?>
				
				<div id="wyslij" style="margin-left:300px;">
					<input type="submit" class="gallery" value="Usuń zaznaczone z zapamiętanych"/>
				</div>
		
			</form>
			
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
			<p>Nie wybrano ulubionych zdjęć</p>
		<?php endif ?>
			
		</main>

		<footer>
			<div id="foot">Moje hobby - gitary; Autor: Jakub Antoszek</div>
		</footer>
	</div>

</body>

</html>