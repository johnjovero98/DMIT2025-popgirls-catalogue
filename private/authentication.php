<?php

// AUTHENTICATION FUNCTIONS //

function log_out() {
    unset($_SESSION['username']);
    unset($_SESSION['last_login']);
    unset($_SESSION['login_expires']);

    $_SESSION = array();

    session_destroy();

    header('Location: index.php');
    exit();
}

?>