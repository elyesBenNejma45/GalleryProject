<?php 

/**
 * 
 */
class Photo extends Db_object
{
	
/*	function __construct(argument)
	{
		# code...
	}*/
	protected static $db_table = "photos";
		protected static $db_table_fields = array('title','description','filename','type','size');
		public $id;
		public $title;
		public $description;
		public $filename;
		public $type;
		public $size;

		public $tmp_path;
		public $upload_directory= "images";
		public $error = array();
		public $upload_errors_array = array(

		0 => 'There is no error, the file uploaded with success',
	    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
	    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',	
	    3 => 'The uploaded file was only partially uploaded',
	    4 => 'No file was uploaded',
	    6 => 'Missing a temporary folder',
	    7 => 'Failed to write file to disk.',
	    8 => 'A PHP extension stopped the file upload.'



);

		public function set_file($file){

			if (empty($file) || !$file || !is_array($file)) {
				# code...
				$this->error[] ="there is no file to upload here" ;
					return false;
			} else if ($file["error"] != 0) {
				$this->error[] = $this->upload_errors_array[$file["error"]] ;
				return false;
			} else {

			 $this->filename = basename($file['name']);
			 $this->tmp_path = $file['tmp_name'];
			 $this->type = $file['type'];
			 $this->size = $file['size'];
			}

		}



		public function save(){ 

			if($this->id){
				$this->update();
			} else {
				if (!empty($this->error)) {
					return false;
				   } 
			    if (empty($this->filename)|| empty($this->tmp_path)){
					$this->$error[] = "there is no file to upload here"; 
						# code...
					return false;
					}	

					$target_path =  SITE_ROOT.DS.'admin' .DS. $this->upload_directory.DS.$this->filename;

					if (file_exists($target_path)) {
						$this->error [] = "the file {$this->filename} already exists";
						return false;
						# code...
					}

					if(move_uploaded_file($this->tmp_path, $target_path)){
						if ($this->create()) {
							# code...
							unset($this->tmp_path);
							return true;
						}

					} else {

						$this->error[] = "the file directory probably does not have permission";
						return false;
					} 

					//$this->create();
		
			}


	}

}

?>