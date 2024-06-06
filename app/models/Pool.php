<?php
class Pool
{
    private $db;
    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getLastValueByName($dataName) {
        $dataName = $this->db->real_escape_string($dataName);
        $query = "  SELECT mesures.valeur
                            FROM mesures
                            JOIN parametres ON mesures.param_ID = parametres.ID
                            WHERE parametres.nom = '$dataName'
                            ORDER BY mesures.date_mesure DESC
                            LIMIT 1";
        $result = $this->db->query($query);
        return $result->fetch_assoc()['valeur'];
    }
    public function getLastMesureDate() {
        $query = "  SELECT date_mesure 
                            FROM mesures 
                            ORDER BY date_mesure DESC 
                            LIMIT 1";
        $result = $this->db->query($query);
        return $result->fetch_assoc()['date_mesure'];
    }
    
}
