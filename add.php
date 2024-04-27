<?php
// establish connection to the database
require_once('/home/jjovero1/data/connect.php');
$connection = db_connect();

// import prepared statements
require_once('private/prepared.php');

// change the doc title
$document_title = "Register a Pop Girlie | IPGDb";
include('includes/header.php');

$msg = $msg ?? "";
require('private/add-process.php');



?>
<?php if (isset($_SESSION['username'])) : ?>
<main>
    <div class="container mx-auto p-4 min-h-screen">
    <?php if (isset($message_add)) : ?>
            <p class="text-xl text-emerald-400"><?php echo $message_add ?></p>
            <p class="text-xl underline text-emerald-600 hover:text-pink-500"></p>
        <?php endif; ?>

        <h2 class="text-pink-600 text-5xl mb-8 mt-4">Add a Pop Girlie</h2>

        <form class="bg-pink-50 p-8 md:px-28 shadow-lg" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
            <div class="flex gap-8 items-start justify-between flex-col md:flex-row">
                <!-- upload image -->
                <div class="bg-pink-200 p-8 rounded-lg w-full">
                    <label for="img-file" class="text-2xl mb-4 block font-semibold">Upload Artist Image</label>
                    <input type="file" name="img-file" id="img-file">
                </div>

                <!-- text info -->
                <div class="w-full">
                    <div class="mb-4">
                        <label for="stage_name" class="text-lg">Stage Name:</label>
                        <input type="text" name="stage_name" id="stage_name" class="block w-full border p-2 rounded-lg" 
                            value="<?php if(isset($_POST['stage_name'])) echo $_POST['stage_name']?>">
                        <p class="mt-2 text-pink-800"><?php echo $message_stage_name ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="text-lg">Artist's Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="block border w-full p-2 rounded-lg"><?php if(isset($_POST['description'])) echo $_POST['description']?></textarea>
                        <p class="mt-2 text-pink-800"><?php echo $message_description ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="current_record_label" class="text-lg">Current record label:</label>
                        <input type="text" name="current_record_label" id="current_record_label" class="block w-full border p-2 rounded-lg" 
                            value="<?php if(isset($_POST['current_record_label'])) echo $_POST['current_record_label']?>">
                        <p class="mt-2 text-pink-800"><?php echo $message_record_label ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="debut_year" class="text-lg">Debut Year:</label>
                        <input type="number" name="debut_year" id="debut_year" min="1900" max="2099" class="block w-full border p-2 rounded-lg" 
                            value="<?php if(isset($_POST['debut_year'])) echo $_POST['debut_year']?>">
                        <p class="mt-2 text-pink-800"><?php echo $message_debut_year ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="albums_released" class="text-lg">Number of albums released:</label>
                        <input type="number" name="albums_released" id="albums_released" min="0" class="block w-full border p-2 rounded-lg" 
                            value="<?php if(isset($_POST['albums_released'])) echo $_POST['albums_released']?>">
                        <p class="mt-2 text-pink-800"><?php echo $message_album_count ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="latest_album" class="text-lg">Latest album:</label>
                        <input type="text" name="latest_album" id="latest_album" class="block w-full border p-2 rounded-lg" 
                            value="<?php if(isset($_POST['latest_album'])) echo $_POST['latest_album']?>">
                        <p class="mt-2 text-pink-800"><?php echo $message_latest_album ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="grammy_wins" class="text-lg">Grammy Wins:</label>
                        <input type="number" name="grammy_wins" id="grammy_wins" min="0" class="block w-full border p-2 rounded-lg" 
                            value="<?php if(isset($_POST['grammy_wins'])) echo $_POST['grammy_wins']?>">
                        <p class="mt-2 text-pink-800"><?php echo $message_grammy_wins ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="billboard" class="text-lg">Billboard Hot 100&trade; No.1's:</label>
                        <input type="number" name="billboard" id="billboard" min="0" class="block w-full border p-2 rounded-lg" 
                            value="<?php if(isset($_POST['billboard'])) echo $_POST['billboard']?>">
                        <p class="mt-2 text-pink-800"><?php echo $message_billboard_no1 ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="fandom_name" class="text-lg">Fandom name:</label>
                        <input type="text" name="fandom_name" id="fandom_name" min="0" class="block w-full border p-2 rounded-lg" 
                            value="<?php if(isset($_POST['fandom_name'])) echo $_POST['fandom_name']?>">
                        <p class="mt-2 text-pink-800"><?php echo $message_fandom_name ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="ig_link" class="text-lg">Instagram link:</label>
                        <input type="url" name="ig_link" id="ig_link" class="block w-full border p-2 rounded-lg" 
                            value="<?php if(isset($_POST['ig_link'])) echo $_POST['ig_link']?>">
                        <p class="mt-2 text-pink-800"><?php echo $message_instagram_link ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="ig_followers" class="text-lg">Instagram Followers:</label>
                        <input type="number" name="ig_followers" id="ig_followers" min="0" max="9999999999" class="block w-full border p-2 rounded-lg" 
                            value="<?php if(isset($_POST['ig_followers'])) echo $_POST['ig_followers']?>">
                        <p class="mt-2 text-pink-800"><?php echo $message_instagram_followers ?></p>
                    </div>
                </div>
            </div>


            <div class="flex flex-col items-end justify-end">
                <input type="submit" id="add" name="add" value="Register This Pop Girl" class="text-white bg-fuchsia-400 py-2 px-8 rounded-full inline-block hover:bg-rose-200 hover:text-black mt-8">

                <a href="index.php" class="flex text-pink-700 hover:text-rose-300 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg> Cancel
                </a>
            </div>
        </form>
    </div>
</main>

<?php else:
     header('Location: login.php')
     
     ?>

<?php endif ?>

<?php
include('includes/footer.php');
db_disconnect($connection);


?>