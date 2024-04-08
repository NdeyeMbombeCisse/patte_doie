<?php
require_once "config.php";

// Récupérer les données de l'étudiant à mettre à jour
if(isset($_GET['matricule'])) {
    $matricule = $_GET['matricule'];
    
    try {
        // Requête SQL pour sélectionner les données de l'étudiant à mettre à jour
        $sql = "SELECT * FROM membre WHERE matricule = :matricule";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Récupération des données de l'étudiant
            $membre = $stmt->fetch(PDO::FETCH_ASSOC);
            $prenom = $membre['prenom'];
            $nom = $membre['nom'];
            $sexe = $membre['sexe'];
            $situation_matrimoniale = $membre['situation_matrimoniale'];
            $statut = $membre['statut'];
            $id_age = $membre['id_age'];
        } else {
            echo "Erreur lors de la récupération des données.";
        }
    } catch(PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    echo "ID non spécifié.";
}

// Récupérer les données de la table tranche_age
$sql = "SELECT * FROM tranche_age";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$tranche_age = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mettre à jour les données du membre
if(isset($_POST['soumettre'])){
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $statut = $_POST['statut']; 
    $age = $_POST['id_age'];

    // Récupérer l'ID à partir de la requête GET
    $matricule = $_GET['matricule'];

    // Appeler la méthode update avec les nouvelles valeurs
    $membre=new membre ($connexion,"prenom","nom","sexe", "situation_matrimoniale", "statut","id_age");
   
    $membre->update($matricule, $prenom, $nom, $situation_matrimoniale, $sexe, $statut, $id_age);
    
    // Rediriger vers la page index
    header("location: liste.php");
    exit(); // Terminer le script après la redirection
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membre Patte d'Oie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <a href="index.php">AJOUTER MEMBRE</a>
        <a href="liste.php">LISTE MEMBRE</a> 
    </nav>
</header> 
<h1>MODIFIER UN MEMBRE</h1>
<form action="" method="post">
   <fieldset> 
       <div class="remplir_formulaire">
          <label for="prenom">Quel est le prénom du membre?</label>
          <input type="text" name="prenom" value="<?php echo $prenom ?>">
      </div>    
      <div class="remplir_formulaire">
          <label for="nom">Quel est le nom du membre?</label>
          <input type="text" name="nom" value="<?php echo $nom ?>">
      </div>
      <div class="remplir_formulaire">
          <label for="sexe">Quel est le sexe du membre?</label>
          <select name="sexe" id="sexe">
            <option value="feminin" <?php if ($sexe === 'feminin') echo 'selected="selected"'; ?>>Féminin</option>
            <option value="masculin" <?php if ($sexe === 'masculin') echo 'selected="selected"'; ?>>Masculin</option>
          </select>
      </div>
      <div class="remplir_formulaire">
          <label for="situation_matrimoniale">Quelle est la situation matrimoniale du membre?</label>
          <select name="situation_matrimoniale" id="situation_matrimoniale">
            <option value="celibataire" <?php if ($situation_matrimoniale === 'celibataire') echo 'selected="selected"'; ?>>Célibataire</option>
            <option value="marie(e)" <?php if ($situation_matrimoniale === 'marie(e)') echo 'selected="selected"'; ?>>Marié(e)</option>
            <option value="veuf" <?php if ($situation_matrimoniale === 'veuf') echo 'selected="selected"'; ?>>Veuf</option>
            <option value="veuve" <?php if ($situation_matrimoniale === 'veuve') echo 'selected="selected"'; ?>>Veuve</option>
            <option value="divorce(e)" <?php if ($situation_matrimoniale === 'divorce(e)') echo 'selected="selected"'; ?>>Divorcé(e)</option>
          </select>
      </div>

      <div class="remplir_formulaire">
          <label for="tranche_age">Quelle est la tranche d'âge du membre?</label>
          <select name="id_age" id="age">
            <?php foreach ($tranche_age as $tranche): ?>
                <option value="<?= $tranche['id'] ?>" <?php if ($tranche['id'] == $id_age) echo 'selected="selected"'; ?>><?= $tranche['age'] ?></option>
            <?php endforeach; ?>
          </select>
      </div>
      <div class="remplir_formulaire">
          <label for="statut">Quel est le statut du membre?</label>
          <select name="statut" id="statut">
            <option value="Chef de quartier" <?php if ($statut === 'Chef de quartier') echo 'selected="selected"'; ?>>Chef de quartier</option>
            <option value="civile" <?php if ($statut === 'civile') echo 'selected="selected"'; ?>>Civil(e)</option>
            <option value="badian gokh" <?php if ($statut === 'badian gokh') echo 'selected="selected"'; ?>>Badian Gokh</option>
          </select>
      </div>
      <div>
      <input type="submit" value="Modifier" name="soumettre" id="bouton">
   </fieldset> 
</form>
</body>
</html>
