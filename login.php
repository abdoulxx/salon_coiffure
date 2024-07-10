<?php
session_start();
include 'connexion.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['role'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        switch ($role) {
            case 'Coiffeur':
                $table = 'Coiffeur';
                $login_column = 'login_coiffeur';
                $password_column = 'mot_pass_coiffeur';
                break;
            case 'Client':
                $table = 'Client';
                $login_column = 'login_client';
                $password_column = 'mot_pass_client';
                header("Location: admin.php"); // Redirige les clients vers admin.php
                exit();
                break;
            case 'Caissiere':
                $table = 'Caissiere';
                $login_column = 'login_caissiere';
                $password_column = 'mot_pass_caissiere';
                header("Location: caissiere.php"); // Redirige les administrateurs vers admin_admin.php
                exit();
                break;
            case 'Administrateur':
                $table = 'Administrateur';
                $login_column = 'login_administrateur';
                $password_column = 'mot_pass_administrateur';
                header("Location: super_admin.php"); // Redirige les administrateurs vers admin_admin.php
                exit();
                break;
            default:
                $table = '';
                break;
        }

        $sql = "SELECT * FROM $table WHERE $login_column = :login AND $password_column = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['login'] = $login;
            $_SESSION['role'] = $role;
            header("Location: admin.php"); // Redirige vers le tableau de bord
        } else {
            $error = "Identifiants incorrects";
        }
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

<?php
if ($error !== '') {
    echo "<p style='color: red; text-align: center;'>$error</p>";
}
?>

<div class="position-relative">
    <img src="1.png" alt="Image Plein Écran" class="full-screen-image">
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="card" style="width: 300px;">
            <div class="card-body">
                <h5 class="card-title text-center">Connexion</h5>
                
                <?php
                if ($error !== '') {
                    echo "<p class='text-danger text-center'>$error</p>";
                }
                ?>

                <form method="post" action="">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login:</label>
                        <input type="text" class="form-control" name="login" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle:</label>
                        <select class="form-select" name="role" required>
                            <option value="Coiffeur">Coiffeur</option>
                            <option value="Client">Client</option>
                            <option value="Caissiere">Caissière</option>
                            <option value="Administrateur">Administrateur</option>
                        </select>
                    </div>
                    <div class="mb-3 text-center">
                        <input type="submit" class="btn btn-primary" value="Se connecter">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    body, html {
        height: 100%;
        margin: 0;
    }

    .full-screen-image {
        width: 100vw;
        height: 100vh;
        object-fit: cover;
    }

    .custom-navbar-color {
        background-color: #7F00FF;
    }
</style>

</body>
</html>