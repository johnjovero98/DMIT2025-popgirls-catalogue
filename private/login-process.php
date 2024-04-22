<!-- 

STEPS FOR LOGGING IN A Username

1. The user will try to log in with a form.

2. Our script will search for the username in the database.

3. If the username is found, it hashes the submitted password and compares it with the hashed password from the database.

4. If the hashes match, the it sets a value in the session to the user ID and redirects to a post-login page. 

 -->

<?php

$message = "";

if (isset($_POST['login'])) {
    // We should do more validation here!
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // We'll initialise our message variable right away to avoid any issues.


    if ($username && $password) {
        $statement = $connection->prepare("SELECT * FROM users WHERE username = ?;");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            /*
                password_verify() is the companion to password_hash(). It takes two arguments: 

                    1. the plain text password (that the user submitted)
                    2. the hashed password (which we just grabbed from the database)
            */
            if (password_verify($password, $row['hashed_pass'])) {
                // The reason we're regenerating our session ID here is to prevent session fixation attacks and session hijacking. 
                session_regenerate_id();

                $_SESSION['username'] = $username;

                $_SESSION['last-login'] = time();
                $_SESSION['login_expires'] = strtotime("+1 day midnight");

                header('Location: index.php');
            } else {
                $message = "Invalid username or password.";
            }
        } else {
            $message = "Invalid username or password.";
        }
    } else {
        $message = "Both fields are required.";
    }
}

?>