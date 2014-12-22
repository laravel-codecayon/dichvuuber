<?php
class Post extends BaseModel  {
	
	protected $table = 'post';
	protected $primaryKey = 'post_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT post.* FROM post  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE post.post_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
