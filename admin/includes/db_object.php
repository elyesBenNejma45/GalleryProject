<?php 

 class Db_object {


		public static function find_all(){
		   return static::findQuery("SELECT *FROM ".static::$db_table);
		}

		public static function find_by_id($id){
			$res = static::findQuery("SELECT *FROM " .static::$db_table." WHERE id = $id LIMIT 1");
			return !empty($res) ? array_shift($res) :false;
		}

		public static function findQuery($sql){
			global $database;

			$result_set = $database->query($sql);
			$the_object_array = [];
				while ($row = mysqli_fetch_array($result_set)){

				# code...
				$the_object_array[] = static::instantiate($row);
				}
		
			return $the_object_array;
		}
		public static function instantiate($the_record){

	        //$the_object = new static();
	        //$user->username = $row["id"];
	        //$user->username = $row["username"];
	        //$user->username = $row["password"];
	        //$user->first_name = $row["first_name"];
	        //$user->last_name = $row["last_name"];
	        $called_class = get_called_class();
	        $the_object = new $called_class;
	        foreach ($the_record as $the_attribute => $value) {
	        	# code...
	        	if($the_object->has_the_attribute($the_attribute)){
	        		$the_object->$the_attribute = $value;
	        	}
	        }

			return $the_object;
		}

		private function has_the_attribute($the_attribute){
			
			$object_properties = get_object_vars($this);
			return array_key_exists($the_attribute, $object_properties);
		}	

	public function save() {

		return isset($this->id) ? $this->update() : $this->create();
	}	

	public function create () {
		global $database;
		$properties = $this->clean_properties();
		$sql = "INSERT INTO ".static::$db_table ." ( ".implode(",",array_keys($properties)) ." )";
		$sql.="VALUES ('" .implode("','",array_values($properties)) ."')";

		if ($database->query($sql)) {
			# code...
			$this->id = $database->the_insert_id();
			return true;

		} else {

			return false;

		}
	}

	public function update(){
		global $database;

		$properties = $this->clean_properties();
		$properties_pairs = array();
		foreach ($properties as $key => $value) {
			# code...
			$properties_pairs[] = "{$key} ='{$value}'";
		}
		


		$sql = "UPDATE ".static::$db_table ."  SET ";
		$sql.= implode(", ", $properties_pairs);
		$sql.= " WHERE id= " .$database->escape_string($this->id);
		$database->query($sql);

		return(mysqli_affected_rows($database->connection)==1) ? true : false;
	}	

	public function delete(){
		global $database;

		$sql = "DELETE FROM ".static::$db_table;
		$sql .= " WHERE id=" .$database->escape_string($this->id);
		$sql .=" LIMIT 1";
		$database->query($sql);
		return(mysqli_affected_rows($database->connection)==1) ? true : false;
	}

	protected function clean_properties(){
		global $database;

		$clean_properties = array();
		foreach ($this->properties() as $key => $value) {
			$clean_properties[$key] = $database->escape_string($value);
			# code...
		}

		return $clean_properties;

	}	
		protected function properties(){
			//return get_object_vars($this);
			$properties = array();
			foreach (static::$db_table_fields as $db_field) {
				# code...
				if(property_exists($this, $db_field))
					$properties[$db_field] = $this->$db_field;
			}
			return  $properties;
		}


	public $tmp_path;
	public $upload_directory = "images";	
}

 ?>