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
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header class="bg-black">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-pink-300 text-4xl font-bold"><a href="index.php">IPGDb</a></h1>

            <?php if (isset($_SESSION['username'])) : ?>
                <a href="logout.php" class="text-white bg-fuchsia-400 py-4 px-8 rounded-full inline-block hover:bg-rose-200 hover:text-black">Admin Logout</a>

            
            <?php else: ?>    
                <a href="login.php" class="text-white bg-fuchsia-400 py-4 px-8 rounded-full inline-block hover:bg-rose-200 hover:text-black">Admin Login</a>

            <?php endif; ?>

        </div>
    </header>