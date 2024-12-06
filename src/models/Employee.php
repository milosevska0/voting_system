<?php

class Employee {
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db->getConnection();
    }

    public function getAllEmployees()
    {
        $stmt = $this->db->query("SELECT id, name FROM employees");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getEmployeeNameById($employee_id) {
        $sql = "SELECT name FROM employees WHERE id = :employee_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['name'] : 'Unknown';  // Return 'Unknown' if no name is found
    }

    public function getEmployeeIdByName($name) {
        $stmt = $this->db->prepare("SELECT id FROM employees WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['id'] : null;  // Return null if no ID is found
    }
}