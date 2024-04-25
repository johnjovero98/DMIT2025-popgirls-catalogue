<?php 

// prepared statement for adding new artist
$insert_statement = $connection->prepare("INSERT INTO pop_girlies (stage_name, artist_description, current_label, debut_year, num_of_albums, latest_album_name, num_of_grammy_wins, billboard_hot_100_count, fandom_name, instagram_link, total_ig_followers) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ");
// CREATE data into the database
function insert_arist($stage_name, $artist_description, $current_label, $debut_year, $num_of_albums, $latest_album_name, $num_of_grammy_wins, $billboard_hot_100_count, $fandom_name, $instagram_link, $total_ig_followers) {
    global $connection;
    global $insert_statement;

    $insert_statement->bind_param("sssiisiissi", $stage_name, $artist_description, $current_label, $debut_year, $num_of_albums, $latest_album_name, $num_of_grammy_wins, $billboard_hot_100_count, $fandom_name, $instagram_link, $total_ig_followers);
    
    if(!$insert_statement->execute()) {
        handle_database_error("inserting an artist");
    }
}


// Preapred statement for updating an artist info
$update_statement = $connection->prepare("UPDATE pop_girlies 
    SET stage_name = ? ,
        artist_description = ?,
        current_label = ?,
        debut_year = ?,
        num_of_albums = ?,
        latest_album_name = ?,
        num_of_grammy_wins = ?,
        billboard_hot_100_count = ?, 
        fandom_name = ?,
        instagram_link = ?,
        total_ig_followers = ?
    
    WHERE stage_name = ?;");

// UPDATE event
function update_arist($new_name, 
    $new_description,
    $new_label, 
    $new_debut, 
    $new_num_albums, 
    $new_latest_album, 
    $new_grammys, 
    $new_billboard,
    $new_fandom_name,
    $new_instagram, 
    $new_followers, 
    $artist) {
    global $connection;
    global $update_statement;

    $update_statement->bind_param("sssiisiissis", $new_name, $new_description, $new_label, $new_debut, $new_num_albums, $new_latest_album, $new_grammys, $new_billboard, $new_fandom_name, $new_instagram, $new_followers, $artist);
    
    if(!$update_statement->execute()) {
        handle_database_error("inserting game");
    }
}


// handle database error
function handle_database_error($statement) {
    global $connection;
    die("Error in: " . $statement . " Error details: " . $connection->error);
}



// Prepared statement for selecting all records.
$select_statement = $connection->prepare("SELECT * FROM pop_girlies;");

// selecting all artists
function get_all_artists() {
    global $connection;
    global $select_statement;

    if(!$select_statement->execute()) {
        handle_database_error("fetching artists");
    }

    $result = $select_statement->get_result();
    $artists = [];

    while ($row = $result->fetch_assoc()) {
        // This syntax is a little PHP quirk where you can keep appending things to the end of an array rather than reassigning the entire value over and over again.
        $artists[] = $row;
    }
    return $artists;
}

// Prepared statement for selecting a specific record by artist name
$specific_select_statement_name = $connection->prepare("SELECT * FROM  pop_girlies WHERE  stage_name = ?;");

// selecting a specific artist
function select_artist_by_name($name) {
    global $connection;
    global $specific_select_statement_name;

    $specific_select_statement_name->bind_param("s", $name);

    if (!$specific_select_statement_name->execute()) {
        handle_database_error("selecting a comic book artist by name");
    }
    
    $result = $specific_select_statement_name->get_result();
    $artist = $result->fetch_assoc();

    return $artist;
}

// DELETE 
$delete_statement = $connection->prepare("DELETE FROM pop_girlies WHERE id = ?;");
function delete_artist($id) {
    global $connection;
    global $delete_statement;

    $delete_statement->bind_param("i", $id);
    if(!$delete_statement->execute()) {
        handle_database_error("deleting artist");
    }
}

?>