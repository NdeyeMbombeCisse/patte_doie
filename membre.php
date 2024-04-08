<?php
class Membre {
    private $connexion;
    private $prenom;
    private $nom;
    private $tranche_age_id;
    private $sexe;
    private $situation;
    private $statut;
    private $situation_id; // Nouvelle propriété pour la situation professionnel



    public function __construct($connexion, $prenom, $nom,$tranche_age_id, $sexe,$situation,$statut,$situation_id){
        $this->connexion = $connexion;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->tranche_age_id = $tranche_age_id;
        $this->sexe = $sexe;
        $this->situation = $situation;
        $this->statut = $statut;
        $this->situation_id = $situation_id; // Initialisation de la situation professionnel

    }

    // Getters et setters pour la nouvelle propriété

    public function getSituation_id() {
        return $this->situation_id;
    }

    public function setSituationid($situation_id) {
        $this->situation_id = $situation_id;
    }

    // Méthodes CRUD mises à jour

    public function add($prenom, $nom,$tranche_age_id, $sexe, $situation, $statut, $situation_id){
        try {
            $sql = "INSERT INTO membre (prenom, nom, sexe, situation_id, statut, tranche_age_id, quartier_id, situation_matrimoniale) VALUES (:prenom, :nom, :age, :sexe, :situation_id, :statut, :tranche_age_id, :quartier_id, :situation_matrimoniale)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':tranche_age_id', $tranche_age_id, PDO::PARAM_INT);
            $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
            $stmt->bindParam(':situation', $situation, PDO::PARAM_STR); 
            $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
            $stmt->bindParam(':situation_id', $situation_id , PDO::PARAM_INT);
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

    public function read(){

        try{
            $sql="SELECT * FROM membre";
            $stmt=$this->connexion->prepare($sql);
            $stmt->execute();
            $resultats=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;

        }

        catch(PDOException $e){
            die("erreur:impossible d'afficher les elements" .$e->getMessage());
        }
    }

    public function update($id, $prenom, $nom, $tranche_age_id, $sexe, $situation, $statut, $situation_id){
        try{
            $sql = "UPDATE membre SET prenom = :prenom, nom = :nom, age = :age, sexe = :sexe, situation_id = :situation_id, statut = :statut, tranche_age_id = :tranche_age_id, quartier_id = :quartier_id, situation_matrimoniale = :situation_matrimoniale WHERE id = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':tranche_age_id', $tranche_age_id, PDO::PARAM_INT);
            $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
            $stmt->bindParam(':situation_id', $situation, PDO::PARAM_INT);
            $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
            $stmt->bindParam(':situation_matrimoniale', $situation_id, PDO::PARAM_STR); // Liaison pour la situation matrimoniale
            $stmt->execute();
            header("location: liste.php");
            exit();
        } catch(PDOException $e){
            die("Erreur : Impossible de mettre à jour les données : " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM membre WHERE id = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            header("location: liste.php");
            exit();
        } catch(PDOException $e) {
            die("Erreur : Impossible de supprimer le membre : " . $e->getMessage());
        }
    }
}
?>
