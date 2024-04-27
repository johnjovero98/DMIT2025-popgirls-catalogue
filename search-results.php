<?php
require_once("/home/jjovero1/data/connect.php");
$connection = db_connect();

$document_title = "Search Results | ipGDb";
include('includes/header.php');

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
                        <tr >
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