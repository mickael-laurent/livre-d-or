<?php 
  session_start();

 
//require 'database.php';
require 'fonction.php';
$id = 0;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (!empty($_POST)) {
    $id = $_POST['id'];
    // $pdo = Database::connect();
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "DELETE FROM utilisateurs  WHERE id = ?";
    // $q = $pdo->prepare($sql);
    // $q->execute(array($id));
    // Database::disconnect();
    deleteuser($id);
    header("Location: index.php");
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
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Supprimer un utilisateur</h3>
            </div>

            <form class="form-horizontal" action="delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                Are you sure to delete ?

                <div class="form-actions">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <a class="btn" href="index.php">No</a>
                </div>
            </form>
        </div>

    </div>

    <!-- /container -->
</body>

</html>