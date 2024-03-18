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
        <form>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3" for="login">Login</label>
                    <div class="col-md-9">
                        <input id="login" type="text" class="form-control" name="" placeholder="Entrer votre login" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3" for="prenom">Prenom</label>
                    <div class="col-md-9">
                        <input id="prenom" type="text" class="form-control" name="" placeholder="Entrer votre prenom">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3" for="nom">Nom</label>
                    <div class="col-md-9">
                        <input id="nom" type="text" class="form-control" name="" placeholder="Entrer votre nom">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3" for="password">Password</label>
                    <div class="col-md-9">
                        <input id="password" type="password" class="form-control" name="" placeholder="Entrer votre password" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3" for="password">Confirmer Password</label>
                    <div class="col-md-9">
                        <input id="password" type="password" class="form-control" name="" placeholder="Confirmer votre password" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-1 offset-md-11">
                        <button class="btn btn-warning">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>