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


$inserted = insertMessage(
    connectDb(),
    name: $name, 
    email: $email, 
    message: $message
);

if($inserted){
    $safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    echo "Thank you, $safeName, for your message.";
    exit;
}

serverError('Could not store the message, sorry.');


