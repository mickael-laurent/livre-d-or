<?php
session_start();
// Vérification si l'utilisateur est connecté
require_once('fonction.php');
if (!isset($_SESSION['login'])) {
    //header('Location: connexion.php');
    //exit();
}

// Inclusion du fichier de fonctions
require_once('fonction.php');

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['commentaire']) && !empty(trim($_POST['commentaire']))) {
        $commentaire = trim($_POST['commentaire']);
        $idUtilisateur = $_SESSION['id'];

        // Insertion du commentaire dans la base de données
        insererCommentaire($commentaire, $idUtilisateur);

        // Redirection vers la page du livre d'or
        header('Location: livre-or.php');
        exit();
    } else {
        $erreur = "Le champ commentaire est vide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>
</head>
<body>
    <h1>Ajouter un commentaire</h1>

    <?php if (isset($erreur)) : ?>
        <p style="color: red;"><?= $erreur ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="commentaire">Commentaire :</label><br>
        <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>