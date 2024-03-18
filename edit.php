<?php
session_start();

?>







<?php
require('database.php');
//on appelle notre fichier de config 
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (null == $id) {
    header("location:index.php");
} else {
    //on lance la connection et la requete 
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) .
        $sql = "SELECT * FROM utilisateurs where id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container text-center">
        <div class="span10 offset1">
            <div class="row">
                <h3>Edition</h3>
            </div>

            <div class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">Login</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['login']; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Nom</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['nom']; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Prenom</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['prenom']; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Password</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['password']; ?>
                        </label>
                    </div>
                </div>



                <div class="form-actions">
                    <a class="btn btn-success" href="index.php">Back</a>
                </div>
            </div>
        </div>
    </div>

    <!-- /container -->
</body>

</html>