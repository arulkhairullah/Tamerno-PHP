<?php
	
class Registry{
	
	/*
	* the vars array
	* access private
	*/
	private $vars = array();
	
    /*
    * magic method
    * @set undefined vars
    * @param string $index
    * @param mixed $value
    * @return void
    */
    public function __set($index, $value)
    {
   		$this->vars[$index] = $value;
    }
	
	/**
	 * magic method
	 * @get variables
	 * @param mixed $index
	 * @return mixed
	 */
	 public function __get($index)
	 {
		return $this->vars[$index];
	 }
	
}
	
?>