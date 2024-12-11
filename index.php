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

    // URI de connexion
    $uri = sprintf(
        "mongodb://%s:%s@%s:%d/%s?ssl=%s",
        $username,
        urlencode($password),
        $host,
        $port,
        $dbname,
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

    // Récupération des documents
    $cursor = $collection->find();

    // Parcourir les documents
    foreach ($cursor as $document) {
        echo $document["title"] . "<br>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

