<?php
session_start();

?>






<?php
//require 'database.php';
require 'fonction.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) { //on initialise nos messages d'erreurs; 
    $loginError = '';
    $nomError = '';
    $prenomError = '';
    $passwordError = '';


    // on recupère nos valeurs 
    $login = isset($_POST['login']) ? htmlentities(trim($_POST['login'])) : '';
    $nom = isset($_POST['nom']) ? htmlentities(trim($_POST['nom'])) : '';
    $prenom = isset($_POST['prenom']) ? htmlentities(trim($_POST['prenom'])) : '';
    $password = isset($_POST['password']) ? htmlentities(trim($_POST['password'])) : '';

    // on vérifie nos champs 
    $valid = true;
    if (empty($login)) {
        $loginError = 'Entrer votre login';
        $valid = false;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $login)) {
        $loginError = "Only letters and white space allowed";
    }

    if (empty($nom)) {
        $nomError = 'Entrer votre nom';
        $valid = false;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $nom)) {
        $nomError = "Only letters and white space allowed";
    }

    if (empty($prenom)) {
        $nomError = 'Entrer votre prenom';
        $valid = false;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $prenom)) {
        $prenomError = "Only letters and white space allowed";
    }

    if (empty($password)) {
        $passwordError = 'Entrer votre password';
        $valid = false;
    } else if (!preg_match("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,10}$", $password)) {
        $passwornError = "Only letters and @,$,!,%,*,?,& allowed";
    }




    // si les données sont présentes et bonnes, on se connecte à la base 
    if ($valid) {
        createuser($login, $nom, $prenom, $password);
        //$pdo = Database::connect();
        //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$sql = "INSERT INTO utilisateurs (login,nom,prenom,password) values(?, ?, ?, ?)";
        //$q = $pdo->prepare($sql);
        //$q->execute(array($login, $nom, $prenom, $password));
        //Database::disconnect();
        //header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>gestion utilisateur</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container text-center border p-3 rounded bg-light">
        <div class="row">
            <h3>Ajouter un utilisateur</h3>
        </div>

        <form method="post" action="add.php">
            <div class="control-group <?php echo !empty($loginError) ? 'error' : ''; ?>">
                <label class="control-label">Login</label>
                <div class="controls">
                    <input name="login" type="text" class="form-control-lg" placeholder="login" value="<?php echo !empty($login) ? $login : ''; ?>">
                    <?php if (!empty($loginError)) : ?>
                        <span class="help-inline"><?php echo $loginError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="control-group<?php echo !empty($nomError) ? 'error' : ''; ?>">
                <label class="control-label">nom</label>
                <div class="controls">
                    <input type="text" class="form-control-lg" placeholder="Nom" name="nom" value="<?php echo !empty($nom) ? $nom : ''; ?>">
                    <?php if (!empty($nom)) : ?>
                        <span class="help-inline"><?php echo $nomError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="control-group<?php echo !empty($prenomError) ? 'error' : ''; ?>">
                <label class="control-label">prenom</label>
                <div class="controls">
                    <input type="text" class="form-control-lg" placeholder="prenom" name="prenom" value="<?php echo !empty($prenom) ? $prenom : ''; ?>">
                    <?php if (!empty($prenomError)) : ?>
                        <span class="help-inline"><?php echo $prenomError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="control-group<?php echo !empty($passwordError) ? 'error' : ''; ?>">
                <label class="control-label">password</label>
                <div class="controls">
                    <input type="password" class="form-control-lg" placeholder="password" name="password" value="<?php echo !empty($password) ? $password : ''; ?>">
                    <?php if (!empty($passwordError)) : ?>
                        <span class="help-inline"><?php echo $passwordError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <input type="submit" class="btn btn-primary" name="submit" value="ajouter">
                <a class="btn" href="index.php">Retour</a>
            </div>

        </form>

    </div>

</body>

</html>