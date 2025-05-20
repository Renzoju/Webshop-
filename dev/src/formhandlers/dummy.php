<?php


echo"<pre>";
print_r($_POST);

if(!isset($_POST['firstname']) || empty($_POST['firstname'])) {
    header('Location: ../../firstname.php');
    exit();
}

if(!isset($_POST['lastname']) || empty($_POST['lastname'])) {
    header('Location: ../../lastname.php');
    exit();
}

if(!isset($_POST['username']) || empty($_POST['username'])) {
    header('Location: ../../username.php');
    exit();
}

if(!isset($_POST['email']) || empty($_POST['email'])) {
    header('Location: ../../email.php');
    exit();
}

if(!isset($_POST['password']) || empty($_POST['password'])) {
    header('Location: ../../password.php');
    exit();
}

$firstname = htmlentities($_POST['firstname']);
$lastname = htmlentities($_POST['lastname']);
$username = htmlentities($_POST['username']);
$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);







header('Location: ../../login.php');
exit(); 