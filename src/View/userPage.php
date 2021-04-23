<?php

/**
 * Cette page sera la page de l'espace personnel de l'utilisateur, il pourra changer ses données, supprimer ses artciles ou les modifiers.
 *
 */



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>


<div style="margin-top:50; margin-bottom: 50">
<a style="text-decoration:none; color:black; background-color: aquamarine; position: relative; font-size: 20; padding: 20 50 20 50" type="submit" href='../../index.php'>Retour à la page principal (Déconnexion)</a>
</div>



<div style="border-bottom: solid #3a554f"></div>

<h2 style="margin-left: 20">Rajouter un article? </h2>

<div style="margin-left: 20">
    <form action="" method="post">
        <label>
            Titre
            <input type="text" name="titre" value="">
        </label>
        <label>
            Prix
            <input type="text" name="prix" value="">
        </label>
        <input type="submit">
    </form>
</div>
<?php

/** Zone pour le rajout d'un article */

require __DIR__ . '/../Entity/ArticleManager.php';
require __DIR__ . '/../Entity/DBA.php';
require __DIR__ . '/../Entity/AccountManager.php';

$email=$_GET['did'];
$dba = new DBA();
$am = new AccountManager($dba->getPDO());



if(isset($_POST['titre'])  && isset($_POST['prix'])){

    $titre = $_POST['titre'];
    $prix = $_POST['prix'];

    $data = ["prix" => $prix, "titre" => $titre];

    $article = new Article($data);
    $dba = new DBA();
    $am = new ArticleManager($dba->getPDO());


    if(!empty($titre) && !empty($prix)){
        $am->addArticle($article, $email);
        echo "article rajouté! il s'est affiché en bas!";
    }

}
?>


<div style="border-bottom: solid #3a554f"></div>
<br>
<h2 style="margin-left: 20">Mes articles</h2>
<h3 style="margin-left:20">Supprimer des articles de la vente?</h3>
<?php

/** Zone pour les articles de l'utilisateur */

$dba = new DBA();
$am = new ArticleManager($dba->getPDO());
$personnal_article = $am->getUserArticle($email);

if(!count($personnal_article)==0){
    foreach ($personnal_article as $key => $value){
        $id=$value[0];

        echo "<td><a style='margin-left:25' href='delete.php?did=".$id."'>Supprimer</a></td>";

        echo "<td><a style='margin-left:25' href='change_article.php?articleid=".$id."'>Modifier</a></td>";

        echo "<div style='background-color: aquamarine; align-items: stretch; display: flex; position: relative; margin: 20;  border-radius: 10px;'>
                <div style='width: 50%; padding:30; overflow: hidden; font-size: 30px; border-radius: 10px; background-color: #00fb8f; left:5%; bottom: 50%;'> <span style='color:gray'>Titre : </span> $value[1]</div>
                <div style=' flex:1; padding:30; overflow: hidden; font-size: 30px; border-radius: 10px; border-radius: 10px;background-color:#00fbc9; left:25%; bottom:50%'>  <span style='color:gray'>Prix : </span> $value[2]€</div>
              </div>";
    };
}
else{
    echo "<div style='color:cornflowerblue; font-size: 18; margin-bottom: 20; margin-left: 20'> Pas encore d'article, faut en rajouter!</div>";
}


?>

<div style="border-bottom: solid #3a554f"></div>
<br>
<h2 style="margin-left: 20">Modifier mes données? Entrez un nouvel adresse mail et mot de passe</h2>
<div style="margin-left: 20">(Petite paranthèse, en réalité le changement de mail et mot de passe fonctionne mais il n'y a aucuns changement au niveau des articles qui seront toujours associé à l'ancienne adresse mail, par faute de temps
    )</div><br>

<div style="margin-left: 20">
    <form action="" method="post">
        <label>
            Modifier mon email<br>
            <input type="email" name="new_email" value="">
        </label>
        <br>
        <label>
            Modifier mon mot de passe<br>
            <input type="password" name="password" value="">
        </label><br>

        <input type="submit">
    </form>
</div>



<?php


/** zone pour la modification du mot de passe et l'email*/

$dba = new DBA();
$am = new AccountManager($dba->getPDO());
$id = $am->getAccountid($email);

if(isset($_POST['new_email'])  && isset($_POST['password'])){

    $email = $_POST['new_email'];
    $password= $_POST['password'];

    $am->update($email, $password, $id);
    echo "email et mot de passe modifier!";

}


