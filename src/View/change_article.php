<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
    <form action="" method="POST">
        <label>
            Nouveau Titre
            <input type="text" name="titre" value="">
        </label>
        <label>
            Nouveau Prix
            <input type="text" name="prix" value="">
        </label>
        <input type="submit">
    </form>
<?php

require __DIR__ . '/../Entity/ArticleManager.php';
require __DIR__ . '/../Entity/DBA.php';
$id = $_GET['articleid'];


if(isset($_POST['titre'])  && isset($_POST['prix'])){

    $dba = new DBA();
    $am = new ArticleManager($dba->getPDO());

    $titre = $_POST['titre'];
    $prix = $_POST['prix'];


    $am->update($titre, $prix, $id);
    echo "changement réussi, revenez à la page précedente et rafraichissez là";
}
