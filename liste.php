
<?php
// inclure le fichier de configuration
require_once "config.php";
// Récupérer les données des membres depuis la base de données
$resultats = $membre->read();
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
  <h1>LISTE DES MEMBRES</h1>
<table>
    <thead>
        <tr>
            <th scope="col">MATRICULE</th>
            <th scope="col">PRENOM</th>
            <th scope="col">NOM</th>
            <th scope="col">SEXE</th>
            <th scope="col">SITUATION MATRIMONIALE</th>
            <th scope="col">STATUT</th>
            <th scope="col">AGE</th>
            <th scope="col">MODIFIER</th>
            <th scope="col">SUPPRIMER</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultats as $membre) { ?>
            <!-- Affichage des données dans les lignes du tableau -->
            <tr class="trow">
                <td><?php echo $membre['matricule']; ?></td>
                <td><?php echo $membre['prenom']; ?></td>
                <td><?php echo $membre['nom']; ?></td>
                <td><?php echo $membre['sexe']; ?></td>
                <td><?php echo $membre['situation_matrimoniale']; ?></td>
                <td><?php echo $membre['statut']; ?></td>
                <td><?php echo $membre['age']; ?></td>
                <!-- Bouton pour éditer les données avec un lien vers updatedata.php -->
                <td><a href="update.php?matricule=<?php echo $membre['matricule']; ?>">Edit</a></td>
                <!-- Bouton pour supprimer les données avec un lien vers deletedata.php -->
                <td><a href="delete.php?matricule=<?php echo $membre['matricule']; ?>">Delete</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>