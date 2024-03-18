<?php
session_start();

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
    <div class="container">
        <h1>Bienvenue sur notre site !</h1>
        <div class="welcome-message">
            <p>Vous pouvez mettre ici un message de bienvenue ou une brève description de votre site.</p>
        </div>
    </div>
    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> Votre Société. Tous droits réservés.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>