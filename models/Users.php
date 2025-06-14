<?php
require_once('Models.php');
class Users extends Models
{
    private static $instance = null;
    protected $db;
    private $table;
    public function __construct()
    {
        require_once($this->getDocumentRoot() . '/inc/conn.php');
        $this->db = DB::getInstance();
        $this->table = 'users';
    }

    public function getWhere($where = '', $sortBy = 'id ASC')
    {
        $sql = "SELECT * FROM $this->table WHERE status != 'D'";
        
        if(!empty($where)) {
            $sql .= " $where";
        }

        $sql .= " ORDER BY $sortBy ";

        $rows = $this->db->select($sql);
        return $rows;
    }

    public function insertData($data)
    {
        $sql = "INSERT INTO $this->table (";
        $sql .= implode(",", array_keys($data)) . ') VALUES ';            
        $sql .= "('" . implode("','", array_values($data)) . "')";
        $this->db->exec($sql);
        return $this->db->lastInsertId($sql);
    }

    public function updateData($data, $where)
    {
        $set = [];
        foreach($data as $key => $value) {
            $set[] = "$key='$value'";
        }
        
        $sql = "UPDATE $this->table SET ". implode(', ', $set);
        $sql .= " WHERE $where";
        return $this->db->exec($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id=" . $id;
        return $this->db->exec($sql);
    }

    public function checkUser($where = ''){
        $sql = "SELECT COUNT(*) total_count
                FROM $this->table";
        
        if(!empty($where)) {
            $sql .= " $where";
        }
        $rows = $this->db->select($sql, 'assoc');
        return $rows['total_count'];
    }

    public function validateUser(string $email, string $password) {
        $sql = 'SELECT *
                FROM `users`
                WHERE email = \''. addSlashes($email) .'\' 
                AND password = \''. addSlashes($password) .'\' ';
		$rows = $this->db->select($sql, 'assoc');
        return $rows;
	}

    public function getUser($where) {
        $sql = "SELECT *
                FROM $this->table";
        
        if(!empty($where)) {
            $sql .= " $where";
        }

        $rows = $this->db->select($sql, 'assoc');

        return $rows;
	}
}