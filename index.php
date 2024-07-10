<?php
session_start();
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
    <a class="navbar-brand" style="color:white" href="index.php">ddd000 Radieux</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item me-3">
          <a class="nav-link active" style="color:white" aria-current="page" href="#">reserver</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link"style="color:white" href="#">mes commandes</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link"style="color:white" href="login.php">Connexion <i class="fa fa-user" aria-hidden="true"></i>
</a>
<li class="nav-item me-3">
          <a class="nav-link" style="color:white" href="inscription.php">Inscription</a>
        </li>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="position-relative">
  <img src="1.png" alt="Image Plein Écran" class="full-screen-image">
</div>
<div class="position-absolute text-center" style="top: 45%; left: 50%; transform: translate(-50%, -50%);">
    <h1 class="text-white">Bienvenue chez reflet radieux, </h1>
    <p>
    <h5>venez vous rendre beau à moindre coût</h5>
    </p>
  </div>

</body>

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
