<?php class History
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
    public function getMeasures()
    {
        $sql = 'SELECT valeur,date_mesure, p.nom AS nom
                    FROM mesures m
                    JOIN parametres p ON p.ID = m.param_ID 
                    ORDER BY date_mesure DESC ';
        return $this->db->query($sql);
    }

    public function getUserAction()
    {
        $sql = 'SELECT * FROM action_utilisateur';
        return $this->db->query($sql);
    }
}