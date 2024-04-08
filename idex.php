<?php
// inclure le fichier de la configuration
require_once "config.php";

if(isset($_POST['soumetre'])){
    $prenom=$_POST['prenom'];
    $nom=$_POST['nom'];
    $tranche_age_id=$_POST['tranche_age'];
    $sexe=$_POST['sexe'];
    $situation=$_POST['situation'];
    $statut=$_POST['statut']; 
    $id=$_POST['id'];

    $situation_id=$_POST['situation_id'];

    if($prenom!="" && $nom!="" && $tranche_age_id!="" && $sexe!="" && $situation!="" && $statut!="" && $id!=""){
        $membre=new membre ($connexion, "John", "Doe", $tranche_age_id, "Masculin", "Célibataire", "Chef de quartier",$id);

        $membre->add($prenom,$nom,$tranche_age_id,$sexe, $situation, $statut, $id);
    }
}

// Récupération de la liste des situations professionnel
$id = $id->read();

// Récupération de la liste des tranches d'âge
$tranches_age = $tranche_age->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un membre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="liste.php">Liste des membres</a> 
    </nav>
</header> 

<h1>Ajouter un membre</h1>

<form action="" method="post">
    <fieldset> 
        <div class="remplir_formulaire">
            <label for="prenom">Prénom du membre :</label>
            <input type="text" name="prenom">
        </div>
        <div class="remplir_formulaire">
            <label for="nom">Nom du membre :</label>
            <input type="text" name="nom">
        </div>
        <div class="remplir_formulaire">
            <label for="tranche_age">Tranche d'âge :</label>
            <select name="tranche_age" id="tranche_age">
                <?php foreach ($tranches_age as $tranche_age) : ?>
                    <option value="<?php echo $tranche_age['id']; ?>">
                <option value="0-18">0-18</option>
                <option value="18-30">18-30</option>
                <option value="30-50">30-50</option>
                <option value="+50">+50</option>
                    
                    <?php echo $tranche_age['contenu']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="sexe">Sexe du membre :</label>
            <select name="sexe" id="sexe">
                <option value="Masculin">Masculin</option>
                <option value="Féminin">Féminin</option>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="situation_matrimoniale">Situation matrimoniale :</label>
            <select name="situation_matrimoniale" id="situation_matrimoniale">
                <option value="Célibataire">Célibataire</option>
                <option value="Marié(e)">Marié(e)</option>
                <option value="Divorcé(e)">Divorcé(e)</option>
                <option value="Veuf(ve)">Veuf(ve)</option>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="statut">Statut du membre :</label>
            <select name="statut" id="statut">
                <option value="Chef de quartier">Chef de quartier</option>
                <option value="Civile">Civile</option>
                <option value="Badian Gokh">Badian Gokh</option>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="situation_professionnel">situation_professionnel :</label>
            <select name="situation_id" id="situation_id">
                 <?php foreach ($id as $id) : ?>
                <option value="chomeur">chomeur</option>
                <option value="travailleur">travailleur</option>
                <option value="retraite">retraite</option>
                    <option value="<?php echo $id['id']; ?>"><?php echo $id['nom']; ?></option>
                <?php endforeach; ?> 
            </select>
        </div>
        <input type="submit" value="Soumettre" name="soumetre" id="bouton">
    </fieldset> 
</form>
</body>
</html>
