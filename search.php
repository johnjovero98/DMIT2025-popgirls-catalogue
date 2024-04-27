<?php
// connect to the database
require_once("/home/jjovero1/data/connect.php");
$connection = db_connect();


$document_title = "Search | ipGDb";
include('includes/header.php');

?>


<main class="min-h-screen" =>
    <div class="container mx-auto mt-4 mb-4">
        <h2 class="text-pink-600 text-4xl my-8 font-bold drop-shadow-lg">Advanced Search Form</h2>
        <form action="search-results.php" method="GET">
            
            

        </form>

        

    </div>
</main>



<?php
include('includes/footer.php');
db_disconnect($connection);
?>



