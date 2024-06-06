<?php
class pump
{
    private $db;
    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
    public function getMode()
    {
        $sql = 'SELECT mode FROM pompes WHERE ID = 1 ';
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['mode'];
    }

    public function getState()
    {
        $sql = 'SELECT state FROM pompes WHERE ID = 1 ';
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['state'];
    }
    public function setMode($mode)
    {
        $sql = "UPDATE pompes SET mode = '$mode' WHERE pompes.ID = 1 ";
        $this->db->query($sql);
    }

    public function setState($state)
    {
        $sql = "UPDATE pompes SET state = '$state' WHERE pompes.ID = 1 ";
        $this->db->query($sql);
    }
    public function getPumpLimits()
    {
        $sql = 'SELECT
                        d.nom AS Data_Name,
                        pl.limite_ID AS Limite_ID,
                        l.type AS limite_name,
                        l.valeur AS Data_Type
                    FROM 
                        pompes p
                    JOIN
                        Pompes_Limites pl ON p.ID = pl.pompe_ID
                    JOIN
                        limites l ON pl.limite_ID = l.ID
                    JOIN
                        parametres d ON l.param_ID = d.ID
                    WHERE
                        p.ID = 1
                    ORDER BY pl.ID';
        $result = $this->db->query($sql);
        return $result ? $result : [$result];
    }

    public function addNewLimit($param = 'TEMP', $type = 'min', $valeur = 0)
    {
        $sql = 'INSERT INTO limites (ID,param_ID,type,Valeur)
                    VALUES (NULL, (SELECT ID FROM parametres WHERE nom = ?), ?, ?)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sss', $param, $type, $valeur);
        $stmt->execute();
        $last_id = $this->db->insert_id;

        $sql = "INSERT INTO `Pompes_Limites` (`ID`, `pompe_ID`, `limite_ID`) 
                    VALUES (NULL, '1', $last_id)";
        $this->db->query($sql);
    }

    public function updateLimit($limiteId, $limiteName, $data_name, $limiteValue) {
        $query = 'UPDATE limites SET param_ID =  (SELECT ID FROM parametres WHERE nom = ?), type = ?, Valeur = ? WHERE ID = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssii', $data_name, $limiteName,$limiteValue, $limiteId);
        $stmt->execute();
    }

    public function deleteLimit($limiteID) {
        $sql = 'DELETE FROM limites WHERE ID = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i',$limiteID);
        $stmt->execute();
    }
    public function updateSystem() {
        if ($this->getMode() == 'automatique') {
            $this->setMode('manuel');
            sleep(1);
            $this->setMode('automatique');

        }
    }
}
