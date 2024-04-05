<?php
class membre {
    private $connexion;
    private $prenom;
    private $nom;
    private $situation_matrimoniale;
    private $sexe;
    private $situation;
    private $statut;
    private $id_age;
    public function __construct($connexion,$prenom,$nom,$situation_matrimoniale,$sexe,$statut,$id_age,){
        $this->connexion=$connexion;
        $this->prenom=$prenom;
        $this->nom=$nom;
        $this->situation_matrimoniale=$situation_matrimoniale;
        $this->sexe=$sexe;
        $this->statut=$statut;
        $this->id_age=$id_age; 
    }
     // methodes pour avoirs acces aux proprietes privees
    // les getter pour recuper
    //  les setter pour avoir acces
    public function getprenom(){
        return $this->prenom;

   }
   public function setprenom($new_prenom){
       $this->prenom=$new_prenom;
   }

   public function getnom(){
    return $this->nom;

}
public function setnom($new_nom){
   $this->nom=$new_nom;
}

public function getsituation_matrimoniale(){
    return $this->situation_matrimoniale;

}
public function setsituation_matrimoniale($new_situation_matrimoniale){
    $this->situation_matrimoniale=$new_situation_matrimoniale;
 }

public function getid_age(){
    return $this->id_age;

}

public function setid_age($new_id_age){
   $this->id_age=$new_id_age;
}
public function getsexe(){
    return $this->sexe;

}
public function setsexe($new_sexe){
   $this->sexe=$new_sexe;
}


public function getstatut(){
    return $this->statut;

}
public function setstatut($new_statut){
   $this->statut=$new_statut;
}


// methode pour ajouter des membres


public function add($prenom,$nom,$situation_matrimoniale,$sexe,$statut,$id_age){
    try {
        $sql = "INSERT INTO membre (prenom, nom, situation_matrimoniale, sexe,  statut, id_age) VALUES (  :prenom, :nom,  :situation_matrimoniale, :sexe, :statut, :id_age)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale, PDO::PARAM_STR);
        $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        $stmt->bindParam(':id_age', $id_age, PDO::PARAM_STR);
        $resultats = $stmt->execute();
        if ($resultats) {
            header("location: liste.php");
            
            exit();
        } else {
            die("Erreur : Impossible d'insérer des données.");
            
        }
    } catch (PDOException $e) {
        die("Erreur : Impossible d'insérer des données " . $e->getMessage());
    }
}


// methode pour lire les membres
public function read(){

    try{
        $sql="SELECT *, ta.age 
        FROM membre m
        INNER JOIN  tranche_age ta   ON ta.id = m.id_age;
        ";
    // preaparation de la requete
    $stmt=$this->connexion->prepare($sql);
    // execution de la requete
    $stmt->execute();
    // recuperation des elements dans un tableau
    $resultats=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultats;


    }
    
    catch(PDOException $e){
        die("erreur:impossible d'afficher les elements" .$e->getMessage());



    }
}

public function update($matricule, $prenom, $nom,  $sexe, $situation_matrimoniale, $statut,$id_age){
    try{
        // requete sql pour modifier
        $sql = "UPDATE membre SET prenom = :prenom, nom = :nom,  sexe = :sexe, situation_matrimoniale = :situation_matrimonilae, statut = :statut, id_age = :id_age WHERE matricule= :matricule";
        // preparer la requete
        $stmt = $this->connexion->prepare($sql);
        // faire les liaisons des valeurs aux parametres
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale, PDO::PARAM_STR);
        $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        $stmt->bindParam(':id_age', $id_age, PDO::PARAM_STR);
        $stmt->execute();
        //  rediriger la page
        header("location: liste.php");
        exit(); // Terminer le script après la redirection
    } catch(PDOException $e){
        die("Erreur : Impossible de mettre à jour les données : " . $e->getMessage());
    }
}

public function delete($matricule) {
    try {
        // Requête SQL pour supprimer le membre avec l'ID donné
        $sql = "DELETE FROM membre WHERE matricule = :matricule";
        // Préparation de la requête
        $stmt = $this->connexion->prepare($sql);
        // Liaison de la valeur du paramètre ID
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_INT);
        // Exécution de la requête
        $stmt->execute();
        // Redirection vers la page index après la suppression
        header("location: liste.php");
        exit(); // Arrêt du script après la redirection
    } catch(PDOException $e) {
        // Gestion de l'erreur en cas d'échec de la suppression
        die("Erreur : Impossible de supprimer le membre : " . $e->getMessage());
    }
}


}



?>