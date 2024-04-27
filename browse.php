<?php
// establish connection to the database
require_once('/home/jjovero1/data/connect.php');
$connection = db_connect();


$document_title = "Browse | IPGDb";
include('includes/header.php');

$filters = [

    "num_of_grammy_wins" => [
        "0-0" => "Zero grammy wins",
        "1-5" => "1-5 grammys",
        "6-10" => "6-10 grammys",
        "10-99" => "10+ grammys",
    ],

    "billboard_hot_100_count" => [
        "0-0" => "Zero No.1 hits",
        "1-5" => "1-5 No.1 Hits",
        "6-10" => "6-10 No.1 Hits",
        "10-99" => "10+ No.1 Hits",
    ],

    "total_ig_followers" => [
        "1000000-9999999" => "6-figure (1M to 9M)",
        "10000000-99999999" => "8-figure (10M to 99M)",
        "100000000-999999999" => "9-figure (100M to 999M)",
    ],

    "debut_year" => [
        "1980-1989" => "1980s",
        "1990-1999" => "1990s",
        "2000-2009" => "2000s",
        "2010-2099" => "2010+",
    ]
];

// Let's check our query string to see if any of our filters are currently active.
$active_filters = [];
foreach ($_GET as $filter => $values) {
    if (!is_array($values)) {
        $values = [$values];
    }
    $active_filters[$filter] = array_map("htmlspecialchars", $values);
}
?>

<main class="min-h-screen">
    <div class="container mx-auto mt-4 mb-4">
        <div class="flex gap-8 items-start flex-col md:flex-row">
            <!-- filter -->
            <div class="p-4 w-full md:w-1/4 flex-initial bg-pink-50 shadow-lg rounded-lg">
                <h2 class="text-pink-600 text-4xl pb-4 font-bold flex items-center justify-between border-b">
                    <span>Filters</span>
                    <button id="filter-button" class="md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </h2>

                <div id="filters" class="md:block mt-4">
                    <?php
                    // Let's generate the filter buttons.
                    foreach ($filters as $filter => $options) :
                        // We need headings for each of our button groups! We'll tidy up the nested array's names and use them.
                        $heading = ucwords(str_replace(["_", "-"], " ", $filter)) ?>
                        <p class="text-2xl font-bold drop-shadow-lg"><?php echo $heading ?></p>
                        <div class="mb-4">
                            <!-- Generate filters -->
                            <?php
                            foreach ($options as $value => $label) :
                                $is_active = in_array(
                                    $value,
                                    $active_filters[$filter] ?? []
                                );
                                $updated_filters = $active_filters;
                                if ($is_active) {
                                    $updated_filters[$filter] = array_diff(
                                        $updated_filters[$filter],
                                        [$value]
                                    );
                                    if (empty($updated_filters[$filter])) {
                                        unset($updated_filters[$filter]);
                                    }
                                } else {
                                    $updated_filters[$filter][] = $value;
                                }
                                // Now that we've figured out whether or not the button we're currently generating is active or not, we need to let the user click it without totally wiping out the $_GET array / query string.
                                $url = $_SERVER['PHP_SELF'] . "?" . http_build_query($updated_filters);
                            ?>
                                <a href="<?php echo $url ?>" class="filter block <?php echo ($is_active) ? 'underline text-pink-600' : 'no-underline' ?> mb-2"><?php echo $label ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>

                    <a href="browse.php" class="inline-block text-center text-white bg-pink-400 py-2 px-8 rounded-full hover:bg-rose-200 hover:text-black">Reset Filter</a>
                </div>
            </div>

            <!-- render results -->
            <div class="p-4 md:w-3/4 flex-auto">
                <!-- if there is an active filter -->
                <?php if (!empty($active_filters)) : ?>
                    <h2 class="text-pink-600 text-4xl  font-bold drop-shadow-lgs">Filter Results</h2>
                    <?php include('filter-results.php'); ?>


                <?php else : ?>
                    <!-- results if there is no filter applied -->
                    <?php
                    $sql = "SELECT * FROM pop_girlies ORDER BY num_of_grammy_wins DESC  LIMIT 8;";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $result = $statement->get_result();
                    ?>

                    <div>
                        <?php if ($result->num_rows > 0) : ?>
                            <h2 class="text-pink-600 text-4xl  font-bold drop-shadow-lgs">Top 8 Grammy Winners</h2>
                            <table class="w-full">
                                <tbody class="grid grid-cols-cards2 ">
                                    <?php while ($row = $result->fetch_assoc()) :
                                        extract($row) ?>
                                        <tr class="flex">
                                            <td class="p-2 flex-initial">
                                                <img class="rounded-full h-40 w-40 shadow-lg" src="img/thumbs/<?php echo $image_file_name ?>" alt="image of <?php echo $stage_name ?>">
                                            </td>

                                            <td class="p-2 flex-auto">
                                                <strong class="text-2xl font-bold text-pink-900"><?php echo $stage_name ?></strong>
                                                <a href="view.php?artist=<?php echo urlencode($stage_name) ?>" class="block text-center text-white bg-pink-400 py-2 px-4 mt-4 rounded-full hover:bg-rose-200 hover:text-black">View Artist</a>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>

                        <?php else : ?>
                            <p class="text-4xl my-4 font-bold drop-shadow-lg">No results found</p>
                        <?php endif ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>


<?php
include('includes/footer.php');
db_disconnect($connection);

?>