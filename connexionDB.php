<?php
class ConnexionDB {
    private $connexion;

    public function __construct($host, $dbname, $username, $password) 
    {
        try 
        {
            $this->connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) 
        {
            echo "Connexion échouée: " . $e->getMessage();
        }
    }

    public function getConnexion() 
    {
        return $this->connexion;
    }
}

$connexionDB = new ConnexionDB("localhost", "test", "root", "");
$db = $connexionDB->getConnexion();

?>
