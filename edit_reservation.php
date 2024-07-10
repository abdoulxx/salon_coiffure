<?php
session_start();

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

include('connexion.php');

$reservation_id = null;

// Vérifiez si l'identifiant de la réservation est passé dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $reservation_id = $_GET['id'];

    // Récupérez les détails de la réservation à modifier depuis la base de données
    $stmt = $conn->prepare("SELECT * FROM rendez_vous WHERE id_rdv = :id");
    $stmt->bindParam(':id', $reservation_id);
    $stmt->execute();
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reservation) {
        echo "Réservation non trouvée.";
        exit();
    }
} else {
    header('refresh:1;url=super_admin.php'); // Redirection vers super_admin.php après 1 seconde
    exit();
}

// Vérifiez si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les nouvelles valeurs des champs
    $date_rdv = isset($_POST['date']) ? $_POST['date'] : '';
    $status_rdv = isset($_POST['statut']) ? $_POST['statut'] : '';
    $login_coiffeur = isset($_POST['coiffeur']) ? $_POST['coiffeur'] : '';

    // Mettez à jour la réservation dans la base de données
    $stmt = $conn->prepare("UPDATE rendez_vous SET date_rdv = :date_rdv, statu_rdv = :status_rdv, login_coiffeur = :login_coiffeur WHERE id_rdv = :id");
    $stmt->bindParam(':date_rdv', $date_rdv);
    $stmt->bindParam(':status_rdv', $status_rdv);
    $stmt->bindParam(':login_coiffeur', $login_coiffeur);
    $stmt->bindParam(':id', $reservation_id);

    if ($stmt->execute()) {
        // Redirigez vers la page admin.php après la modification
        header('Location: super_admin.php');
        exit();
    } else {
        echo "Erreur lors de la modification de la réservation.";
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
    <h2 class="mb-4">Modifier la réservation</h2>
    <form action="edit_reservation.php?id=<?php echo $reservation_id; ?>" method="post">
        <div class="mb-3">
            <label for="date" class="form-label">Date:</label>
            <input type="date" name="date" class="form-control" value="<?php echo $reservation['date_rdv']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="coiffeur" class="form-label">Coiffeur:</label>
            <input type="text" name="coiffeur" class="form-control" value="<?php echo $reservation['login_coiffeur']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="statut" class="form-label">Statut:</label>
            <select name="statut" id="statut" class="form-control" required>
                <option value="en attente" <?php echo ($reservation['statu_rdv'] == 'en attente') ? 'selected' : ''; ?>>En attente</option>
                <option value="accepter" <?php echo ($reservation['statu_rdv'] == 'accepter') ? 'selected' : ''; ?>>Accepté</option>
                <option value="annuler" <?php echo ($reservation['statu_rdv'] == 'annuler') ? 'selected' : ''; ?>>Annulé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

<!-- Votre code CSS et JS -->

</body>
</html>
