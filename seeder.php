<?php
require 'vendor/autoload.php'; 

$faker = Faker\Factory::create();
$host = 'localhost';
$dbname = 'tp_produits';
$user = 'root';
$password = '';

// Connexion à MySQL
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

for ($i = 0; $i < 1000; $i++) {
    $name = $faker->sentence(3);
    $description = $faker->text(100);
    $price = $faker->randomFloat(2, 5, 100);
    $image_url = $faker->imageUrl(200, 200, 'products');

    $sql = "INSERT INTO products (name, description, price, image_url) VALUES (:name, :description, :price, :image_url)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
        ':image_url' => $image_url,
    ]);
}

echo "Données insérées avec succès !";
?>
