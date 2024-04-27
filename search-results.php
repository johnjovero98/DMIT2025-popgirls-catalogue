<?php
require_once("/home/jjovero1/data/connect.php");
$connection = db_connect();

$document_title = "Search Results | ipGDb";
include('includes/header.php');


// form the advanced search form
$artist_name = isset($_GET['stage_name']) ? $_GET['stage_name'] : '';
$grammy_wins =  isset($_GET['grammy-wins']) ? $_GET['grammy-wins'] : array('');
$billboard_no1 =  isset($_GET['billboard']) ? $_GET['billboard'] : array('');
$ig_followers =  isset($_GET['instagram']) ? $_GET['instagram'] : array('');

// from the quick seearhc widget
$quick_search = isset($_GET['quick-search']) ? $_GET['quick-search'] : '';

?>

<main class="min-h-screen">
    <div class="container mx-auto">
        <h2 class="text-pink-600 text-5xl my-8 font-bold drop-shadow-lg">Search Results</h2>
        <!-- process results -->
        <?php

        // prepared statement
        $sql = "SELECT * FROM pop_girlies WHERE 1 = 1";
        $parameters = [];
        $types = '';

        // quick search
        if (isset($_GET['quick-search'])) {
            // quick search
            if ($quick_search != '') {
                $sql .= " AND stage_name LIKE CONCAT('%', ?, '%')";

                $parameters[] = $quick_search;
                $types .= "s";
            }
        }

        // Comic Title 
        if ($artist_name != '') {
            $sql .= " AND stage_name LIKE CONCAT('%', ?, '%')";
            $parameters[] = $artist_name ;
            $types .= "s";
        }



        if (isset($_GET['grammy-wins'])) {
            foreach ($grammy_wins as $value) {
                list($min, $max) = explode("-", $value, 2);
                $range_queries[] = "num_of_grammy_wins BETWEEN ? AND ?";
                $types .= "dd";
                $parameters[] = $min;
                $parameters[] = $max;
            }
            if (count($range_queries) > 0) {
                $sql .= " AND (" . implode(" OR ", $range_queries) . ")";
            }
        }

        if (isset($_GET['billboard'])) {

            foreach ($billboard_no1 as $value) {
                list($min, $max) = explode("-", $value, 2);
                $range_queries2[] = "billboard_hot_100_count BETWEEN ? AND ?";
                $types .= "dd";
                $parameters[] = $min;
                $parameters[] = $max;
            }
            if (count($range_queries2) > 0) {
                $sql .= " AND (" . implode(" OR ", $range_queries2) . ")";
            }
        }

        if (isset($_GET['instagram'])) {

            foreach ($ig_followers as $value) {
                list($min, $max) = explode("-", $value, 2);
                $range_queries3[] = "total_ig_followers BETWEEN ? AND ?";
                $types .= "dd";
                $parameters[] = $min;
                $parameters[] = $max;
            }
            if (count($range_queries3) > 0) {
                $sql .= " AND (" . implode(" OR ", $range_queries3) . ")";
            }
        }

        // order by name
        $sql .= ' ORDER BY stage_name ASC;';

        // for debugging purposes
        // echo $sql;
        // echo '</br>';
        // var_dump($parameters);

        // execute sql
        if ($statement = $connection->prepare($sql)) {
            if ($types) {
                $statement->bind_param($types, ...$parameters);
            }
        }

        $statement->execute();
        $result = $statement->get_result();
        ?>

        <!-- render results -->
        <?php if ($result->num_rows > 0) : ?>
            <table>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) :
                        extract($row) ?>
                        <tr>
                            <td class="p-2">
                                <img class="rounded-full h-40 w-40 shadow-lg" src="img/thumbs/<?php echo $image_file_name ?>" alt="image of <?php echo $stage_name ?>">
                            </td>

                            <td class="p-2">
                                <strong class="text-2xl font-bold text-pink-900"><?php echo $stage_name ?></strong>
                                <a href="view.php?artist=<?php echo urlencode($stage_name) ?>" class="block text-center text-white bg-pink-400 py-2 px-4 mt-4 rounded-full hover:bg-rose-200 hover:text-black">View Artist</a>
                            </td>
                        </tr>
                    <?php endwhile ?>

                </tbody>
            </table>

        <?php else : ?>
            <p class="text-4xl my-4 font-bold drop-shadow-lg">No results found</p>
            <a href="#" class="text-pink-700 hover:text-rose-300 hover:underline inline-block mb-4">Back to the Advance Search Form</a>
        <?php endif ?>

    </div>
</main>

<?php
include('includes/footer.php');
db_disconnect($connection);
?>