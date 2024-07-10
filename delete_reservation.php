<?php
include 'connexion.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Suppression de la réservation
    $stmt = $conn->prepare("DELETE FROM rendez_vous WHERE id_rdv = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $message = "Réservation supprimée avec succès";
        header('refresh:2;url=super_admin.php'); // Redirection vers super_admin.php après 2 secondes
    } else {
        // Gérez l'erreur, par exemple :
        $message = "Erreur lors de la suppression de la réservation.";
    }
} else {
    $message = "Identifiant de réservation non spécifié.";
}

echo $message;
?>
