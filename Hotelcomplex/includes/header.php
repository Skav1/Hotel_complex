<?php require_once("includes/connection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Готелі</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="./css/style.css" media="screen" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>

<?php if (!isset($_GET['qwerty'])): ?>
  <div id="particles-js"></div>
<?php endif; ?>

<?php if (is_login()): ?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand"><span class='pricolation'>Hotel complex</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php?table=hotel"><span class="header-underline">Готелі</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?table=room"><span class="header-underline">Кімнати</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?table=staff"><span class="header-underline">Персонал</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?table=client"><span class="header-underline">Клієнти</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?table=reservation"><span class="header-underline">Бронювання</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?table=bill"><span class="header-underline">Чеки</span></a>
        </li>
      </ul>
      <div class="ms-auto text-white d-flex align-items-center">
        Привіт, <?= $_SESSION['user'][0] ?><a href="logout.php" class="text-warning text-decoration-none ps-3" title="Вийти">Вийти</a> 
      </div>
    </div>
  </div>
</nav>

<?php endif; ?>