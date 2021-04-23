<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



/** Page principale, on appele le premier include pour les deux boutons en haut et le deuxième pour la liste de TOUT les articles dans la BBD**/
echo "<h1>Stephen Loiola Bastos</h1>";

include './connect_or_create_template.php';
include './src/View/all_articles.php';


?>

