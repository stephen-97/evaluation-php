<form>
    <form action="" method="get">
        <label>
            Titre
            <input type="text" name="titre" value="">
        </label>
        <label>
            Prix
            <input type="number" name="prix" value="">
        </label>
        <input type="submit">
    </form>
</form>

<?php

if(isset($_GET['titre'])  && isset($_GET['prix'])){

    $dba = new DBA();
    $am = new ArticleManager($dba->getPDO());

    $test = $_GET['titre'];
    $test2 = $_GET['prix'];
    echo $test . ' ' . $test2;

    $article = [
        "titre" => htmlspecialchars($titre = isset($_GET['titre'])?$_GET['titre']:''),
        "prix" => htmlspecialchars($titre = isset($_GET['prix'])?$_GET['prix']:''),
    ];

    $articleObj = new Article($article);
    $am->addArticle($articleObj);
}

