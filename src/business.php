<?php

require '../../vendor/autoload.php';
	
function get_db()
{
	$mongo = new MongoDB\Client(
		"mongodb://localhost:27017/wai",
		[
			'username' => 'wai_web',
			'password' => 'w@i_w3b',
		]);
	
	  $db = $mongo->wai;

	  return $db;
}

function getImages($query, $opts)
{
	$db = get_db();
	if($opts == 0)
		$images = $db->images->find($query);
	else $images = $db->images->find($query, $opts);
	return $images;
}

function addImage($image)
{
	$db = get_db();
	$db->images->insertOne($image);
}

function countImages($query)
{
	$db = get_db();
	$total = count($db->images->find($query)->toArray());
	return $total;
}

function findFavourite($image_id)
{
	$db = get_db();
	$query = [
		'_id' => new MongoDB\BSON\ObjectID($image_id)
	];
	$image = $db->images->findOne($query);
	return $image;
}

function save_user($user)
{
	$db = get_db();
	$db->users->insertOne($user);
}

function search_users()
{
	$db = get_db();
	$uzytkownicy = $db->users->find();
	return $uzytkownicy;
}

?>