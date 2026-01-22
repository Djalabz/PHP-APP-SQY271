<?php 

session_start();

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site en PHP</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>

<!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
<header class="bg-gray-900">
  <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
    
    <div class="flex lg:flex-1">
      <a href="#" class="-m-1.5 p-1.5">
        <img src="./assets/images/fouine-noBg.png" alt="" class="h-16 w-auto" />
      </a>
    </div>

    <div class="flex lg:hidden">
      <button type="button" command="show-modal" commandfor="mobile-menu" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
        <span class="sr-only">Open main menu</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
          <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </button>
    </div>

    <el-popover-group class="hidden lg:flex lg:gap-x-12">
        <a href="#" class="text-sm/6 font-semibold text-white">Home</a>
        <a href="#" class="text-sm/6 font-semibold text-white">Shop</a>
        <a href="#" class="text-sm/6 font-semibold text-white">About</a>
        <a href="#" class="text-sm/6 font-semibold text-white">Contact</a>
    </el-popover-group>

    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
      <a href="#" class="text-sm/6 font-semibold text-white">Log out <span aria-hidden="true">&rarr;</span></a>
    </div>
  </nav>
</header>


<!-- <header>
    <nav>
        <?php if (isset($_SESSION["username"])) : ?>

            <a href="index.php">Home</a>
            <a href="shop.php">eShop</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="logout.php">Logout</a>

        <?php else : ?>

            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>

        <?php endif ?>
    </nav>
</header> -->
    
<!-- 1 - Faire un menu de navigation -> Home / About / Contact / Signout

2 - !! Si jamais la personne ,n'est pas connectée (cad que la session n'est pas créee) 
alors on affiche juste Signup / Login dans le menu

3 - Rajouter en BDD dans users une colonne avatar qui contiendra le chemin vers un avatar par défaut
Le user pourra le changer ultérieurement mais en attendant l'avatar par défaut doit s'afficher sur la homes -->