<?php
// connect to the database
require_once("/home/jjovero1/data/connect.php");
$connection = db_connect();


$document_title = "Search | ipGDb";
include('includes/header.php');

?>


<main class="min-h-screen">
    <div class="container mx-auto mt-4 mb-4">
        <h2 class="text-pink-600 text-4xl my-8 font-bold drop-shadow-lg">Advanced Search Form</h2>
        <form action="search-results.php" method="GET" class="bg-pink-50 p-8 shadow-lg md:w-1/2" >
            <div class="mb-4">
                <label for="stage_name" class="text-lg">Stage Name:</label>
                <input type="text" name="stage_name" id="stage_name" class="form-control block w-full border p-2 rounded-lg">
                <p class="mt-2 text-pink-800"></p>
            </div>


            <h4 class="text-pink-600 text-4xl my-8 font-bold drop-shadow-lg">Filter results</h4>

            <fieldset class="mb-4">
                <legend>Grammy Wins</legend>
                <div class="from-check">
                    <input type="radio" name="grammy-wins[]" id="grammy1-5" value="1-5">
                    <label for="">1-5 Wins</label>
                </div>
                <div class="from-check">
                    <input type="radio" name="grammy-wins[]" id="grammy6-10" value="6-10">
                    <label for="">6-10 Wins</label>
                </div>
                <div class="from-check">
                    <input type="radio" name="grammy-wins[]" id="grammy10-99" value="10-99">
                    <label for="">10+ Wins</label>
                </div>
            </fieldset>

            <fieldset class="mb-4">
                <legend>Billboard No.1's</legend>
                <div class="from-check">
                    <input type="radio" name="billboard[]" id="billboard1-5" value="1-5">
                    <label for="">1-5 No.1's</label>
                </div>
                <div class="from-check">
                    <input type="radio" name="billboard[]" id="billboard6-10" value="6-10">
                    <label for="">6-10 No.1's</label>
                </div>
                <div class="from-check">
                    <input type="radio" name="billboard[]" id="billboard10-99" value="10-99">
                    <label for="">10+ No.1's</label>
                </div>
            </fieldset>

            <fieldset class="mb-4">
                <legend>Instagram Followers</legend>
                <div>
                    <div class="from-check">
                        <input type="radio" name="instagram[]" id="instagram_6figs" value="1000000-9999999">
                        <label for="">1-9 Million</label>
                    </div>
                    <div class="from-check">
                        <input type="radio" name="instagram[]" id="instagram_8figs" value="10000000-99999999">
                        <label for="">10-99 Million</label>
                    </div>
                    <div class="from-check">
                        <input type="radio" name="instagram[]" id="instagram_9figs" value="100000000-999999999">
                        <label for="">100+ Million</label>
                    </div>
                </div>
            </fieldset>

            <input type="submit" value="Search" class="btn">
        </form>

    </div>
</main>



<?php
include('includes/footer.php');
db_disconnect($connection);
?>