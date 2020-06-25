<?php
date_default_timezone_set('America/Sao_Paulo');
class Classe{
	private $db;

	public function __construct(){
		$config = array();

		$config['db'] = 'scripts_fullcalendar';
		$config['host'] = 'localhost';
		$config['user'] = 'root';
		$config['pass'] = '';

		try {
			$this->db = new PDO("mysql:dbname=".$config['db'].";host=".$config['host']."", "".$config['user']."", "".$config['pass']."");
		} catch(PDOException $e) {
			echo "FALHA: ".$e->getMessage();
		}
	}

	//INSERIR AGENDA
	public function set($post){		
		$sql = $this->db->prepare("
			INSERT INTO eventos 
			SET 
			evento = :evento,
			data = :data");
		$sql->bindValue(':evento', addslashes($post['evento']));
		$sql->bindValue(':data', $post['data']);
		$sql->execute();
	}
	
	//GET AGENDA POR DATA E ID DO USUARIO
	public function getAll(){
		$array = array();

		$sql = $this->db->query('SELECT * FROM eventos');

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(PDO::FETCH_ASSOC);
		}

		return $array;
	}
	
}