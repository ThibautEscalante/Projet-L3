<?php
function getBD(){
$bdd = new PDO('mysql:host=localhost;dbname=energie;charset=utf8',
'root', '');
return $bdd;
}
?>