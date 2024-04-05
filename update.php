

<?php
// inclure le fichier de la configuration
require_once "config.php";

if(isset($_POST['soumetre'])){
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $sexe = $_POST['sexe'];
    $situation_matrimonilae = $_POST['situation_matrimoniale'];
    $statut = $_POST['statut']; 

    // Récupérer l'ID à partir de la requête GET
    $id = $_GET['id'];

    // Appeler la méthode update avec les nouvelles valeurs
    $membre->update($matricule, $prenom, $nom, $situation_matrimoniale, $sexe,  $statut,$id_age,);
    
    // Rediriger vers la page index
    header("location: liste.php");
    exit(); // Terminer le script après la redirection
}

// Récupérer les données de l'étudiant à mettre à jour
$matricule = $_GET['matricule'];

if(isset($matricule)) {
    try {
        // Requête SQL pour sélectionner les données de l'étudiant à mettre à jour
        $sql = "SELECT * FROM membre WHERE matricule= :matricule";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Récupération des données de l'étudiant
            $membre = $stmt->fetch(PDO::FETCH_ASSOC);
            $prenom = $membre['prenom'];
            $nom = $membre['nom'];
            $sexe = $membre['sexe'];
            $situation = $membre['situation_matricule'];
            $statut = $membre['statut'];
            $age = $membre['id_age'];
        } else {
            echo "Erreur lors de la récupération des données.";
        }
    } catch(PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    echo "ID non spécifié.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du membre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="liste.php">Liste des membres</a> 
    </nav>
</header> 

<h1>Mise à jour du membre</h1>

<form action=" update.php?id=<?php echo $id;?>" method="post">
    <fieldset> 
        <div class="remplir_formulaire">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value="<?php echo $prenom ?>">
        </div>
        <div class="remplir_formulaire">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?php echo $nom ?>">
        </div>
        <div class="remplir_formulaire">
            <label for="sexe">Sexe :</label>
            <select name="sexe" id="sexe">
                <option value="feminin" <?php if($sexe == "feminin") echo "selected"; ?>>feminin</option>
                <option value="masculin" <?php if($sexe == "masculin") echo "selected"; ?>>masculin</option>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="situation_matrimoniale">Situation :</label>
            <input type="text" name="situation_matrimonale" value="<?php echo $situation_matrimoniale ?>">
        </div>
        <div class="remplir_formulaire">
            <label for="statut">Statut :</label>
            <select name="statut" id="statut">
                <option value="Chef de quartier" <?php if($statut == "Chef de quartier") echo "selected"; ?>>Chef de quartier</option>
                <option value="Civile" <?php if($statut == "Civile") echo "selected"; ?>>Civile</option>
                <option value="Badian Gokh" <?php if($statut == "Badian Gokh") echo "selected"; ?>>Badian Gokh</option>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="age">Âge :</label>
            <select name="id_age" id="id_age">
            <?php foreach ($tranches_age as $tranche_age): ?>
                <option value="<?= $tranche_age->getid() ?>" ><?= $tranche_age->getage()?></option>
            <?php endforeach; ?>
        </div>

       <div> <input type="submit" value="Soumettre" name="soumetre" id="bouton"></div>
    </fieldset> 
</form>
</body>
</html>
