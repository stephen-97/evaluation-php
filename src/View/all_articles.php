<?php

require __DIR__ .'./../Entity/ArticleManager.php';
require __DIR__ .'./../Entity/DBA.php';

echo "<h2 style='position:relative; margin-top: 10%; margin-left: 20'>Liste de tout les articles en vente : </h2>";

$dba = new DBA();
$am = new ArticleManager($dba->getPDO());

$data = $am->getArticles();
foreach ($data as $key => $value){
    echo "<div style='background-color: aquamarine; flex-direction: row ;align-items: stretch; display: flex; position: relative; margin: 20;  border-radius: 10px;'>
            <div style=' flex:1; width: 50%; padding:30; overflow: hidden; font-size: 30px; border-radius: 10px; background-color: #2ef0f6; left:5%; bottom: 50%;'><span style='color:gray'>Titre : </span>  $value[1]</div>
            <div style='  flex:1; padding:30; overflow: hidden; font-size: 30px; border-radius: 10px; border-radius: 10px;background-color:#00fbc9; left:25%; bottom:50%'> <span style='color:gray'>Prix : </span> $value[2]€</div>
            <div style='  flex:1;  padding:30; overflow: hidden; font-size: 30px; border-radius: 10px; border-radius: 10px;background-color:#82e4ce; left:25%; bottom:50%'> <span style='color:gray'>Vendeur : </span> $value[3]</div>
          </div>";
}