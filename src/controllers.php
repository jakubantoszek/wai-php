<?php

require_once 'business.php';

function account(&$model)
{	
	unsetSite();
	
	$zalogowany = zalogowany();
	if($zalogowany == 0)
		return 'redirect:logowanie';
	
	$model['zalogowany'] = $zalogowany;
	
	return 'account_view';
}

function index(&$model)
{	
	unsetSite();
	errorText('double_indError', 'text');
	
	$zalogowany = zalogowany();
	$model['zalogowany'] = $zalogowany;
	
	return 'index_view';
}

function galeria(&$model)
{
	setSite(true);
	$strona = $_SESSION['strona'];
	
	$zalogowany = zalogowany();
	if($zalogowany == 0)
		$query = ['private' => 0];
		
	else
		$query = [
			'$or' => [
				['private' => 0],
				['private' => 1, 'zalogowany' => 1, 'author' => $_SESSION['user']]
			]
		];

	$limit = 9;
	$opts = [
		'skip' => ($strona - 1) * $limit,
		'limit' => $limit
	];

	if(getImages($query, $opts)){
		$images = getImages($query, $opts);
		$total = countImages($query);
	}
	
	else {
		http_response_code(404);
		exit;
	}
	
	$_SESSION['favourites'] = false;
	$pageNumber = intdiv($total, $limit);

	if($total % $limit != 0)
		$pageNumber = $pageNumber + 1;

	$puste = 0;
	if($strona == $pageNumber)	
		$puste = 3 - ($total - intdiv($total, 3) * 3);
	
	if($puste == 3)
		$puste = 0;
	
	$model['images'] = $images;
	$model['total'] = $total;
	$model['pageNumber'] = $pageNumber;
	$model['puste'] = $puste;
	$model['zalogowany'] = $zalogowany;
	
	return 'galeria_view';
}

function isChecked($id)
{
	$checked = 0; 
	if(isset($_SESSION['checked']))
		foreach($_SESSION['checked'] as $image_id){
			if($image_id == $id)
				$checked = 1;
		}  
	
	return $checked;
}

function changeSite()
{	
	if(isset($_SESSION['favourites']) && (isset($_GET['n'])))
	{
		$n = $_GET['n'];
		$_SESSION['strona'] = $_SESSION['strona'] + $n;
		
		if($_SESSION['favourites'] == true)
			return 'redirect:ulubione';
		else return 'redirect:galeria';
	}
	
	else{
		http_response_code(404);
		exit;
	}
}

function logowanie(&$model)
{
	$zalogowany = zalogowany();
	
	if($zalogowany == 1)
		return 'redirect:account';
	
	unsetSite();
	errorText('double_logError', 'login_failed');
	
	$model['zalogowany'] = $zalogowany;
	return 'logowanie_view';
}

function login()
{
	if(isset($_POST['login']))
		$login = $_POST['login'];
	else return 'redirect:logowanie';
	
	if(search_users())
		$uzytkownicy = search_users();
	else
	{
		http_response_code(404);
		exit;
	}
	
	foreach ($uzytkownicy as $konto) {
		if(($konto['login'] == $login) && (password_verify($_POST['pwd'], $konto['pwd'])))
		{
			$_SESSION['zalogowany'] = true;
			$_SESSION['user'] = $login;
			$_SESSION['mail'] = $konto['mail'];
		}
	}
	
	if(!isset($_SESSION['zalogowany']))
		$_SESSION['login_failed'] = '<span class="bad">Niepoprawny login lub haslo</span>';
	
	unset($_SESSION['double_logError']);
	
	return 'redirect:logowanie';
}

function logout()
{	
	if(!isset($_SESSION['zalogowany']))
		return 'redirect:logowanie';

	unset($_SESSION['zalogowany']);
	unset($_SESSION['mail']);
	unset($_SESSION['user']);
	unset($_SESSION['login_failed']);
	unset($_SESSION['checked']);
	
	return 'redirect:logowanie';
}

function register(&$model)
{
	$zalogowany = zalogowany();
	
	if($zalogowany == 1)
		return 'redirect:account';
	
	unsetSite();
	errorText('double_regError', 'register_text');
	
	$model['zalogowany'] = $zalogowany;
	return 'register_view';
}

function ulubione(&$model)
{
	$zalogowany = zalogowany();
	setSite(false);
	
	$total = 0;
	if(isset($_SESSION['checked']))
		$total = count($_SESSION['checked']);
	
	if((!isset($_SESSION['checked'])) || ($total == 0))
	{
		$model['total'] = 0;
		$model['zalogowany'] = $zalogowany;
		return 'ulubione_view';
	}
	
	$limit = 9;
	$pageNumber = intdiv($total, $limit);

	if($total % $limit != 0)
		$pageNumber = $pageNumber + 1;	
						
	if($_SESSION['strona'] > $pageNumber)
		$_SESSION['strona'] = $pageNumber;	
	$strona = $_SESSION['strona'];	
						
	$puste = 0;
	if($strona == $pageNumber)	
		$puste = (3 - $total % 3) % 3;

	$begin = ($strona - 1) * $limit;
	$end = 0;
	
	if($strona == $pageNumber)
		$end = $total - 1;
	else $end = ($strona * $limit) - 1;
	
	for($i = $begin; $i <= $end; $i++){
		$images[$i] = findFavourite($_SESSION['checked'][$i]);
	}
	
	$_SESSION['favourites'] = true;	
	
	$model['total'] = $total;
	$model['pageNumber'] = $pageNumber;
	$model['puste'] = $puste;
	$model['begin'] = $begin;
	$model['end'] = $end;
	$model['zalogowany'] = $zalogowany;
	$model['images'] = $images;
	
	return 'ulubione_view';
}

function wyszukiwarka(&$model)
{
	unsetSite();
	
	$zalogowany = zalogowany();
	$model['zalogowany'] = $zalogowany;
	
	return 'wyszukiwarka_view';
}

function search()
{
	if(isset($_GET['q']))
		$q = $_GET['q'];
	else return 'redirect:register';
	
	$zalogowany = zalogowany();
	if($zalogowany == 0)
		$query = ['name' => new MongoDB\BSON\Regex($q, 'i'), 'private' => 0];
	
	else $query = [
			'$or' => [
				['private' => 0],
				['private' => 1, 'zalogowany' => 1, 'author' => $_SESSION['user']]
			],
			'name' => new MongoDB\BSON\Regex($q, 'i')
		];
	
	if(getImages($query, 0))
	{
		$images = getImages($query, 0);
		$total = countImages($query);
	}
	
	else 
	{
		http_response_code(404);
		exit;
	}
	
	if($total > 0)
	{
		foreach ($images as $image){
			echo '
				<div class="uploaded_image">
					<a href="static/'. $image['watermarked'] .' ">
						<img src="static/'. $image['miniatura']. ' "></img>
					</a>
					<div class="opis">
						Tytuł : ' . $image['name'] . '</br>
						Autor : ' . $image['author'];
						
					if($image['private'] == 1)
						echo '</br>zdjęcie prywatne';
					
				echo '	
					</div>
				</div>
			 ';
		}
		echo '<div style="clear:both;"></div>';
	}
	else echo '<p style="margin-bottom:20px;">Nie znaleziono zdjęć</p>';
}

function addUser()
{
	if(!isset($_POST['e-mail']))
		return 'redirect:register';

	$mail = $_POST['e-mail'];
	$login = $_POST['login'];
			
	if(search_users())
		$zajety = search_users();
	else 
	{
		http_response_code(404);
		exit;
	}
	
	$dostepnosc_loginu = 1;
	$dostepnosc_maila = 1;
	foreach ($zajety as $konto) {
		if($konto['login'] == $login)
			$dostepnosc_loginu = 0;
		if($konto['mail'] == $mail)
			$dostepnosc_maila = 0;
	}

	if($dostepnosc_loginu + $dostepnosc_maila == 2)
	{
		if($_POST['pwd'] == $_POST['pwd2'])
		{
			$password = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
			
			$user = [
				'mail' => $mail,
				'login' => $login,
				'pwd' => $password
			];		
			
			save_user($user);
			$_SESSION['register_text'] = "
				<span class='good'>
					Konto zostało utworzone. Możesz się już 
					<a href='logowanie' class='log'> zalogować.</a>
				</span>
			";
		}

		else $_SESSION['register_text'] = '<span class="bad">Hasła nie są identyczne</span>';
	}

	else 
	{	
		if($dostepnosc_loginu + $dostepnosc_maila == 0)
			$_SESSION['register_text'] = '<span class="bad">Nazwa użytkownika i adres e-mail są już zajęte</span>';

		else if($dostepnosc_loginu == 0)
			$_SESSION['register_text'] = '<span class="bad">Nazwa użytkownika jest zajęta</span>';
		else $_SESSION['register_text'] = '<span class="bad">Podany adres e-mail jest zajęty</span>';
	}
	
	unset($_SESSION['double_regError']);
	
	return 'redirect:register';
}

function deleteFromFavourites()
{
	if((isset($_POST['wybrane'])) && (isset($_SESSION['checked'])))
	{
		foreach ($_POST['wybrane'] as $image_id)
		{
			$key = array_search($image_id, $_SESSION['checked']);
			\array_splice($_SESSION['checked'], $key, 1);
		}
	}
	
	return 'redirect:ulubione';
}

function addToFavourites()
{
	if(isset($_POST['wybrane']))
	{	
		if(isset($_SESSION['checked']))
		{
			$pom = $_SESSION['checked'];
			$_SESSION['checked'] = array_merge($pom, $_POST['wybrane']);
		}
		else $_SESSION['checked'] = $_POST['wybrane'];
	}
	
	return 'redirect:galeria';
}

function editImage($typ, $target, $text)
{
	addWatermark($typ, $target, $text);
	resizeImage($typ, $target);
}
	
function addWatermark($typ, $imageURL, $text)
{
	header('Content-Type: '.$typ);
		
	if($typ == 'image/png') 
		$originalImage = imagecreatefrompng($imageURL);
	else $originalImage = imagecreatefromjpeg($imageURL);
		
	list($width,$height) = getimagesize($imageURL);
	$newImage = imagecreatetruecolor($width, $height);
	imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $width, $height, $width, $height);

	$szary = imagecolorallocate($newImage, 128,128,128);
	$czarny = imagecolorallocate($newImage, 0,0,0);
	$font = 'static/Lato-Black.ttf';
		
	$w = $width * 0.7;
	$h = $height * 0.9;
	$size = $width / 40;

	imagettftext($newImage, $size, 20, $w + 1, $h + 1, $czarny, $font, $text);
	imagettftext($newImage, $size, 20, $w, $h, $szary, $font, $text);
	$target = "static/images/watermarked/" . basename($_FILES["plik"]["name"]);
		
	if($typ == 'image/png') 
		imagepng($newImage, $target);
	else imagejpeg($newImage, $target);
		
	imagedestroy($newImage);
}
	
function resizeImage($typ, $imageURL)
{
	header('Content-Type: '.$typ);
		
	if($typ == 'image/png') 
		$originalImage = imagecreatefrompng($imageURL);
	else $originalImage = imagecreatefromjpeg($imageURL);
		
	list($width,$height) = getimagesize($imageURL);
	$newImage = imagescale($originalImage, 200, 125);
	$target = "static/images/mini/" . basename($_FILES["plik"]["name"]);
		
	if($typ == 'image/png') 
		imagepng($newImage, $target);
	else imagejpeg($newImage, $target);
		
	imagedestroy($newImage);
}

function upload()
{	
	if (is_uploaded_file($_FILES['plik']['tmp_name']))
	{	
		$name = basename($_FILES["plik"]["name"]);
		$typ = $_FILES['plik']['type'];
		$rozmiar = $_FILES['plik']['size'];
		
		$target = "static/images/" . $name;
		$src = "images/" . $name;
		
		$poprawnosc1 = 1;
		$poprawnosc2 = 1;
		
		if(($typ!='image/png')&&($typ!='image/jpeg'))
			$poprawnosc1 = 0;
		if($rozmiar > 1048576)
			$poprawnosc2 = 0;
			
		if($poprawnosc1 + $poprawnosc2 == 2)
		{
			if (move_uploaded_file($_FILES["plik"]["tmp_name"], $target)) {
				poprawnyObraz($name, $target, $typ);
				$_SESSION['text'] = '<span class="good">Zdjęcie zostało wysłane</span>';
			}
		}
		
		else
			niepoprawnyObraz($_FILES['plik']['name'], $poprawnosc1, $poprawnosc2);
		
		unset($_SESSION['double_indError']);
		
		return 'redirect:index#ankieta';
	}
	
	else {
		http_response_code(404);
		exit;
	}
}

function poprawnyObraz($nazwa, $target, $typ)
{
	$title = $_POST['title'];
	$text = $_POST['watermark'];
	
	if (isset($_POST['author']))
		$author = $_POST['author'];
	else $author = $_SESSION['user'];

	$private = 0;
	if (isset($_POST['private']))
		if($_POST['private'] == 1)
			$private = 1;
	
	editImage($typ, $target, $text);
	$watermarkTarget = "images/watermarked/" . $nazwa;
	$miniTarget = "images/mini/" . $nazwa;
	
	$zalogowany = zalogowany();
	
	$image = [
		'name' => $title,
		'author' => $author,
		'src' => $target,
		'watermarked' => $watermarkTarget,
		'miniatura' => $miniTarget,
		'private' => $private,
		'zalogowany' => $zalogowany
	];
	addImage($image);
}

function niepoprawnyObraz($nazwa, $poprawny_typ, $poprawny_rozmiar)
{
	if($poprawny_rozmiar == 0)
		$_SESSION['error_text'] = 'Wybrany plik ma zbyt duży rozmiar';
	
	if($poprawny_typ == 0)
		$_SESSION['error_text'] = 'Wybrany plik ma niepoprawny format';
	
	if($poprawny_typ + $poprawny_rozmiar == 0)
		$_SESSION['error_text'] = 'Wybrany plik ma zbyt duży rozmiar i niepoprawny format';
	
	$_SESSION['text'] = '<span class="bad">'.$_SESSION['error_text'].'</span>';
}

function zalogowany()
{
	$zalogowany = 0;
	if (isset($_SESSION['zalogowany']))
		if($_SESSION['zalogowany'] == true)
			$zalogowany = 1;
	
	return $zalogowany;
}

function unsetSite()
{
	if (isset($_SESSION['strona']))
		unset($_SESSION['strona']);
}

function errorText($error, $text)
{
	if (isset($_SESSION[$text]))
	{
		if(isset($_SESSION[$error]))
		{
			unset($_SESSION[$text]);
			unset($_SESSION[$error]);
		}
		else $_SESSION[$error] = 1;
	}
}

function setSite($tf)
{
	if(isset($_SESSION['favourites']))
		if($_SESSION['favourites'] == $tf)
			$_SESSION['strona'] = 1;

	if (!isset($_SESSION['strona']))
		$_SESSION['strona'] = 1;
}

?>
