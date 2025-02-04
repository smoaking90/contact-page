<?php

// CSRF Token

// Get data data from superglobal $_POST
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if(empty($name) || empty($email) || empty($message))
{
    badRequest('All fields are required.');
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    badRequest('The provided email address is invalid.');
}

connectDb();

var_dump($name, $email, $message);die;