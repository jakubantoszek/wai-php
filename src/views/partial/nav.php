<nav>
		
	<ol>
		<li>
			<a href="index">Strona główna</a>
		</li>
		<li>
			<a href="ulubione">Ulubione</a>
		</li>
		<li>
			<a href="galeria">Galeria</a>
		</li>
		<li>
			<?php if ($zalogowany == 0): ?>
				<a href="logowanie">Zaloguj się</a>
			<?php else: ?>
				<a href="account">Konto</a>
			<?php endif ?>
		</li>
	</ol>
			
	<div id="navi">
		<a href="index"><div class="nvg">Strona główna</div></a>
		<a href="ulubione"><div class="nvg">Ulubione</div></a>
		<div style="clear:both;"></div>
		<a href="galeria"><div class="nvg">Galeria</div></a>
		<?php if ($zalogowany == 0): ?>
			<a href="logowanie"><div class="nvg">Zaloguj się</div></a>
		<?php else: ?>
			<a href="account"><div class="nvg">Konto</div></a>
		<?php endif ?>
		<div style="clear:both;"></div>
	</div>

</nav>