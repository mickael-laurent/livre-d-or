<?php
session_start();


// Inclure votre fichier de configuration de base de données
//require "database.php";



?>



<!DOCTYPE html>
<html lang="en">

<!-- <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head> -->
<?php
include './include/head.php';
?>
<body>
<?php
include './include/headerprofil.php';
?>
  <div>
    <h2>Profil de <?php echo ($_SESSION['nom']); ?></h2>
    <p>Nom d'utilisateur: <?php echo ($_SESSION['login']); ?></p>
    <p>Id d'utilisateur: <?php echo ($_SESSION['id']); ?></p>

    <!-- Ajoutez d'autres informations de profil ici -->


  </div>

  <div class="container">
    <div class="row">
      <h2 class="text-center">Gestion Utilisateur</h2>
    </div>

    <div class="row border p-3 rounded bg-light">
      <p>
        <?php
        if ($_SESSION['login'] == 'admin') {
          echo '<a href="add.php" class="btn btn-success"> <i class="bi bi-person-add"></i></a>';
        }
        ?>
        <a href="./logout.php" class="btn btn-danger"> <i class="bi bi-box-arrow-right"></i></a>
      </p>
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <th>Login</th>
            <th>Nom</th>
            <th>Prenom</th>
          </thead>

          <tbody>
            <?php
            
            //on inclut notre fichier de connection 
            include 'database.php';
            include 'fonction.php';
            //on se connecte à la base 
            if ($_SESSION['login'] == 'admin') {
              $pdo = Database::connect();
              $sql = 'SELECT * FROM utilisateurs ORDER BY id DESC';
              // exit();
              foreach ($pdo->query($sql) as $row) {
                //on cree les lignes du tableau avec chaque valeur retournée 
                include 'showCrud.php';
              };
            } elseif ($sessLog != 'admin') {
              $pdo = Database::connect();
              $sql = 'SELECT * FROM utilisateurs WHERE login = "' . $sessLog . '"';


              foreach ($pdo->query($sql) as $row) {

                //on cree les lignes du tableau avec chaque valeur retournée 
                include 'showCrud.php';
              };
            } else {
            }
            Database::disconnect(); //on se deconnecte de la base
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>