<?php
session_start();
// Inclusion du fichier de fonctions
require_once('fonction.php');
require './include/header.php';


// Vérification si l'utilisateur est connecté
if (isset($_SESSION['login'])) {
    $utilisateurConnecte = true;
} else {
    $utilisateurConnecte = false;
}

// Récupération des commentaires depuis la base de données
$commentaires = getCommentaires();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <h1>Livre d'or</h1>

    <?php if ($utilisateurConnecte) : ?>
        <p><a href="commentaire.php">Ajouter un commentaire</a></p>
    <?php endif; ?>

    <?php if (!empty($commentaires)) : ?>
        <ul>
            <?php foreach ($commentaires as $commentaire) : ?>
                <li>
                    Posté le <?= date('d/m/Y', strtotime($commentaire['date'])) ?> par <?= $commentaire['login'] ?><br><?= $commentaire['commentaire'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <table class="table table-hover table-bordered">
            <tr>
                <th>Login &nbsp;</th>
                <th>Commentaire</th>
                <th>Date</th>
            </tr>
            <?php foreach ($commentaires as $commentaire) : ?>
                <tr>
                    <td>
                        <?= $commentaire['login'] ?>
                    </td>
                    <td><?= $commentaire['commentaire'] ?></td>
                    <td><?= $commentaire['date'] ?></td>
                    <?php
                    echo '<td class="text-center">';
                    echo '<a class="btn btn-primary" href="editComment.php?id=' . $commentaire['id'] . '"> <i class="bi bi-book"></i></a>'; // un autre td pour le bouton d'edition
                    echo '</td>';

                    echo '<td class="text-center">';
                    echo '<a class="btn btn-success" href="updateComment.php?id=' . $commentaire['id'] . '"> <i class="bi bi-pen"></i></a>'; // un autre td pour le bouton d'update
                    echo '</td>';

                    echo '<td class="text-center">';
                    echo '<a class="btn btn-danger" href="deleteComment.php?id=' . $commentaire['id'] . ' "> <i class="bi bi-person-dash-fill"></i></a>'; // un autre td pour le bouton de suppression
                    echo '</td>';
                    ''
                    ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>Aucun commentaire pour le moment.</p>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>