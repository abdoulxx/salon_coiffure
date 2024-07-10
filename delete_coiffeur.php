<?php
include 'connexion.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Suppression du coiffeur
    $stmt = $conn->prepare("DELETE FROM coiffeur WHERE login_coiffeur = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $message = "Coiffeur supprimé avec succès";
        header('refresh:2;url=super_admin.php'); // Redirection vers super_admin.php après 2 secondes
    } else {
        // Gérez l'erreur, par exemple :
        $message = "Erreur lors de la suppression du coiffeur.";
    }
} else {
    $message = "Identifiant de coiffeur non spécifié.";
}

echo $message;
?>
