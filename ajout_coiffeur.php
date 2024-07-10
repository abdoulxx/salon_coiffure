<?php
include 'connexion.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_coiffeur = $_POST['login_coiffeur'];
    $nom_coiffeur = $_POST['nom_coiffeur'];
    $mot_pass_coiffeur = $_POST['mot_pass_coiffeur'];
    $prenom_coiffeur = $_POST['prenom_coiffeur'];
    $email_coiffeur = $_POST['email_coiffeur'];
    $telephone_coiffeur = $_POST['telephone_coiffeur'];
    $datenaiss_coiffeur = $_POST['datenaiss_coiffeur'];

    $stmt = $conn->prepare("INSERT INTO Coiffeur (login_coiffeur, nom_coiffeur, mot_pass_coiffeur, prenom_coiffeur, email_coiffeur, telephone_coiffeur, datenaiss_coiffeur) VALUES (:login, :nom, :mdp, :prenom, :email, :telephone, :datenaiss)");
    $stmt->bindParam(':login', $login_coiffeur);
    $stmt->bindParam(':nom', $nom_coiffeur);
    $stmt->bindParam(':mdp', $mot_pass_coiffeur);
    $stmt->bindParam(':prenom', $prenom_coiffeur);
    $stmt->bindParam(':email', $email_coiffeur);
    $stmt->bindParam(':telephone', $telephone_coiffeur);
    $stmt->bindParam(':datenaiss', $datenaiss_coiffeur);

    if ($stmt->execute()) {
        $message = "Coiffeur ajouté avec succès";
        header('refresh:1;url=super_admin.php'); // Redirection vers super_admin.php après 1 seconde

    } else {
        $message = "Erreur lors de l'ajout du coiffeur.";
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
          <a class="nav-link active" style="color:white" aria-current="page" href="admin.php">reserver</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link"style="color:white" href="commande.php">mes commandes</a>
        </li>
        <li class="nav-item me-3">
          <form method="post" action="">
            <input type="hidden" name="logout" value="true">
            <button type="submit" class="nav-link" style="background:none; border:none; color:white; cursor:pointer;">Déconnexion <i class="fa fa-user" aria-hidden="true"></i></button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
    <h2 class="mb-4">Ajouter un coiffeur</h2>
    <?php if ($message): ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="login_coiffeur" class="form-label">Login</label>
            <input type="text" class="form-control" id="login_coiffeur" name="login_coiffeur" required>
        </div>
        <div class="mb-3">
            <label for="mot_pass_coiffeur" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mot_pass_coiffeur" name="mot_pass_coiffeur" required>
        </div>
        <div class="mb-3">
            <label for="nom_coiffeur" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom_coiffeur" name="nom_coiffeur" required>
        </div>
        <div class="mb-3">
            <label for="prenom_coiffeur" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom_coiffeur" name="prenom_coiffeur" required>
        </div>
        <div class="mb-3">
            <label for="email_coiffeur" class="form-label">Email</label>
            <input type="email" class="form-control" id="email_coiffeur" name="email_coiffeur" required>
        </div>
        <div class="mb-3">
            <label for="telephone_coiffeur" class="form-label">Téléphone</label>
            <input type="tel" class="form-control" id="telephone_coiffeur" name="telephone_coiffeur" required>
        </div>
        <div class="mb-3">
            <label for="datenaiss_coiffeur" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="datenaiss_coiffeur" name="datenaiss_coiffeur" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>


</body>
</html>
