<?php
// establish connection to the database
require_once('/home/jjovero1/data/connect.php');
$connection = db_connect();

// import prepared statements
require_once('private/prepared.php');

$document_title = "Home | IPGDb";
include('includes/header.php');
?>

<main>
    <div class="container mx-auto p-4">
        <h2 class="text-pink-600 text-4xl my-8 font-bold">Gallery of female artists (a.k.a MUVAS) carrying the music industry</h2>

        <?php if (isset($_SESSION['username'])) : ?>
            <a href="add.php" class="text-2xl text-pink-700 hover:text-rose-300 flex items-center justify-end mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Add a pop girlie</span>
            </a>
        <?php endif; ?>


        <!-- read data -->
        <div class="grid grid-cols-cards gap-8 mb-8">
            <?php
            $artists = get_all_artists();
            if (count($artists) > 0) :
            ?>
                <?php foreach ($artists as $artist) :
                    extract($artist) ?>
                    <div class="shadow-lg">
                        <!-- artist image -->
                        <div>
                            <img class="rounded-t-lg w-full" src="img/thumbs/<?php echo $image_file_name ?>" alt="artist image">
                        </div>


                        <div class="border p-4">
                            <h3 class="text-xl font-bold text-pink-900"><?php echo $stage_name ?></h3>
                            <a href="view.php?artist=<?php echo urlencode($stage_name) ?>" class="block text-center text-white bg-pink-400 p-2 mt-4 rounded-full hover:bg-rose-200 hover:text-black">View Artist</a>
                        </div>

                        <?php if (isset($_SESSION['username'])) : ?>
                            <div class="flex items-center justify-between p-4 border">
                                <a href="edit.php?artist=<?php echo urlencode($stage_name) ?>" class=" text-pink-700 hover:text-rose-300 flex items-center ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg> Edit
                                </a>

                                <a href="delete.php" class=" text-pink-700 hover:text-rose-300 flex items-center ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg> Delete
                                </a>
                            </div>
                        <?php endif ?>

                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No records found</p>
            <?php endif ?>
        </div>
    </div>
</main>


<?php
include('includes/footer.php');
db_disconnect($connection);

?>