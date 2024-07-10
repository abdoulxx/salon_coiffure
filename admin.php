<?php
session_start();

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();

    
}
// Dans votre fichier admin.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $coiffure = $_POST['coiffure'];
    $prix = $_POST['prix'];

    // Stockez ces informations dans la session
    $_SESSION['coiffure'] = $coiffure;
    $_SESSION['prix'] = $prix;

    // Redirigez l'utilisateur vers la page de réservation
    header('Location: reservation.php');
    exit();
}

?>

<?php
// Exemple de données de coiffeurs (vous devrez récupérer ces données depuis votre base de données)
$coiffeurs = [
    ['id' => 1, 'photo' => 'coif1.jpg', 'nom' => 'punch', 'prix' => '5000'],
    ['id' => 2, 'photo' => 'coif2.jpg', 'nom' => 'taper bas', 'prix' => '6000'],
    ['id' => 3, 'photo' => 'coif3.jpg', 'nom' => 'tectonic', 'prix' => '7000'],
    ['id' => 4, 'photo' => 'coif4.jpeg', 'nom' => 'degrade', 'prix' => '8000'],
    // ... ajoutez d'autres coiffeurs ici
];
?>
<?php
$coiffeurs2 = [
    ['id' => 5, 'photo' => 'coup1.jpg', 'nom' => 'coupe', 'prix' => '10000'],
    ['id' => 6, 'photo' => 'coup2.jpg', 'nom' => 'afro', 'prix' => '12000'],
    ['id' => 7, 'photo' => 'coup3.jpg', 'nom' => 'natte', 'prix' => '15000'],
    ['id' => 8, 'photo' => 'coup4.jpg', 'nom' => 'perruque', 'prix' => '30000'],
];
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
<h2 class="mb-4">💈 Liste des coiffures hommes 💈</h2>
        <div class="row">
            <?php foreach ($coiffeurs as $coiffeur): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                    <img src="<?php echo $coiffeur['photo']; ?>" class="card-img-top" alt="<?php echo $coiffeur['nom']; ?>" style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $coiffeur['nom']; ?></h5>
                            <p class="card-text"><?php echo $coiffeur['prix']; ?></p>
                            <a href="reservation.php?id=<?php echo $coiffeur['id']; ?>" class="btn btn-success">Réserver</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
        <h2 class="mb-4">💈 Liste des coiffures femmes 💈</h2>

            <?php foreach ($coiffeurs2 as $coiffeur): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                    <img src="<?php echo $coiffeur['photo']; ?>" class="card-img-top" alt="<?php echo $coiffeur['nom']; ?>" style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $coiffeur['nom']; ?></h5>
                            <p class="card-text"><?php echo $coiffeur['prix']; ?></p>
                            <a href="reservation.php?id=<?php echo $coiffeur['id']; ?>" class="btn btn-success">Réserver</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>

    
</body>

<style>
 
  .custom-navbar-color {
        background-color: #7F00FF;
    }
</style>
</html>
