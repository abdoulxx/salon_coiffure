<?php
include('connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coiffure = $_POST['coiffure'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $coiffeur = $_POST['coiffeur'];
    $statut = 'en attente'; // valeur par défaut

    $stmt = $conn->prepare("INSERT INTO rdv (coiffure, date, heure, coiffeur, statut) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$coiffure, $date, $heure, $coiffeur, $statut]);

    header('Location: admin.php');
    exit();
}
?>
