<?php require 'database.php';
require 'fonction.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (null == $id) {
    header("Location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    // on initialise nos erreurs 
    $loginError = null;
    $nomError = null;
    $prenomError = null;
    $passwordError = null;

    // On assigne nos valeurs 
    $login = $_POST['login'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $password = $_POST['password'];

    // On verifie que les champs sont remplis 
    $valid = true;
    if (empty($login)) {
        $loginError = 'Please enter Login';
        $valid = false;
    }

    if (empty($nom)) {
        $nomError = 'Please enter Nom';
        $valid = false;
    }

    if (empty($prenom)) {
        $prenomError = 'Please enter Prenom';
        $valid = false;
    }
}
if (empty($password)) {
    $passwordError = 'Please enter your password';
    $valid = false;
}

// mise à jour des donnés 
if ($valid) {
    updateuser($id, $login, $nom, $prenom, $password);
    //header("Location: index.php");
}
//} 
else {

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM utilisateurs where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $login = $data['login'];
    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $password = $data['password'];

    Database::disconnect();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Crud-Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center border p-3 rounded">
        <div class="row text-center">
            <h3>Modifier un utilisateur</h3>
        </div>
        <form method="post" action="update.php?id=<?php echo $id; ?>">
            <div class="control-group <?php echo !empty($loginError) ? 'error' : ''; ?>">
                <label class="control-label">Login</label>
                <div class="controls">
                    <input name="login" type="text" class="form-control-lg" placeholder="Login" value="<?php echo !empty($login) ? $login : ''; ?>">
                    <?php if (!empty($loginError)) : ?>
                        <span class="help-inline"><?php echo $loginError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="control-group<?php echo !empty($nomError) ? 'error' : ''; ?>">
                <label class="control-label">Nom</label>
                <div class="controls">
                    <input type="text" class="form-control-lg" name="nom" value="<?php echo !empty($nom) ? $nom : ''; ?>">
                    <?php if (!empty($nomError)) : ?>
                        <span class="help-inline"><?php echo $nomError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="control-group<?php echo !empty($prenomError) ? 'error' : ''; ?>">
                <label class="control-label">Prenom</label>
                <div class="controls">
                    <input type="text" class="form-control-lg" name="prenom" value="<?php echo !empty($prenom) ? $prenom : ''; ?>">
                    <?php if (!empty($prenomError)) : ?>
                        <span class="help-inline"><?php echo $prenomError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="control-group <?php echo !empty($passwordError) ? 'error' : ''; ?>">
                <label class="control-label">Password</label>
                <div class="controls">
                    <input name="password" type="password" class="form-control-lg" placeholder="Password" value="<?php echo !empty($password) ? $password : ''; ?>">
                    <?php if (!empty($passwordError)) : ?>
                        <span class="help-inline"><?php echo $passwordError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <input type="submit" class="btn btn-success" name="submit" value="submit">
                <a class="btn" href="index.php">Retour</a>
            </div>
        </form>
    </div>
</body>

</html>