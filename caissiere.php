
<?php
session_start();

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

include('connexion.php');

// Récupérez la liste des réservations depuis la base de données
$stmt = $conn->prepare("SELECT * FROM rendez_vous");
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <h2 class="mb-4">Liste des Réservations</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Login Coiffeur</th>
                <th>Date</th>
                <th>Heure</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation['login_coiffeur']; ?></td>
                    <td><?php echo $reservation['date_rdv']; ?></td>
                    <td style="color: <?php echo getStatusColor($reservation['statu_rdv']); ?>"><?php echo $reservation['statu_rdv']; ?></td>
                    <td>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
function getStatusColor($status) {
    switch ($status) {
        case 'en attente':
            return 'grey';
        case 'annuler':
            return 'red';
        case 'accepter':
            return 'green';
        default:
            return 'black';
    }
}
?>

<style>

  body, html {
    height: 100%;
    margin: 0;
    overflow: hidden;
  }

  .full-screen-image {
    width: 100vw;
    height: 100vh;
    object-fit: cover;
  }
  
  .text-white{
    color:#000  !important;
  }
  .custom-navbar-color {
        background-color: #7F00FF;
    }
</style>
</html>
