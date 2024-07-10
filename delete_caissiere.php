<?php
include 'connexion.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Suppression de la caissière
    $stmt = $conn->prepare("DELETE FROM caissiere WHERE login_caissiere = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $message = "Caissière supprimée avec succès";
        header('refresh:2;url=super_admin.php'); // Redirection vers super_admin.php après 2 secondes
    } else {
        // Gérez l'erreur, par exemple :
        $message = "Erreur lors de la suppression de la caissière.";
    }
} else {
    $message = "Identifiant de caissière non spécifié.";
}

echo $message;
?>
