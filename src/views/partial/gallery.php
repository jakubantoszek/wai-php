<form method="post" action="addtofav">
	<?php foreach ($images as $image): ?>
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
							
				<?php if (isChecked($image['_id']) == 1): ?>
					<input type="checkbox" name="wybrane[]" value="<?= $image['_id'] ?>" checked disabled />
				<?php else: ?>
					<input type="checkbox" name="wybrane[]" value="<?= $image['_id'] ?>" />
				<?php endif ?>
			</div>
		</div>
	<?php endforeach ?>
				
	<?php for($i = 0; $i < $puste; $i++): ?>
		<div class="empty"></div>
	<?php endfor ?>
				
	<div id="wyslij">
		<input type="submit" class="gallery" value="Zapamiętaj wybrane"/>
	</div>
		
</form>