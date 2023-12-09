<?php

class Contact
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getContacts()
    {
        try {
            $query = "SELECT * FROM contact";
            $requete = $this->db->prepare($query);
            $requete->execute();
    
            $contacts = array();
            while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = $row;
            }
    
            return $contacts;
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
            return array();
        }
    }
    public function getContactDetails($contactId)
    {
        $query = "SELECT * FROM contact WHERE id = :contactId";
        $requete = $this->db->prepare($query);
        $requete->bindParam(':contactId', $contactId, PDO::PARAM_INT);
        $requete->execute();

        if ($requete) {
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false; 
        }
    
    }

    public function addContact($nom, $prenom, $categorie) {
        try {
            $query = "INSERT INTO contact (nom, prenom, id_categorie) VALUES (:nom, :prenom, :categorie)";
            $requete = $this->db->prepare($query);
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':prenom', $prenom);
            $requete->bindParam(':categorie', $categorie);
    
            return $requete->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

        public function editContact($contactId, $nom, $prenom, $categorie) {
            try {
                $query = "UPDATE contacts SET nom = :nom, prenom = :prenom, categorie = :categorie WHERE id = :contactId";
                
                $requete = $this->db->prepare($query);

                $requete->bindParam(":contactId", $contactId);
                $requete->bindParam(":nom", $nom);
                $requete->bindParam(":prenom", $prenom);
                $requete->bindParam(":categorie", $categorie);

                $requete->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

}

?>
