<?php
// Inclure l'autoloader généré par Composer
require 'vendor/autoload.php';

try {
    // Paramètres de connexion à MongoDB Azure Cosmos DB
    $host = "simoweb1-server.mongo.cosmos.azure.com";
    $port = 10255;
    $username = "simoweb1-server";
    $password = "5bM7vQcnGVifk7kzIf5jpffqIYp1sAb8o0AySPBZOUkNzDOvY47dDJbjscnTvtlZ3qUXSna0LjtsACDbW7qKOQ==";
    $dbname = "simoweb1-database";
    $ssl = true;

    // Construction de l'URI avec retryWrites désactivé
    $uri = sprintf(
        "mongodb://%s:%s@%s:%d/?ssl=%s&retryWrites=false",
        $username,
        urlencode($password),
        $host,
        $port,
        $ssl ? 'true' : 'false'
    );

    // Connexion à MongoDB
    $client = new MongoDB\Client($uri);
    echo "Connection to database successfully<br>";

    // Sélection de la base de données
    $db = $client->selectDatabase($dbname);
    echo "Database selected successfully<br>";

    // Sélection de la collection
    $collection = $db->selectCollection("mycol");
    echo "Collection selected successfully<br>";

    // Préparation du document à insérer avec shard key
    $document = [
        "partitionKey" => "M@na1988", // Shard key obligatoire
        "title" => "Nouveau document",
        "description" => "Ceci est un document inséré dans MongoDB.",
        "created_at" => new MongoDB\BSON\UTCDateTime()
    ];

    // Insertion du document dans la collection
    $result = $collection->insertOne($document);

    // Afficher l'ID du document inséré
    echo "Document inserted successfully with ID: " . $result->getInsertedId() . "<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
