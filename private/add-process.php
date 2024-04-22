<?php
// validation
require('validation.php');

// intialize variables
$message_add = '';

// updated values 
$stage_name   =   isset($_POST['stage_name'])  ?   $_POST['stage_name']  : '';
$description   =   isset($_POST['description'])  ?   $_POST['description']  : null;
$record_label   =   isset($_POST['current_record_label'])  ?   $_POST['current_record_label']  : '';
$debut_year   =   isset($_POST['debut_year'])  ?   $_POST['debut_year']  : '';
$album_count   =   isset($_POST['albums_released'])  ?   $_POST['albums_released']  : '';
$latest_album   =   isset($_POST['latest_album'])  ?   $_POST['latest_album']  : '';
$grammy_wins   =   isset($_POST['grammy_wins'])  ?   $_POST['grammy_wins']  : '';
$billboard_no1   =   isset($_POST['billboard'])  ?   $_POST['billboard']  : '';
$fandom_name =   isset($_POST['fandom_name'])  ?   $_POST['fandom_name']  : '';
$instagram_link   =   isset($_POST['ig_link'])  ?   $_POST['ig_link']  : '';
$instagram_followers   =   isset($_POST['ig_followers'])  ?   $_POST['ig_followers']  : '';

// error messages
$message_stage_name   =   '';
$message_description   =   '';
$message_record_label   =   '';
$message_debut_year   =   '';
$message_album_count   =   '';
$message_latest_album   =   '';
$message_grammy_wins   =   '';
$message_billboard_no1   =   '';
$message_fandom_name =   '';
$message_instagram_link   =   '';
$message_instagram_followers   =   '';


// form validation
if (isset($_POST['add'])) {
    $form_good = true;

    // sanitize variables
    $stage_name   =   filter_var($stage_name, FILTER_SANITIZE_STRING);
    $description   =   filter_var($description, FILTER_SANITIZE_STRING);
    $record_label   =   filter_var($record_label, FILTER_SANITIZE_STRING);
    $debut_year   =   filter_var($debut_year, FILTER_SANITIZE_NUMBER_INT);
    $album_count   =   filter_var($album_count, FILTER_SANITIZE_NUMBER_INT);
    $latest_album   =   filter_var($latest_album, FILTER_SANITIZE_STRING);
    $grammy_wins   =   filter_var($grammy_wins, FILTER_SANITIZE_NUMBER_INT);
    $billboard_no1   =   filter_var($billboard_no1, FILTER_SANITIZE_NUMBER_INT);
    $fandom_name =   filter_var($fandom_name, FILTER_SANITIZE_STRING);
    $instagram_link   =   filter_var($instagram_link, FILTER_SANITIZE_URL);
    $instagram_followers   =   filter_var($instagram_followers, FILTER_SANITIZE_NUMBER_INT);

    // Validate name
    if (is_blank($stage_name)) {
        $message_stage_name = 'enter the stage name';
        $form_good = false;
    } else if (!has_length_less_than($stage_name, 50)) {
        $message_stage_name = 'event name must have less than 50 characters';
        $form_good = false;
    }


    // validate description
    if (!has_length_less_than($description, 1000)) {
        $message_description = 'event description must have less than 500 characters';
        $form_good = false;
    }

    // validate record label
    if (is_blank($record_label)) {
        $message_record_label = 'enter the record label';
        $form_good = false;
    } else if (!has_length_less_than($record_label, 50)) {
        $message_stage_name = 'event name must have less than 50 characters';
        $form_good = false;
    }

    // validate debut year
    if (is_blank($debut_year)) {
        $message_debut_year = 'enter the debut year';
        $form_good = false;
    }

    // validate debut year
    if (is_blank($debut_year)) {
        $message_debut_year = 'enter the debut year';
        $form_good = false;
    }

    // validate album released
    if (is_blank($album_count)) {
        $message_album_count = 'enter the album count';
        $form_good = false;
    }


    // validate latest album
    if (is_blank($latest_album)) {
        $message_latest_album = 'enter the latest album';
        $form_good = false;
    }

    // validate grammy wins
    if (is_blank($grammy_wins)) {
        $message_grammy_wins = 'enter the grammy win count';
        $form_good = false;
    }

    // validate grammy wins
    if (is_blank($billboard_no1)) {
        $message_billboard_no1 = 'enter the billboard no.1 count';
        $form_good = false;
    }

    // validate fandom name
    if (is_blank($fandom_name)) {
        $message_fandom_name = 'enter the fandom name';
        $form_good = false;
    }

    // validate instagram link
    if (is_blank($instagram_link)) {
        $message_instagram_link = 'enter the instagram link';
        $form_good = false;
    }

    // validate instagram followers
    if (is_blank($instagram_followers)) {
        $message_instagram_followers = 'enter the instagram followers count';
        $form_good = false;
    }

    // insert into the database if it passes validation
    if ($form_good === true) {
        insert_arist($stage_name, $description, $record_label, $debut_year, $album_count, $latest_album, $grammy_wins, $billboard_no1, $fandom_name, $instagram_link, $instagram_followers);

        $message_add = "succesfully updated $stage_name's info";
        $message_add .= "<p class=\"text-xl underline text-emerald-600 hover:text-pink-500\"><a href=\"view.php?artist=$stage_name\">see artist's details</a><p>";
    } else {
        $message_add = `there is a problem updating $stage_name's info`;
    }




    $file = $_FILES['img-file'];
    // This is some of the meta data from the file the user uploaded.
    $file_name = $_FILES['img-file']['name'];
    $file_temp_name = $_FILES['img-file']['tmp_name'];
    $file_size = $_FILES['img-file']['size'];
    $file_error = $_FILES['img-file']['error'];


    // Let's grab the uploaded image's file extension. 
    $file_extension = explode('.', $file_name);
    // File extensions can be written in uppercase, so let's make sure everything is consistently formatted. 
    $file_extension = strtolower(end($file_extension));

    // GD Library doesn't natively support converting GIF to WebP, so we're not including GIFs in our array of allowed file types. 
    $allowed = array('jpg', 'jpeg', 'png', 'webp');
    if (in_array($file_extension, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 2000000) {
                // The file extension, error codes, and file size are good. Now, let's double check to make sure that the place we want to save our modified files to actually exists. 

                if (!is_dir('img/full/')) {
                    mkdir('img/full/', 0777, true);
                }
                if (!is_dir('img/thumbs/')) {
                    mkdir('img/thumbs/', 0777, true);
                }

                // Let's create a unique filename to try to avoid data collisions. 
                $file_name_new = uniqid('', true) . "." . $file_extension;
                $file_destination = 'img/full/' . $file_name_new;

                if (!file_exists($file_destination)) {
                    // When we're working with our temporary image file, let's make sure we're doing it in the correct directory, not the default tmp folder.
                    move_uploaded_file($file_temp_name, $file_destination);

                    // Since the user can upload anything, we need to check the image dimensions.
                    list($width_original, $height_original) = getimagesize($file_destination);

                    $thumb = imagecreatetruecolor(256, 256);

                    // To get a perfect square from any rectangle that the user has given us, we start by calculating the smaller size between the width and the height.
                    $smaller_size = min($width_original, $height_original);

                    // This is checking to see if this is a landscape orientation. 
                    $x_coord = ($width_original > $smaller_size) ? ($width_original - $smaller_size) / 2 : 0;

                    // Here, we're checking for a portrait orientation. 
                    $y_coord = ($height_original > $smaller_size) ? ($height_original - $smaller_size) / 2 : 0;

                    // Now that we have the size of our square and its displacement, let's create the image (based upon its filetype).
                    switch ($file_extension) {
                        case "jpeg":
                        case "jpg":
                            $src_image = imagecreatefromjpeg($file_destination);
                            break;
                        case "png":
                            $src_image = imagecreatefrompng($file_destination);
                            break;
                        case "webp":
                            $src_image = imagecreatefromwebp($file_destination);
                            break;
                        default:
                            $msg .= "I don't know how you got here, but that's an invalid file type.";
                            exit;
                    }

                    // Finally, let's do the thing! Here, we're cropping and resizing. 
                    imagecopyresampled($thumb, $src_image, 0, 0, $x_coord, $y_coord, 256, 256, $smaller_size, $smaller_size);

                    // We need to save the output.
                    imagejpeg($thumb, 'img/thumbs/' . $file_name_new, 100);

                    // Free the memory! 
                    imagedestroy($thumb);
                    imagedestroy($src_image);

                    // We need to keep track of these images' metadata so we can retrieve them later! We'll do that with a handy dandy table in our database. 
                    $sql = "UPDATE pop_girlies SET 	image_file_name = ? WHERE stage_name = ?;";

                    $statement = $connection->prepare($sql);
                    $statement->bind_param("ss", $file_name_new, $stage_name);
                    $statement->execute();

                    $msg .= "Image uploaded successfully!";

                    // If we wanted, we could redirect the user to the gallery or a preview page. 

                } else {
                    $msg .= "There was an error in processing this file. Please try again.";
                }
            } else {
                $msg .= "Your file cannot exceed 2MB. Please choose another file to upload.";
            }
        } else {
            $msg .= "There was an error with this file.";
        }
    } else {
        $msg .= "You cannot upload files of the type. Please upload one of the following: .jpg, .jpeg, .png, .webp";
    }
}
