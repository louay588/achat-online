<?php
$host = 'localhost';
$dbname = 'produits';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $produit = $_POST['produit'];
        $taille = $_POST['taille'];

        $stmt = $pdo->prepare("INSERT INTO commandes (nom, email, produit, taille) VALUES (:nom, :email, :produit, :taille)");
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':produit' => $produit,
            ':taille' => $taille
        ]);

        echo "Commande enregistrée avec succès !";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
