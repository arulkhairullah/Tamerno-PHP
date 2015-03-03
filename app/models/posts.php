<?php
	
class Posts extends BaseModel{
	
	static function find_all_posts(){
		$sql = "SELECT * FROM posts";
		return parent::static_find_by_sql($sql);
	}
	
	public function testing(){
		return "this text";
	}
} 
	
?>