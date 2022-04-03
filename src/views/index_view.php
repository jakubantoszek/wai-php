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

			<div class="head">
				Spis treści
			</div>
			
				<ul>
					<li><a href="#coto" id="l1" class="navigation">Co to jest gitara?</a></li>
					<li><a href="#technika" id="l3" class="navigation">Technika gry</a></li>
					<li><a href="#ankieta" id="l4" class="navigation">Formularz wysyłania</a></li>
					<li><a href="#sites" id="l5" class="navigation">Linki</a></li>
				</ul>
			
			<div id="coto">
			
				<div class="head">
					Co to jest gitara?
				</div>
			
					<p class="main">Gitara to instrument muzyczny z grupy strunowych szarpanych z pudłem rezonansowym, gryfem i progami na podstrunnicy. Przeważnie ma 6 strun, lecz można spotkać również gitary z czterema, pięcioma, siedmioma, ośmioma, dziesięcioma lub dwunastoma strunami. Instrument ten odgrywa ważną rolę w muzyce bluesowej, country, flamenco, popowej oraz przede wszystkim w szeroko pojętej muzyce rockowej i metalowej, której jest niezastąpionym elementem.</p>
					
					<p>Instrument ten transponuje o oktawę w dół, tzn. wszystkie dźwięki zapisane w nutach brzmią na gitarze oktawę niżej niż wynikałoby to z zapisu nutowego. Gitary są wykonywane i naprawiane przez lutników, a obecnie w coraz większym stopniu maszynowo, jednak najlepszej jakości instrumenty są nadal wykonywane ręcznie bądź z dużym udziałem człowieka. Przez wielu krytyków muzycznych za najlepszego i najbardziej wpływowego gitarzystę w historii muzyki rozrywkowej uważany jest amerykański gitarzysta Jimi Hendrix. Większość znanych gitarzystów na świecie wzorowała się właśnie na nim.</p>

			</div>
				
			<div id="technika">
			
				<div class="head">
					Technika gry
				</div>
			
					<p class="main">Najbardziej rozpowszechniony strój gitarowy to tzw. strój klasyczny – EADGHe (Standard E), który jest wykorzystywany we wszystkich gatunkach muzycznych. Gitarzyści często jednak przestrajają instrument w celu osiągnięcia nowych brzmień. Muzycy rockowi i metalowi często używają gitar nastrojonych niżej od standardowej tonacji. W niektórych z nich interwały pomiędzy dźwiękami na pustych strunach pozostają niezmienne, jednak bardzo często gitarzyści obniżają najniższą strunę bardziej niż pozostałe (Drop B, Drop C#, Drop D). </p>
					
					<p>Często stosuje się również tzw. stroje otwarte, w których struny nastrojone są do dźwięków danego akordu. Dzięki temu np. w stroju Open A  można zagrać akord A-dur bez przyciskania żadnej struny do progów. Stroje otwarte często używane są przez muzyków folkowych, country i bluesowych do grania techniką slide.</p>

			</div>	
				
			<div id="ankieta">
			
				<div class="head">
					Formularz wysyłania
				</div>	
				
				<form action="upload" method="post" enctype="multipart/form-data">

					<p>
						Dodaj zdjęcia do swojej galerii (tylko pliki JPG i PNG)
						</br>Maksymalny rozmiar pliku : 1 MB
					</p>
					<input type="file" name="plik" required />
					</br></br>
					<div id="field">
						<div class="quest">Tytuł zdjęcia
						</div>
						<input type="text" name="title" required>
					</div>
					</br>
					<div id="field">
						<div class="quest">Autor zdjęcia</div>
						<?php if ($zalogowany == 1): ?>	
							<input type="text" name="author" value="<?= $_SESSION['user'] ?>" disabled>
						<?php else: ?>
							<input type="text" name="author" required>
						<?php endif ?>
					</div>
					</br>
					
					<div id="field">
						<div class="quest">Znak wodny</div>
						<input type="text" name="watermark" required>
					</div>
					
					<?php if ($zalogowany == 1): ?>
						</br>
						<label><input type="radio" name="private" value="0" checked>publiczne</label> 
						<label><input type="radio" name="private" value="1">prywatne</label> 
						</br>
					<?php endif ?>
					
					<div id="field2">
						<div class="sub"><input type="submit" value="Wyślij" id="wyslij" name="submit" style="margin:10px 0px 0px 0px;"></div>
						<div style="clear:both;"></div>
					</div>
				</form>	
				
				<?php if (isset($_SESSION['text'])): ?>
					<div style="margin-top:12px;">
						<?= $_SESSION['text'] ?>
					</div>
				<?php endif ?>
			</div>	
				
			<div style="padding:5px;"></div>	

			<div id="sites">
			
				<div class="head">
					Linki
				</div>
			
					<ul>
						<li><a href="wyszukiwarka" class="wyszukiwarka">Wyszukiwarka zdjęć</a></li>
					
						<li>
							Strony z tabulaturami
							<ul>
								<li><a href="https://www.songsterr.com/" target="_blank" class="ods1">songsterr.com</a></li>
								<li><a href="https://www.ultimate-guitar.com/" target="_blank" class="ods1">ultimate-guitar.com</a></li>
								<li><a href="http://chords.pl/" target="_blank" class="ods1">chords.pl</a></li>
							</ul>
						</li>
						
						<li>
							Sklepy muzyczne
							<ul>
								<li><a href="https://www.muziker.pl/" target="_blank" class="ods1">muziker.pl</a></li>
								<li><a href="https://muzyczny.pl/" target="_blank" class="ods1">muzyczny.pl</a></li>
								<li><a href="https://riff.net.pl/" target="_blank" class="ods1">riff.net.pl</a></li>
							</ul>
						</li>
					</ul>
			
			</div>
		
		</main>

		<footer>
			<div id="foot">Moje hobby - gitary; Autor: Jakub Antoszek</div>
		</footer>
	</div>

</body>

</html>