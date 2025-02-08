<?php
declare(strict_types=1);


const ALLOWED_METHODS = ['GET', 'POST'];
const INDEX_URI = '';
const INDEX_ROUTE = 'index';


function normalizeUri(string $uri): string {
    $uri = strtok($uri, '?');
    $uri = strtolower(trim($uri, '/'));
    return $uri === INDEX_URI ? INDEX_ROUTE : $uri;
}

function notFound(): void{
    http_response_code(404);
    echo '404 Not Found';
    exit;
};

function badRequest($message='Bad Request'):void
{
    http_response_code(400);
    echo $message;
    exit;
}

function serverError($message='Server error'):void{
    http_response_code(500);
    echo $message;
    exit;
}

function redirect(string $uri):void{
    header("Location: $uri");
    exit();         
}


function getFilePath(string $uri, string $method):string{
    return ROUTES_DIR . '/' . normalizeUri($uri) . '_' . strtolower($method) . '.php';
}

function dispatch(string $uri, string $method): void{
    // 1.) normalize uri: GET/guestbook -> routes/guestbook_get.php
    $uri = normalizeUri($uri);
    $method = strtoupper($method);
    // var_dump($uri);die; // for debugging
    // 2.) GET|POST: return 404.
    if(!in_array($method, ALLOWED_METHODS)){
        notFound();
    }

    // 3.) file path - the PHP file path
    $filePath = getFilePath($uri, $method);
    // 4.) Check if file exists, if not 404
    if(file_exists($filePath)){
        include($filePath);
        return;
    }
    notFound();

    // 5.) if exists, handle route by including the php file 
}