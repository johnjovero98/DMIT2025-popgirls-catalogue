<?php 
// setup variables
$delete_message = "";

if ($artist_name === NULL ) {
    // redirect users to the index if they mess up the query string
    header("Location: index.php");
}

// Hitting the submit button in our form wipes the query string, so we're using hidden values here. 
if (isset($_POST['delete'])) {
    $hidden_artist_id = $_POST['hidden-id'];
    delete_artist($hidden_artist_id);
    $delete_message = "successfully deleted!";
}