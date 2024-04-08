
<?php
include_once "membre.php";
// création des constantes pour les informations de la base de données
define("DB_SERVER", "localhost");
define("USER_NAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "habitant");

// connexion avec la base de données
try {
    $connexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, USER_NAME, DB_PASSWORD);
    // Configuration de PDO pour afficher les erreurs SQL
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $membre=new membre ($connexion,"ndeye","cisse",0-18,"feminin", "mariee", "civil","chomeur");
   
   

    
} 
// affichage d'un message en cas d'erreur
catch (PDOException $e) {
    die("Erreur :: Impossible de se connecter à la base de données : " . $e->getMessage());
}
?>
