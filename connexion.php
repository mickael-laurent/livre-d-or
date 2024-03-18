<?php
require 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    //on initialise nos messages d' erreurs
    $loginError = '';

    $passwordError = '';

    $password = htmlentities(trim($_POST['password']));
    //$password = htmlentities(trim(sha1($_POST['password']))); //on securise les données
    $login = htmlentities(trim($_POST['login']));

    // on vérifie les input
    $valid = true;
    if (empty($login)) {
        $loginError = 'Please enter Login';
        $valid = false;
    }
    if (empty($password)) {
        $passwordError = 'Please enter password';
        $valid = false;
    }

    if ($valid) { //si c'est bon, on connecte à la base
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM utilisateurs WHERE login= ? AND password=? ";
        var_dump($sql);
        $q = $pdo->prepare($sql);
        $q->execute(array($login, $password));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if ($data['password'] == $password && $data['login'] == $login) // Acces OK ! s'il y a des data et qu'elle correspondent
        {
            session_start(); //on ouvre la session
            $_SESSION['login'] = $data['login']; //on assigne nos valeurs
            $_SESSION['password'] = $data['password'];
            $_SESSION['nom'] = $data['nom'];
            $_SESSION['prenom'] = $data['prenom'];
            $_SESSION['id'] = $data['id'];
            header('location:./profil.php'); //et on renvoie vers l'index
        } else // Acces refusé on reste sur la page!
        {
            echo '<p>Une erreur s\'est produite 
	    pendant votre identification.<br /> Le mot de passe ou le pseudo 
            entré n\'est pas correcte.</p><p>Cliquez <a href="./connexion.php">ici</a>';
        }
    }

    Database::disconnect();
}

?>



<!DOCTYPE html>
<html lang="en">
<?php
include('./include/head.php');
?>

<body>
    <?php
    include('./include/header.php');
    ?>
    <form method="POST" action="connexion.php">
        <div class="form-group<?php echo !empty($loginError) ? 'error' : ''; ?>">
            <label for="exampleInputEmail1">Login</label>
            <div class="controls">
                <input type="login" class="form-control" id="exampleInputLogin1" name="login" value="admin" aria-describedby="loginHelp" placeholder="Entrer votre login">
                <small id="loginHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                <?php if (!empty($loginError)) : ?><!-- affiche erreur-->
                    <span class="help-inline"><?php echo $loginError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group<?php echo !empty($passwordError) ? 'error' : ''; ?>">
            <label for="exampleInputPassword1">Password</label>
            <div class="controls">
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="admin" placeholder="Password">
                <?php if (!empty($passwordError)) : ?> <!-- affiche erreur-->
                    <span class="help-inline"><?php echo $passwordError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" value="submit" class="btn btn-primary">Submit</button>
    </form>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>