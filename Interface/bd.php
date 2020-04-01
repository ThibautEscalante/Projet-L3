<?php
function getBD(){
	$bdd = new PDO('mysql:host=localhost:3308;dbname=energie;charset=utf8','root', '');
	return $bdd;
}
?>