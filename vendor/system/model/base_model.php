<?php

class BaseModel {
	
	
	
    /**
	* @set the $registry variable
    * @access private
    */
	private $registry;
	
    /**
	* @set the $hostname variable
    * @access private
    */
	private $hostname;
	
    /**
	* @set the $hostname variable
    * @access private
    */
	private $username;
	
    /**
	* @set the $password variable
    * @access private
    */
	private $password;
	
    /**
	* @set the $database variable
    * @access private
    */
	private $database;
	
    /**
	* @set the $connection variable
    * @access private
    */
	private $connection;
	
    /**
	* @set the $port variable
	* set default value mysql port is 3306
    * @access private
    */
	private $port = 3306;
	
	
    /**
	* @set the construct method
    * @access local
	* @return void
    */
	function __construct(){
		$this->create_connection();
	}
	
    /**
	* @set the destruct method
    * @access local
	* @return void
    */
	function __destruct() {
			$this->connection->close();
	}
	
    /**
	* @set the create_connection method
    * @access local
	* @return void
    */
	function create_connection(){
		$this->get_db_configuration();
		$this->create_database_link();
		$this->check_connection();
	}
	
    /**
	* @set the create_database_link method
    * @access local
	* @return void
    */
	function create_database_link(){
		$this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
	}
	
    /**
	* @set the get_db_configuration method
    * @access local
	* @return void
    */
	function get_db_configuration(){
		$conf = new DatabaseConfiguration;
		
		$this->database	= $conf->default['database'];
		$this->username	= $conf->default['username'];
		$this->password	= $conf->default['password'];
		$this->hostname	= $conf->default['hostname'] . ':' . $this->port;
	}
	
    /**
	* @set the check_connection method
    * @access local
	* @return error message if true
    */
	function check_connection(){
		if($this->connection->connect_error) {
			trigger_error('Database connection failed: '  . $this->connection->connect_error);
		}
	}
	
    /**
	* @set the execute method
    * @access local
	* @param $sql variable contain sql language, set dafault is nil
	* @return error message if true
    */
	function execute($sql = ''){
		if( $this->connection->query($sql) ) return true;
		return false;
	}
	
    /**
	* @set the select method
    * @access local
	* @param $options variable contain params sql condition
	* @return object mysqli
    */
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
		
		return $this->connection->query($sql);
	}
	
    /**
	* @set the find_by_sql method
    * @access protected
	* @param $sql variable contain params sql condition
	* @return object mysqli
    */
	protected function find_by_sql($sql){
		return $this->select($sql);
	}
	
    /**
	* @set the find_all method
    * @access public  static
	* @param $options variable contain params sql condition
	* @return object mysqli
    */
	public static function find_all($options = array()){
		$default = array (
			'table'		=> self::static_table_name(),
			'fields'	=> '*',
			'condition'	=> '1',
			'order'		=> '1',
			'limit'		=> 50
		);
		
		$options	= array_merge($default, $options);
		$sql 		= "SELECT {$options['fields']} FROM {$options['table']} WHERE {$options['condition']} ORDER BY {$options['order']} LIMIT {$options['limit']}";
	
		return self::static_query($sql);
	}
	
    /**
	* @set the static_find_by_sql method
    * @access public  static
	* @param $sql variable contain params sql condition
	* @return object mysqli
    */
	public static function static_find_by_sql($sql){
		return self::static_query($sql);
	}
	
    /**
	* @set the static_query method
    * @access local static
	* @param $sql variable contain params sql condition
	* @return object mysqli
    */
	static function static_query($sql){
		$db = new BaseModel;
		return $db->connection->query($sql);
	}
	
    /**
	* @set the static_table_name method
    * @access local static
	* @return class name
    */
	static function static_table_name(){
		return strtolower(get_called_class());
	}
	
}
	
?>