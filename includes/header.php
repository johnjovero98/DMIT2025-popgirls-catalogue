<?php

// This must be included on every page that you wish to access $_SESSION variables from.
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $document_title ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/custom.css">

    <script src="js/index.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
</head>

<body>
    <header class="bg-black relative">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center gap-8">
            <h1 class="text-pink-300 text-4xl font-bold"><a href="index.php">ipGDb</a></h1>

            <button id="menu-button" class="md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>


            <nav class="hidden md:block">
                <ul class="text-white flex gap-8 items-center">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="browse.php">Browse Pop Girlies</a></li>
                    <li><a href="search.php">Advanced Search</a></li>
                    
                    <li>
                        <?php if (isset($_SESSION['username'])) : ?>
                            <a href="logout.php" class="text-white bg-fuchsia-400 py-2 px-8 rounded-full inline-block hover:bg-rose-200 hover:text-black">Logout</a>
                        <?php else : ?>
                            <a href="login.php" class="text-white bg-fuchsia-400 py-2 px-8 rounded-full inline-block hover:bg-rose-200 hover:text-black">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>

            <nav id="mobile-nav" class="hidden md:hidden absolute bg-black w-full p-8 z-10 top-full left-0">
                <ul class="text-white flex gap-8 flex-col shadow-2xl">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Browse Pop Girlies</a></li>
                    <li><a href="#">Advanced Search</a></li>
                    <li>
                        <?php if (isset($_SESSION['username'])) : ?>
                            <a href="logout.php" class="text-white bg-fuchsia-400 py-2 px-8 rounded-full inline-block hover:bg-rose-200 hover:text-black">Logout</a>
                        <?php else : ?>
                            <a href="login.php" class="text-white bg-fuchsia-400 py-2 px-8 rounded-full inline-block hover:bg-rose-200 hover:text-black">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>


        </div>
    </header>