<?php 
class Company {

	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getCompanies(){
		$this->db->query('SELECT * ,
						company.id as companyId,
						users.id as userId
						  FROM company
						  INNER JOIN users
						  ON company.user_id = users.id
						  ');;
		
		return $results = $this->db->resultSet();

	}
}

