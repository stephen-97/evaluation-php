<h1 style="background-color: aquamarine; padding: 20;margin: 50; font-size: 20;">Page de création de compte</h1>

<h3 style="margin-left: 5%">Si l'email est déjà utilisé,une erreur sera envoyé</h3>

<div style="margin-left: 5%">
    <form action="" method="POST">
        <label>
            Email
            <input type="email" name="email" value="">
        </label>
        <label>
            Mot de passe
            <input type="password" name="password" value="">
        </label>
        <input type="submit">
    </form>
</div>
<?php

if(isset($_POST['email'])  && isset($_POST['password'])){

    $email = $_POST['email'];
    $password = $_POST['password'];


    require __DIR__ . '/../Entity/DBA.php';
    require __DIR__ . '/../Entity/AccountManager.php';
    $dba = new DBA();
    $am = new AccountManager($dba->getPDO());
    if(!$am->isAlreadySetOrNot($email)){
        $am->addAccount($email, $password);
        echo"<div style='margin-left:5%; margin-top: 30'>
                   <a style=' ;background-color: aquamarine; text-decoration:none; padding:20 20 20 20' href='userPage.php?did=".$email."'>Compte créé! Cliquez ICI pour accèder à votre espace</a>
              </div>";
    }
    else{
        echo "<div style='margin-left: 5%; color:red'>Email déjà utilisé! Réessayer.</div>";
    }
}
?>
<div style="margin:5%; margin-top: 10%">
    <a style="text-decoration:none; color:black; background-color: aquamarine; position: relative; font-size: 20; padding: 20 50 20 50" type="submit" href='../../index.php'>Retour à la page principale </a>
</div>
