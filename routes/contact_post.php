<?php

// CSRF Token Protection

if(!validateCsrfToken($_POST['csrf_token'] ?? null)){
    addFlashMessage('error', 'Sorry, please send the form again.');
    redirect('/contact');
}

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
    addFlashMessage("success", "Thank you for your message $safeName.");
    redirect('/guestbook');
}

addFlashMessage('error', 'Could not store the message, sorry.');
redirect('/guestbook');