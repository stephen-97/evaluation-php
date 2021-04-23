<?php


echo "<h2>L'article a été supprimé, revenez à la page précédente et rafraichisser là.</h2>";

require __DIR__ . '/../Entity/ArticleManager.php';
require __DIR__ . '/../Entity/DBA.php';


$dba = new DBA();
$am = new ArticleManager($dba->getPDO());

$am->deleteArticle($_GET['did']);

