<?php
include 'connexion.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_caissiere = $_POST['login_caissiere'];
    $nom_caissiere = $_POST['nom_caissiere'];
    $mot_pass_caissiere = $_POST['mot_pass_caissiere'];
    $prenom_caissiere = $_POST['prenom_caissiere'];
    $email_caissiere = $_POST['email_caissiere'];
    $telephone_caissiere = $_POST['telephone_caissiere'];
    $datenaiss_caissiere = $_POST['datenaiss_caissiere'];

    $stmt = $conn->prepare("INSERT INTO Caissiere (login_caissiere, nom_caissiere, mot_pass_caissiere, prenom_caissiere, email_caissiere, telephone_caissiere, datenaiss_caissiere) VALUES (:login, :nom, :mdp, :prenom, :email, :telephone, :datenaiss)");
    $stmt->bindParam(':login', $login_caissiere);
    $stmt->bindParam(':nom', $nom_caissiere);
    $stmt->bindParam(':mdp', $mot_pass_caissiere);
    $stmt->bindParam(':prenom', $prenom_caissiere);
    $stmt->bindParam(':email', $email_caissiere);
    $stmt->bindParam(':telephone', $telephone_caissiere);
    $stmt->bindParam(':datenaiss', $datenaiss_caissiere);

    if ($stmt->execute()) {
        $message = "Caissière ajoutée avec succès";
        header('refresh:1;url=super_admin.php'); // Redirection vers super_admin.php après 1 seconde

    } else {
        $message = "Erreur lors de l'ajout de la caissière.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une caissière</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<!-- ... Le code du header ... -->

<div class="container mt-5">
    <h2 class="mb-4">Ajouter une caissière</h2>
    <form method="post">
        <div class="mb-3">
            <label for="login_caissiere" class="form-label">Login</label>
            <input type="text" class="form-control" id="login_caissiere" name="login_caissiere" required>
        </div>
        <div class="mb-3">
            <label for="mot_pass_caissiere" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mot_pass_caissiere" name="mot_pass_caissiere" required>
        </div>
        <div class="mb-3">
            <label for="nom_caissiere" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom_caissiere" name="nom_caissiere" required>
        </div>
        <div class="mb-3">
            <label for="prenom_caissiere" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom_caissiere" name="prenom_caissiere" required>
        </div>
        <div class="mb-3">
            <label for="email_caissiere" class="form-label">Email</label>
            <input type="email" class="form-control" id="email_caissiere" name="email_caissiere" required>
        </div>
        <div class="mb-3">
            <label for="telephone_caissiere" class="form-label">Téléphone</label>
            <input type="tel" class="form-control" id="telephone_caissiere" name="telephone_caissiere" required>
        </div>
        <div class="mb-3">
            <label for="datenaiss_caissiere" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="datenaiss_caissiere" name="datenaiss_caissiere" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<!-- ... Le code du footer ... -->

</body>
</html>
