<?php
include_once('dbClss.php');

class DataBaseManager
{
	public $db;
	
	public function __construct($serverName, $port, $db_name, $username, $password){
		$this->db = new DataBase($serverName, $port, $db_name, $username, $password);
mysql_query("SET NAMES 'utf8'");
	}	
}
?>
