<?php
session_start();

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

include('connexion.php');

$login_coiffeur_id = null;

// Vérifiez si l'identifiant du coiffeur est passé dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $login_coiffeur_id = $_GET['id'];

    // Récupérez les détails du coiffeur à modifier depuis la base de données
    $stmt = $conn->prepare("SELECT * FROM coiffeur WHERE login_coiffeur = :id");
    $stmt->bindParam(':id', $login_coiffeur_id);
    $stmt->execute();
    $login_coiffeur = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$login_coiffeur) {
        echo "Coiffeur non trouvé.";
        exit();
    }
} else {
    header('refresh:1;url=super_admin.php'); // Redirection vers super_admin.php après 1 seconde
    exit();
}

// Vérifiez si le formulaire de modification a été soumis
// Vérifiez si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les nouvelles valeurs des champs
    $nom_coiffeur = isset($_POST['nom_coiffeur']) ? $_POST['nom_coiffeur'] : '';
    $prenom_coiffeur = isset($_POST['prenom_coiffeur']) ? $_POST['prenom_coiffeur'] : '';
    $email_coiffeur = isset($_POST['email']) ? $_POST['email'] : '';
    $telephone_coiffeur = isset($_POST['telephone']) ? $_POST['telephone'] : '';
    
    // Validation pour la date de naissance
    $datenaiss_coiffeur = isset($_POST['date_naissance']) && !empty($_POST['date_naissance']) ? $_POST['date_naissance'] : null;

    // Vérifiez si la date est valide
    if ($datenaiss_coiffeur && !strtotime($datenaiss_coiffeur)) {
        echo "Date de naissance invalide.";
        exit();
    }

    // Mettez à jour le coiffeur dans la base de données
    $stmt = $conn->prepare("UPDATE coiffeur SET nom_coiffeur = :nom, prenom_coiffeur = :prenom, email_coiffeur = :email, telephone_coiffeur = :telephone, datenaiss_coiffeur = :datenaiss WHERE login_coiffeur = :id");
    $stmt->bindParam(':nom', $nom_coiffeur);
    $stmt->bindParam(':prenom', $prenom_coiffeur);
    $stmt->bindParam(':email', $email_coiffeur);
    $stmt->bindParam(':telephone', $telephone_coiffeur);
    $stmt->bindParam(':datenaiss', $datenaiss_coiffeur, PDO::PARAM_STR);  // Assurez-vous que le paramètre est une chaîne

    $stmt->bindParam(':id', $login_coiffeur_id);

    if ($stmt->execute()) {
        // Redirigez vers la page super_admin.php après la modification
        header('Location: super_admin.php');
        exit();
    } else {
        echo "Erreur lors de la modification du coiffeur.";
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
    <h2 class="mb-4">Modifier le coiffeur</h2>
    <form action="edit_coiffeur.php?id=<?php echo $login_coiffeur_id; ?>" method="post">
        <div class="mb-3">
            <label for="nom_coiffeur" class="form-label">Nom:</label>
            <input type="text" name="nom_coiffeur" class="form-control" value="<?php echo $login_coiffeur['nom_coiffeur']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="prenom_coiffeur" class="form-label">Prénom:</label>
            <input type="text" name="prenom_coiffeur" class="form-control" value="<?php echo $login_coiffeur['prenom_coiffeur']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $login_coiffeur['email_coiffeur']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone:</label>
            <input type="tel" name="telephone" class="form-control" value="<?php echo $login_coiffeur['telephone_coiffeur']; ?>" required>
        </div>
        <div class="mb-3">
    <label for="date_naissance" class="form-label">Date de naissance:</label>
    <?php
    // Convertir la date au format 'Y-m-d' (année/mois/jour) pour l'affichage
    $date_naissance = date('Y-m-d', strtotime($login_coiffeur['datenaiss_coiffeur']));
    ?>
    <input type="date" name="date_naissance" class="form-control" value="<?php echo $date_naissance; ?>" required>
</div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

<!-- Votre code CSS et JS -->

</body>
</html>
