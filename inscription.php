<?php
session_start();
require_once('config.php');

$error = isset($_GET['error']) ? $_GET['error'] : '';

if ($error === 'exists') {
    echo "Cet identifiant existe déjà. Veuillez en choisir un autre.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $identifiant = isset($_POST['identifiant']) ? htmlspecialchars($_POST['identifiant']) : '';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
    $confirmerMdp = isset($_POST['confirmer_mdp']) ? $_POST['confirmer_mdp'] : '';

    if ($mdp !== $confirmerMdp) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        $query = "SELECT * FROM utilisateurs WHERE identifiant = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$identifiant]);

        if ($stmt->rowCount() > 0) {
            $error = "Cet identifiant existe déjà. Veuillez en choisir un autre.";
        } else {
            $defaultRole = 'nouveau';
            $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

            $query = "INSERT INTO utilisateurs (identifiant, motdepasse, role) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$identifiant, $mdp, $defaultRole]);

            $_SESSION['success_message'] = "Inscription réussie ! Vous pouvez vous connecter maintenant.";

            header("Location: connexion.php");
            exit();
        }
    }
}
?>


