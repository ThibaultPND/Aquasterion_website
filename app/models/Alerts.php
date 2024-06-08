<?php class Alerts
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAlertsLimits()
    {
        $sql = 'SELECT 
                    parametres.nom AS param_nom, 
                    alertes.limite_ID AS Limite_ID,
                    limites.type AS Limit_Type, 
                    limites.Valeur,
                    message_alertes.message
                    FROM alertes 
                    JOIN limites ON alertes.limite_ID = limites.ID
                    JOIN parametres ON limites.param_ID = parametres.ID
                    JOIN message_alertes ON alertes.message_ID = message_alertes.ID ';
        $result = $this->db->query($sql);
        return $result ? $result : [$result];
    }
    

    public function addNewAlerts($param = 'TEMP', $type = 'min', $valeur = 0, $message_id = 1)
    {
        $sql = 'INSERT INTO limites (ID,param_ID,type,Valeur)
                    VALUES (NULL, (SELECT ID FROM parametres WHERE nom = ?), ?, ?)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sss', $param, $type, $valeur);
        $stmt->execute();
        $last_id = $this->db->insert_id;
        

        $sql = "INSERT INTO `alerts` (ID, limite_ID, message_ID) 
                    VALUES (NULL, $last_id, $message_id)";
        $this->db->query($sql);
    }

    public function updateAlert($limiteId, $limiteName, $data_name, $limiteValue) {
        $query = 'UPDATE limites SET param_ID =  (SELECT ID FROM parametres WHERE nom = ?), type = ?, Valeur = ? WHERE ID = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssii', $data_name, $limiteName,$limiteValue, $limiteId);
        $stmt->execute();
    }

    public function deleteAlert($limiteID) {
        $sql = 'DELETE FROM limites WHERE ID = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i',$limiteID);
        $stmt->execute();
    }
    
}