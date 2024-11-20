<?php
// Informations de connexion à la base de données
$host = 'localhost'; // Adresse du serveur
$dbname = 'schein_db'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur
$password = ''; // Mot de passe (vide pour XAMPP)

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification des données soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);

    // Enregistrement des données dans la base
    try {
        $stmt = $conn->prepare("INSERT INTO buyers (name, address) VALUES (:name, :address)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->execute();

        echo "<p class='success'>Informations enregistrées avec succès !</p>";
    } catch (PDOException $e) {
        echo "<p class='error'>Erreur : " . $e->getMessage() . "</p>";
    }
}
?>

