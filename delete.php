<?php
// establish connection to the database
require_once('/home/jjovero1/data/connect.php');
$connection = db_connect();

// import prepared statements
require_once('private/prepared.php');

$document_title = "Delete | IPGDb";
include('includes/header.php');


$artist_name = $_GET['artist'];

// get all artist information
$artist_details = select_artist_by_name($artist_name);

$artist_name = $artist_details['stage_name'];

// reassign Artist name
require('private/delete-process.php');

?>


<main class="mt-40">
    <div class="container mx-auto min-h-screen flex items-start justify-center">
        <form class="bg-pink-50 p-8 md:px-28 shadow-lg" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <h2 class="text-pink-600 text-5xl mb-8 mt-4" >Are you sure you want to delete <strong><?php echo $_GET['artist']?></strong>?</h2>
            <!-- hidden-values -->
            <input type="hidden" id="hidden-artist" name="hidden-artist" value="<?php echo $artist_name ?>">
            
            <div class="delete-command">
                <input class="text-white bg-fuchsia-400 py-4 px-8 rounded-full inline-block mr-4 hover:bg-rose-200 hover:text-black" type="submit" id="delete" name="delete" class="btn btn-danger" value="Delete Artist">
                <a class=" text-pink-700 hover:text-rose-300 mt-4" href="index.php">Cancel</a>
            </div>
        </form>
    </div>
</main>


<?php
include('includes/footer.php');
db_disconnect($connection);

?>