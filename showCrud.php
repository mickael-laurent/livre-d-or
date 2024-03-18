<?php
echo '<tr>';
echo '<td>' . $row['login'] . '</td>';
echo '<td>' . $row['nom'] . '</td>';
echo '<td>' . $row['prenom'] . '</td>';


echo '<td class="text-center">';
echo '<a class="btn btn-primary" href="edit.php?id=' . $row['id'] . '"> <i class="bi bi-book"></i></a>'; // un autre td pour le bouton d'edition
echo '</td>';

echo '<td class="text-center">';
echo '<a class="btn btn-success" href="update.php?id=' . $row['id'] . '"> <i class="bi bi-pen"></i></a>'; // un autre td pour le bouton d'update
echo '</td>';

echo '<td class="text-center">';
echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . ' "> <i class="bi bi-person-dash-fill"></i></a>'; // un autre td pour le bouton de suppression
echo '</td>';

echo '</tr>';
