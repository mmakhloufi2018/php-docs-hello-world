<?php
require 'vendor/autoload.php'; // Inclure l'autoloader de Composer

try {
    // Connexion à MongoDB
    $client = new MongoDB\Client("mongodb://<username>:<password>@<host>:<port>/<dbname>");
    echo "Connection to database successfully<br>";

    // Sélection de la base de données
    $db = $client->selectDatabase("simoweb1-database");
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

