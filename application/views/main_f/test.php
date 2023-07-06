<?php

$params1 = array(
	'user_id' => '123456',
	'fullname' => 'Siti harianinini',
	'email' => '123444@gmail.com',
	'password' => '123456'
);

$params2 = serialize($params1);
$serialize = base64_encode($params2);
dbug($serialize);

dbug(unserialize(base64_decode($serialize)));

$unserialize = unserialize(base64_decode($serialize));

dbug($unserialize['password']);

?>