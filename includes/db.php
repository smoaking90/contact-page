<?php

function connectDb(): PDO{
    $pdo = new PDO('sqlite:' . DB_DIR . '/db.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function loadSchema(PDO $pdo, string $schemaFile):void{
    $sql = file_get_contents($schemaFile);
    if($sql === false){
        die("Failed to load schema from file: $schemaFile");
    }
    $pdo->exec($sql);
    echo "Schema successfully loaded\n";
}