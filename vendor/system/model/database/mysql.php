<?php
	
class Mysql{
	
	private $registry;
	private $hostname;
	private $username;
	private $password;
	private $database;
	private $connection;
	private $port = 3306;
	
	
	function __construct(){
		$this->create_connection();
	}
	
	function __destruct() {
			$this->connection->close();
	}
	
	function create_connection(){
		$this->get_db_configuration();
		$this->create_database_link();
		$this->check_connection();
	}
	
	function create_database_link(){
		$this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
	}
	
	function get_db_configuration(){
		$conf = new DatabaseConfiguration;
		
		$this->database	= $conf->default['database'];
		$this->username	= $conf->default['username'];
		$this->password	= $conf->default['password'];
		$this->hostname	= $conf->default['host'] . ':' . $this->port;
	}
	
    /**
	* @set the check connection
    * @access local
    */
	function check_connection(){
		if($this->connection->connect_error) {
			trigger_error('Database connection failed: '  . $this->connection->connect_error);
		}
	}
	
	function execute($sql = ''){
		if( $this->connection->query($sql) ) return true;
		return false;
	}
	
	function select($options){
		$default = array (
			'table' => '',
			'fields' => '*',
			'condition' => '1',
			'order' => '1',
			'limit' => 50
		);
		
		$options	= array_merge($default, $options);
		$sql 		= "SELECT {$options['fields']} FROM {$options['table']} WHERE {$options['condition']} ORDER BY {$options['order']} LIMIT {$options['limit']}";
		
		return $this->query($sql);
	}
	
}
	
?>