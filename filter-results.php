<?php
$sql = "SELECT * FROM pop_girlies WHERE 1 = 1";
$types = ""; // string to hold types for binding
$values = []; // array to hold the values to bind
$parameters = []; // empty array for parameters

foreach ($active_filters as $filter => $filter_values) {
    if (in_array($filter, ["num_of_grammy_wins"])) {
        foreach ($filter_values as $value) {
            list($min, $max) = explode("-", $value, 2);
            $range_queries[] = "$filter BETWEEN ? AND ?";
            $types .= "dd";
            $parameters[] = $min;
            $parameters[] = $max;
        }

        if (count($range_queries) > 0) {
            $sql .= " AND (" . implode(" OR ", $range_queries) . ")";
        }

        
    } else if (in_array($filter, ["billboard_hot_100_count"])) {
        foreach ($filter_values as $value) {
            list($min, $max) = explode("-", $value, 2);
            $range_queries2[] = "$filter BETWEEN ? AND ?";
            $types .= "dd";
            $parameters[] = $min;
            $parameters[] = $max;
        }

        if (count($range_queries2) > 0) {
            $sql .= " AND (" . implode(" OR ", $range_queries2) . ")";
        }
    } else if (in_array($filter, ["total_ig_followers"])) {
        foreach ($filter_values as $value) {
            list($min, $max) = explode("-", $value, 2);
            $range_queries3[] = "$filter BETWEEN ? AND ?";
            $types .= "dd";
            $parameters[] = $min;
            $parameters[] = $max;
        }

        if (count($range_queries3) > 0) {
            $sql .= " AND (" . implode(" OR ", $range_queries3) . ")";
        }
    } else if (in_array($filter, ["debut_year"])) {
        foreach ($filter_values as $value) {
            list($min, $max) = explode("-", $value, 2);
            $range_queries4[] = "$filter BETWEEN ? AND ?";
            $types .= "dd";
            $parameters[] = $min;
            $parameters[] = $max;
        }

        if (count($range_queries4) > 0) {
            $sql .= " AND (" . implode(" OR ", $range_queries4) . ")";
        }
    }
}


// Finally, we can prepare and execute our query.
$statement = $connection->prepare($sql);
if ($statement === FALSE) {
    echo "Failed to prepare the statement: " . $connection->errno . $connection->error;
    exit();
}

// This is great for testing, so we can see how many placeholders we get up to; however, don't let this make it's way into production code.
// echo "<p>" . $sql . "</p>";
// echo "</br>";
// var_dump($parameters);
// echo "</br>";
// echo $types;



// We're only going to actually bind our parameters if we have any.
if ($types) {
    $statement->bind_param($types, ...$parameters);
    $statement->execute();
}
$result = $statement->get_result();
?>

<div>
    <?php if ($result->num_rows > 0) : ?>
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