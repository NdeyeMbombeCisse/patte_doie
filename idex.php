<?php
include "config.php";

try {
    $sql = "SELECT * FROM tranche_age";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    $tranche_age = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST['soumettre'])) {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $sexe = $_POST['sexe'];
        $situation_matrimoniale = $_POST['situation_matrimoniale'];
        $statut = $_POST['statut']; 
        $id_age = $_POST['id_age']; // Récupérer la tranche d'âge sélectionnée
        
        if ($prenom != "" && $nom != "" && $sexe != "" && $situation_matrimoniale != "" && $statut != "" && $id_age != "") {
            // Créer un nouvel objet membre et insérer les données dans la base de données
            $membre = new membre($connexion, $prenom, $nom, $situation_matrimoniale, $sexe, $statut, $id_age);
            $membre->add($prenom, $nom, $situation_matrimoniale, $sexe, $statut, $id_age);
        }
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>membre patte d'oie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <a href="idex.php">ADD MEMBRE</a>
        <a href="liste.php">LIST_MEMBRE</a> 
    </nav>
</header> 
<h1>AJOUTER UN MEMBRE</h1>
<form action="" method="post">
   <fieldset> 
       <div class= "remplir_formulaire">
          <label for="prenom">quelle est le prenom du membre?</label>
          <input type="text" name="prenom">
      </div>    
      <div class="remplir_formulaire">
          <label for="nom">quelle est le nom du membre?</label>
          <input type="text" name="nom">
      </div>
      <div class="remplir_formulaire">
          <label for="sexe">Quel est le sexe du membre</label>
          <select name="sexe" id="sexe">
            <option value="feminin">feminin</option>
            <option value="masculin">masculin</option>
          </select>
      </div>
      <div class="remplir_formulaire">
          <label for="situation_matrimoniale">quelle est la situation du membre?</label>
          <select name="situation_matrimoniale" id="situation_matrimoniale">
            <option value="celibataire">celibataire</option>
            <option value="marie(e)">marie(e)</option>
            <option value="veuf">veuf</option>
            <option value="veuve">veuve</option>
            <option value="divorce(e)">divorce(e)</option>
          </select>
      </div>

      <div class="remplir_formulaire">
          <label for="tranche_age">Quelle est la tranche d'âge du membre?</label>
          <select name="id_age" id="age">
            <?php foreach ($tranche_age as $tranche): ?>
                <option value="<?= $tranche['id'] ?>"><?= $tranche['age']?></option>
            <?php endforeach; ?>
          </select>
      </div>
      <div class="remplir_formulaire">
          <label for="statut">quelle est le statut du membre?</label>
          <select name="statut" id="statut">
            <option value="Chef de quartier">Chef de quartier</option>
            <option value=" civile"> civile</option>
            <option value="badian gokh">badian gokh</option>
          </select>
      </div>
      <div>
      <input type="submit" value="Soumettre" name="soumettre" id="bouton">
   </fieldset> 
</form>
</body>
</html>
