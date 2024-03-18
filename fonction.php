<?php
function getconnection()
{
    $host = 'localhost';
    $dbname = 'moduleconnexion';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Définit le mode d'erreur PDO sur exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}

function getdisconnect($pdo, $stmt)
{
    $pdo = null;
    $stmt = null;
}
function createuser($login, $nom, $prenom, $password)
{
    $pdo = getconnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO utilisateurs (login, nom, prenom, password) VALUES (:login, :nom, :prenom, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    getdisconnect($pdo, $stmt);
}

function readuser($id)
{
    $pdo = getconnection();
    $sql = "SELECT * FROM utilisateurs WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function updateuser($id, $login, $nom, $prenom, $password)
{
    $pdo = getconnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE utilisateurs SET login = :login, nom = :nom, prenom = :prenom, password = :password WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    getdisconnect($pdo, $stmt);
}

function deleteuser($id)
{
    $pdo = getconnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM utilisateurs WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    getdisconnect($pdo, $stmt);
}

function getCommentaires() {
    $pdo = getconnection();
    //$query = "SELECT * FROM commentaires ORDER BY date DESC";
    $query = "SELECT * FROM commentaires, utilisateurs WHERE commentaires.id_utilisateur = utilisateurs.id ORDER BY date DESC";
    $stmt = $pdo->query($query);
    $commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $commentaires;
}




function insererCommentaire($commentaire, $idUtilisateur) {
    $pdo = getconnection();
    $query = "INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (:commentaire, :idUtilisateur, NOW())";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':commentaire', $commentaire);
    $stmt->bindParam(':idUtilisateur', $idUtilisateur);
    $stmt->execute();
}
