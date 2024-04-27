<?php
// establish connection to the database
require_once('/home/jjovero1/data/connect.php');
$connection = db_connect();

// import prepared statements
require_once('private/prepared.php');

$document_title = "Home | IPGDb";
include('includes/header.php');


// pagination
include("includes/functions.php");
$per_page_card = 8;
$total_count = count_records(); //custom from functions.php


$total_pages = ceil($total_count / $per_page_card);
$current_page = (int) ($_GET['page'] ?? 1);


if ($current_page < 1 || $current_page > $total_pages || !is_int($current_page)) {
    $current_page = 1;
}
$offset = $per_page_card * ($current_page - 1);

// get all artists from the database
$artists = get_all_artists($per_page_card, $offset);
?>

<main>
    <?php if ($current_page === 1) : ?>
        <div id="banner">
            <div class="container mx-auto flex justify-end items-end h-[700px] text-white">
                <div class="md:w-1/2 mb-8 p-8">
                    <h2 class="text-pink-200 text-5xl my-8 font-bold drop-shadow-lg">Iconic Queens: Shaping the Sound of Pop Music!</h2>
                    <p class="mb-4">The Internet Pop Girls Database (ipGDb) is an online database of information related female pop stars. <strong>ipGDb&trade;</strong> provides information about the featured pop girlies, like their grammy wins, billboard no.1, description, and more!</p>
                    <p>This catalog is inspired by stan twitter.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <div class="container mx-auto p-4">
        <h2 class="text-pink-600 text-4xl my-8 font-bold drop-shadow-lg md:w-[50rem]">Gallery of female pop artists (a.k.a Muvas!) carrying the music industry</h2>
        <?php if (isset($_SESSION['username'])) : ?>
            <a href="add.php" class="text-3xl text-pink-700 hover:text-rose-300 flex items-center justify-end mb-8">
                <svg xmlns="http://www.w3org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Add a pop girlie</span>
            </a>
        <?php endif; ?>

        <form action="search-results.php" method="GET">
            <input type="search" name="quick-search" id="quick-search" class="inline-block w-full border-2 border-pink-500 p-2 px-4 mb-8 rounded-full md:w-3/4" placeholder="Search a Pop Girl">
        </form>

        <!-- read data -->
        <div class="grid grid-cols-cards gap-8 mb-8">
            <?php
            if (count($artists) > 0) :
            ?>
                <?php foreach ($artists as $artist) :
                    extract($artist) ?>
                    <div class="shadow-lg">
                        <!-- artist image -->
                        <div>
                            <img class="rounded-t-lg w-full" src="img/thumbs/<?php echo ($image_file_name != null) ? $image_file_name : 'placeholder.jpg' ?>" alt="artist image">
                        </div>
                        <div class="border p-4">
                            <h3 class="text-2xl font-bold text-pink-900"><?php echo $stage_name ?></h3>
                            <a href="view.php?artist=<?php echo urlencode($stage_name) ?>" class="block text-center text-white bg-pink-400 p-2 mt-4 rounded-full hover:bg-rose-200 hover:text-black">View Artist</a>
                        </div>

                        <?php if (isset($_SESSION['username'])) : ?>
                            <div class="flex items-center justify-between p-4 border">
                                <a href="edit.php?artist=<?php echo urlencode($stage_name) ?>" class=" text-pink-700 hover:text-rose-300 flex items-center ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg> Edit
                                </a>

                                <a href="delete.php?artist=<?php echo urlencode($stage_name) ?>" class=" text-pink-700 hover:text-rose-300 flex items-center ml-2">
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


        
        <!-- Pagination -->
        <nav aria-label="Page Number" class="mt-4 mb-8">
            <ul class="pagination justify-content-center">
                <!-- PREVIOUS: If the page is greater than one, we'll include the previous button. -->
                <?php if ($current_page > 1) : ?>
                    <li class="page-item">
                        <a href="index.php?page=<?php echo $current_page - 1; ?>" class="page-link text-pink-600">Previous</a>
                    </li>
                    <?php endif;
                // The gap is an ellipses that obscures some of the page numbers if we have a massive amount of pages.
                $gap = FALSE;
                // The window is how many pages on either side of the current page we would like to see or have generated in our loop.
                $window = 1; // window size
                for ($i = 1; $i <= $total_pages; $i++) {
                    if (($i > 1 + $window) && ($i < ($total_pages - $window)) && (abs($i - $current_page) > $window)) {
                        if (!$gap) : ?>
                            <li class="page-item"><span class="page-link">...</span></li>
                        <?php
                        endif;
                        $gap = TRUE;
                        continue;
                    }
                    $gap = FALSE;
                    // If the loop counter is the same as our current page, we'll spit out a little number button that the user can't click on but will tell them where they are.
                    if ($current_page == $i) : ?>
                        <li class="page-item active">
                            <a href="#" class="page-link"><?php echo $i; ?></a>
                        </li>
                    <?php else : ?>
                        <!-- This is our last case. If the number we're on isn't part of the ellipses (...) or if it isn't the active / current page, then we generate a number button that actually works. -->
                        <li class="page-item">
                            <a href="index.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                        </li>
                <?php endif;
                }
                ?>
                <!-- NEXT: If the current page is less than the total number of pages, then we'll include the 'Next' button. -->
                <?php if ($current_page < $total_pages) : ?>
                    <li class="page-item">
                        <a href="index.php?page=<?php echo $current_page + 1; ?>" class="page-link">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</main>


<?php
include('includes/footer.php');
db_disconnect($connection);

?>