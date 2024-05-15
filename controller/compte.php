<?php

use Model\repository\UserDAO;
use Model\entity\User;

$userDAO = new UserDAO();

//LOGIN
// if user click on login button
if ($_POST['action'] == 'Login') {
    // Initialize variables to store input and error messages
    $email = $password = "";
    $email_err = $password_err = "";

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // if logins are valid
    if (!empty($email) || !empty($password)) {   
        // if user by email exist
        if($userDAO->userByEmailExist($email)) {
            // get user by email
            $user = $userDAO->getOneByEmail($email);
            // if password is correct
            if(password_verify($_POST['password'], $user->getPassword())) {
            // log the user in
            $_SESSION['user'] = $user;
            $message = 'Success';
            } else {
                $message = 'Password do not match';
            }
        } else {
            $message = 'User does not exist';
        }
    } else {
        $message = "Provide valid logins";
    }
}

// SIGNUP 
// if user click on Signup button
if ($_POST['action'] == 'Signup') {
    // Initialize variables to store input and error messages
    $username = $email = $password = $password_confirm = "";
    $username_err = $email_err = $password_err = $password_confirm_err = "";

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match("/^[a-zA-Z0-9]{5,}$/", trim($_POST["username"]))) {
        $username_err = "Username must be at least 5 characters long and contain only letters and numbers.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 5 || !preg_match("/[a-zA-Z]/", trim($_POST["password"])) || !preg_match("/[0-9]/", trim($_POST["password"]))) {
        $password_err = "Password must be at least 5 characters long and contain both letters and numbers.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate password confirmation
    if (empty(trim($_POST["password_confirm"]))) {
        $password_confirm_err = "Please confirm your password.";
    } else {
        $password_confirm = trim($_POST["password_confirm"]);
        if (empty($password_err) && ($password != $password_confirm)) {
            $password_confirm_err = "Passwords do not match.";
        }
    }

    //if form is valid
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($password_confirm_err)) {
        // if user doesn't exist

        if ((new UserDAO())::userByEmailExist($email)) {
            echo "User already exist\n";
        } else {
            // add user to db.user
            $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            $userDAO::addOne(new User(0, $username, $email, $password_hash));
            echo "User successfuly added\n";
        }
    } else {
        echo "Form is not valid\n";
    }
    exit();
}

echo $twig->render('compte.html.twig');
