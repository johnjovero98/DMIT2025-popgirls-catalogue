<?php
// for form validation



// function to validate blanks
function is_blank($value) {
    return !isset($value) || trim($value) === '';
}

// function to validate string length
function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length <= $max;
}

?>