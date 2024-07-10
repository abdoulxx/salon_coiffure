<?php
session_start();
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    
    switch ($role) {
        case 'Client':
            $sql = "INSERT INTO Client (login_client, mot_pass_client, nom_client, prenom_client, email_client, telephone_client, datenaiss_client) VALUES (:login, :password, :nom, :prenom, :email, :telephone, :datenaiss)";
            break;
        case 'Administrateur':
            $sql = "INSERT INTO Administrateur (login_admin, mot_pass_admin, nom_admin, prenom_admin, email_admin, telephone_admin, datenaiss_admin) VALUES (:login, :password, :nom, :prenom, :email, :telephone, :datenaiss)";
            break;
    }

    $login = $_POST['login'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $datenaiss = $_POST['datenaiss'];

    $hashed_password = $password;


    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':datenaiss', $datenaiss);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Inscription réussie";
        header("Location: login.php");
    } else {
        $_SESSION['message'] = "Échec de l'inscription";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg custom-navbar-color">
  <div class="container-fluid">
    <a class="navbar-brand" style="color:white" href="index.php">Reflet Radieux</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item me-3">
          <a class="nav-link active" style="color:white" aria-current="page" href="#">reserver</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link"style="color:white" href="#">mes commandes</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link"style="color:white" href="login.php">Connexion <i class="fa fa-user" aria-hidden="true"></i>
</a>
<li class="nav-item me-3">
          <a class="nav-link" style="color:white" href="inscription.php">Inscription</a>
        </li>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Inscription</h2>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<p class='text-center'>{$_SESSION['message']}</p>";
                        unset($_SESSION['message']);
                    }
                    ?>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="login">Login</label>
                            <input type="text" class="form-control form-control-sm" name="login" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control form-control-sm" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control form-control-sm" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control form-control-sm" name="prenom" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="telephone">Téléphone</label>
                            <input type="tel" class="form-control form-control-sm" name="telephone" required>
                        </div>
                        <div class="mb-3">
                            <label for="datenaiss">Date de naissance</label>
                            <input type="date" class="form-control form-control-sm" name="datenaiss" required>
                        </div>
                        <div class="mb-3">
                            <label for="role">Rôle</label>
                            <select class="form-select form-select-sm" name="role" required>
                                <option value="Client">Client</option>
                                <option value="Administrateur">Administrateur</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

  body, html {
    height: 100%;
    margin: 0;
  }

  .custom-navbar-color {
        background-color: #7F00FF;
    }
</style>
</body>
</html>

