<?php
session_start();

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

include('connexion.php');

$login_caissiere_id = null;

// Vérifiez si l'identifiant de la caissière est passé dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $login_caissiere_id = $_GET['id'];

    // Récupérez les détails de la caissière à modifier depuis la base de données
    $stmt = $conn->prepare("SELECT * FROM caissiere WHERE login_caissiere = :id");
    $stmt->bindParam(':id', $login_caissiere_id);
    $stmt->execute();
    $login_caissiere = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$login_caissiere) {
        echo "Caissière non trouvée.";
        exit();
    }
} else {
    header('refresh:1;url=super_admin.php'); // Redirection vers super_admin.php après 1 seconde
    exit();
}

// Vérifiez si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les nouvelles valeurs des champs
    $nom_caissiere = isset($_POST['nom_caissiere']) ? $_POST['nom_caissiere'] : '';
    $prenom_caissiere = isset($_POST['prenom_caissiere']) ? $_POST['prenom_caissiere'] : '';
    $email_caissiere = isset($_POST['email']) ? $_POST['email'] : '';
    $telephone_caissiere = isset($_POST['telephone']) ? $_POST['telephone'] : '';
    
    // Validation pour la date de naissance
    $datenaiss_caissiere = isset($_POST['date_naissance']) && !empty($_POST['date_naissance']) ? $_POST['date_naissance'] : null;

    // Vérifiez si la date est valide
    if ($datenaiss_caissiere && !strtotime($datenaiss_caissiere)) {
        echo "Date de naissance invalide.";
        exit();
    }

    // Mettez à jour la caissière dans la base de données
    $stmt = $conn->prepare("UPDATE caissiere SET nom_caissiere = :nom, prenom_caissiere = :prenom, email_caissiere = :email, telephone_caissiere = :telephone, datenaiss_caissiere = :datenaiss WHERE login_caissiere = :id");
    $stmt->bindParam(':nom', $nom_caissiere);
    $stmt->bindParam(':prenom', $prenom_caissiere);
    $stmt->bindParam(':email', $email_caissiere);
    $stmt->bindParam(':telephone', $telephone_caissiere);
    $stmt->bindParam(':datenaiss', $datenaiss_caissiere, PDO::PARAM_STR);  // Assurez-vous que le paramètre est une chaîne

    $stmt->bindParam(':id', $login_caissiere_id);

    if ($stmt->execute()) {
        // Redirigez vers la page super_admin.php après la modification
        header('Location: super_admin.php');
        exit();
    } else {
        echo "Erreur lors de la modification de la caissière.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg custom-navbar-color">
  <!-- Votre code de navbar -->
</nav>

<div class="container mt-5">
    <h2 class="mb-4">Modifier la caissière</h2>
    <form action="edit_caissiere.php?id=<?php echo $login_caissiere_id; ?>" method="post">
        <div class="mb-3">
            <label for="nom_caissiere" class="form-label">Nom:</label>
            <input type="text" name="nom_caissiere" class="form-control" value="<?php echo $login_caissiere['nom_caissiere']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="prenom_caissiere" class="form-label">Prénom:</label>
            <input type="text" name="prenom_caissiere" class="form-control" value="<?php echo $login_caissiere['prenom_caissiere']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $login_caissiere['email_caissiere']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone:</label>
            <input type="tel" name="telephone" class="form-control" value="<?php echo $login_caissiere['telephone_caissiere']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance:</label>
            <input type="date" name="date_naissance" class="form-control" value="<?php echo $login_caissiere['datenaiss_caissiere']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

<!-- Votre code CSS et JS -->

</body>
</html>
