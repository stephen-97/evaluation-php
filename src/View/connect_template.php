<h1 style="background-color: aquamarine; padding: 20;margin: 50; font-size: 20;">Page de connexion</h1>

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


    require __DIR__ . '/../Entity/AccountManager.php';
    require __DIR__ . '/../Entity/DBA.php';
    $dba = new DBA();
    $am = new AccountManager($dba->getPDO());

    if($am->getAccountValues($email, $password)){
        echo "<div style='margin-left:5%; margin-top: 30'>
                   <a style=' ;background-color: aquamarine; text-decoration:none; padding:20 20 20 20' href='userPage.php?did=".$email."'>Connextion réussi! Cliquez ICI pour accèder à votre espace</a>
              </div>";
    }
    else{
        echo "<div style='color:red; margin-left: 5%'>mot de passe ou identifiant invalide</div>";
    }
}
?>

<div style="margin:5%; margin-top: 10%">
    <a style="text-decoration:none; color:black; background-color: aquamarine; position: relative; font-size: 20; padding: 20 50 20 50" type="submit" href='../../index.php'>Retour à la page principale </a>
</div>
