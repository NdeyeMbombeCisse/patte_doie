<?php
// inclure le fichier de la configuration
require_once "config.php";

// Vérifier si l'ID du membre à supprimer est présent dans l'URL
if(isset($_GET['matricule'])) {
    // Récupérer l'ID du membre à supprimer depuis l'URL
    $matricule= $_GET['matricule'];
    
    // Appeler la méthode delete() pour supprimer le membre
    $membre->delete($matricule);
} else {
    // Rediriger vers la page index si l'ID n'est pas spécifié
    header("location: liste.php");
    exit(); // Arrêt du script après la redirection
}

?>
