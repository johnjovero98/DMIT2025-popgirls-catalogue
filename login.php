<?php

// Establishing a connection to the database.
require_once('/home/jjovero1/data/connect.php');
$connection = db_connect();

// We need to define the title for this page.
$document_title = "Log In | IPGDb";
include('includes/header.php');

include('private/login-process.php');


// If the user is already logged in, get rid of them!
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

?>

<main class="min-h-screen">
    <section class="container mx-auto flex justify-center items-center p-8">
        <div class="p-8 mt-20 w-full md:w-1/2 bg-pink-50 md:px-28 shadow-lg">
            <h1 class="text-pink-600 text-4xl my-8 font-bold">Admin Login</h1>


            <p class="text-pink-900 mb-4"><?php echo $message; ?></p>



            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="mb-4">
                    <label for="username" class="form-label" class="text-lg">Username</label>
                    <input class="block w-full border p-2 rounded-lg" type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="text-lg">Password</label>
                    <input class="block w-full border p-2 rounded-lg" type="password" id="password" name="password" class="form-control" required>
                </div>

                <input class="text-white bg-fuchsia-400 py-4 px-8 rounded-full inline-block hover:bg-rose-200 hover:text-black" type="submit" id="login" name="login" value="Log In" class="btn btn-primary mt-4 ">
            </form>
        </div>
    </section>
</main>

<?php

include('includes/footer.php');

// Close the connection to the database.
db_disconnect($connection);

?>