<?php
// establish connection to the database
require_once('/home/jjovero1/data/connect.php');
$connection = db_connect();

// import prepared statements
require_once('private/prepared.php');

// get the the arists name from the url
$artist_name = $_GET['artist'];

// change the doc title
$document_title = "View Artist" . " | " . $artist_name;
include('includes/header.php');



?>

<main>
    <div class="container mx-auto p-4 min-h-screen">
        <?php
        $artist_details = select_artist_by_name($artist_name)
        ?>

        <?php if (!$artist_details) : ?>
            <h2 class="text-pink-600 text-5xl my-4">No Records Found</h2>
            <p class="mb-4"><strong><?php echo $artist_name ?></strong> is not registered in our system.</p>

        <?php else : ?>
            <h2 class="text-pink-600 text-5xl mb-8 mt-4"><?php echo $artist_details['stage_name'] ?></h2>

            <div class="flex gap-4 flex-col md:flex-row">
                <div class="md:flex-40">
                    <img class="rounded-lg shadow-2xl" src="img/full/<?php echo $artist_details['image_file_name'] ?>" alt="image of <?php echo $artist_details['stage_name']?> ">
                </div>

                <div class="md:flex-50">
                    <p class="mb-4 whitespace-pre-wrap"><?php echo $artist_details['artist_description'] ?></p>
                    <p class="mb-4"><strong>Current record label:</strong> <?php echo $artist_details['current_label'] ?></p>
                    <p class="mb-4"><strong>Debut Year:</strong> <?php echo $artist_details['debut_year'] ?></p>
                    <p class="mb-4"><strong>Number of albums released:</strong> <?php echo $artist_details['num_of_albums'] ?> studio albums</p>
                    <p class="mb-4"><strong>Latest album:</strong> <?php echo $artist_details['latest_album_name'] ?></p>
                    <div class="mb-4">
                        <p class="mb-4 font-bold">Grammy Wins:</p>

                        
                        <?php
                        $grammy_count = $artist_details['num_of_grammy_wins'];
                        $i = 0;

                        if($grammy_count > 1):
                            while ($i < $grammy_count) :
                        ?>
                                <img class="inline-block w-10 h-10" src="img/grammys-icon.png" alt="grammy-icon">
                                <?php $i++ ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>None</p>
                        <?php endif ?>
        
                    </div>
                    <p class="mb-4"><strong>Billboard Hot 100&trade;:</strong> <?php echo $artist_details['billboard_hot_100_count'] ?> No.1 hits!</p>
                    <p class="mb-4"><strong>Fandom name:</strong> <?php echo $artist_details['fandom_name'] ?></p>
                    <p class="mb-4"><strong>Instagram Followers:</strong> 
                        <?php 
                            echo ($artist_details['total_ig_followers'] < 100000000) ? number_format($artist_details['total_ig_followers'] / 1000000,1) : number_format($artist_details['total_ig_followers'] / 1000000,0) 
                        ?> Million</p>
                    
                    
                    <a class="mb-4 inline-block" href="<?php echo $artist_details['instagram_link'] ?>" target="_blank">
                        <img class="inline-block w-10 h-10" src="img/instagram-seeklogo.svg" alt="instagram logo">
                    </a>
                </div>
            </div>

        <?php endif ?>

        <div class="flex justify-between mt-8">
            <a href="index.php" class="inline-block text-center text-white bg-pink-400 p-2 px-8 rounded-full hover:bg-rose-200 hover:text-black">Return Home</a>


            <?php if (isset($_SESSION['username'])) : ?>
            <div class="flex items-center">
                <a href="edit.php?artist=<?php echo urlencode($artist_details['stage_name']) ?>" class=" text-pink-700 hover:text-rose-300 flex items-center ">
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

    </div>
</main>

<?php
include('includes/footer.php');
db_disconnect($connection);
?>