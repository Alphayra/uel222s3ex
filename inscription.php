<?php
session_start();
require_once('config.php');

$error = isset($_GET['error']) ? $_GET['error'] : '';

if ($eraze
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




<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Mini-projet G3 - Inscription</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;700&amp;display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../assets/style.css" rel="stylesheet">
</head>

<body class="products">
    <div class="size1 flex-w flex-c-m p-t-20 p-b-55 p-l-15 p-r-15">
        <div class="wsize1 bor1 bg1 p-b-45 p-l-15 p-r-15 p-t-20 respon1">
            <p class="txt-center m1-txt1 p-t-33 p-b-68">
                Inscrivez-vous
            </p>
            <?php if (isset($_SESSION['success_message'])) : ?>
    <div class="alert alert-success text-justify">
        <p><?= $_SESSION['success_message'] ?></p>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

            <div class="alert alert-info text-justify">
                <p>
                    Cette page vous permet de créer un compte.
                </p>
            </div>
            <p class="txt-center pb-4">
                <a class="btn btn-primary" href="../index.php" title="Revenir à l'accueil">
                    Revenir à l'accueil
                </a>
            </p>
            <div>
                <form method="POST" action="connexion.php" class="p-4 rounded w-100 ">
                    <div class="text-center mt-3">
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger">
                                <p><?= $error ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="inputLogin3" class="col-sm-2 col-form-label">Identifiant</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control border-black" id="inputLogin3" name="identifiant"
                                required autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Mot de passe</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control border-black" id="inputPassword3" name="mdp"
                                required autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="inputPasswordConfirm" class="col-sm-2 col-form-label">Confirmer le mot de
                            passe</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control border-black" id="inputPasswordConfirm"
                                name="confirmer_mdp" required autocomplete="off">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-primary w-25">S'inscrire</button>
                    </div>
                    <div class="text-center mt-3">
                        <p>Déjà inscrit ? <a href="connexion.php">Se connecter</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
