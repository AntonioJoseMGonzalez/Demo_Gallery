<?php
	require_once 'utils.php';

	class Querys extends Utils{
		private $imagen;
		private $tImg;	//total de imagenes
			
		public function __construct(){
			$this->imagen = array();
		}
		// Traemos las imagenes para el index
		public function getImagenes($inicio,$cantImg)
		{
			# code...
			parent::Conexion();
			$query = sprintf(
						"SELECT * FROM image WHERE status_id = 1 ORDER BY image_id DESC LIMIT %s,%s;",
						parent::comillas_inteligentes($inicio),
						parent::comillas_inteligentes($cantImg)
					);
					
			//echo $query;exit;
			$result = mysql_query($query);
			
			if(!$result)
				die("Regrese más tarde");

			while ($reg = mysql_fetch_assoc($result)) {
				$this->imagen[] = $reg;
			}

			return $this->imagen;	
		}	
		//*****************************************************************************
		public function TotalImagenes()
		{
			# code...
			$query = "SELECT count(*) AS total FROM image WHERE status_id = 1";
			$result = mysql_query($query,parent::Conexion());
			
			if ($reg = mysql_fetch_array($result)) {
				$this->tImg = $reg["total"];
			}
			
			return $this->tImg;
		}
		//*****************************************************************************
	    public function add_image($thumb_path, $image_path, $description, $created_by, $created_at, $updated_by, $updated_at)
	    {
	    	# code...
			parent::Conexion();

	        $consulta = sprintf("INSERT INTO image VALUES(null, %s, %s, %s, %s, %s, %s, %s, %s);",
								parent::comillas_inteligentes(1),
	                            parent::comillas_inteligentes($this->add_mage_path($thumb_path, $created_by, $created_at, $updated_by, $updated_at)),
	                            parent::comillas_inteligentes($this->add_mage_path($image_path, $created_by, $created_at, $updated_by, $updated_at)),
	                            parent::comillas_inteligentes($description),
	                            parent::comillas_inteligentes($created_by),
	                            parent::comillas_inteligentes($created_at),
	                            parent::comillas_inteligentes($updated_by),
	                            parent::comillas_inteligentes($updated_at)
								);
			//echo $consulta;exit;
			mysql_query($consulta);
		
			
	    }
	    //*****************************************************************************
	    public function delele_image($image_id)
	    {
	    	# code...
			parent::Conexion();

			$query = sprintf("UPDATE image SET status_id = 2  WHERE image_id = %s;", 
				parent::comillas_inteligentes($image_id));
			mysql_query($query);
		}
		//*****************************************************************************
		public function add_mage_path($path, $created_by, $created_at, $updated_by, $updated_at)
		{
			# code...
			parent::Conexion();
			$id;

			$consulta = sprintf("INSERT INTO image_path VALUES(null, %s, %s, %s, %s, %s);",
								parent::comillas_inteligentes($path),
	                            parent::comillas_inteligentes($created_by),
	                            parent::comillas_inteligentes($created_at),
	                            parent::comillas_inteligentes($updated_by),
	                            parent::comillas_inteligentes($updated_at)
								);
			mysql_query($consulta);
			$id = mysql_insert_id();
			//$id = $this->get_id_image_path($path);
			return $id;
		}
		//*****************************************************************************
		public function get_id_image_path($path)
		{
			# code...
			parent::Conexion();
			$id;

			$query = "SELECT image_path_id FROM image_path WHERE url_path = '".$path."' LIMIT 1;";	
			$result = mysql_query($query);

			while ($row = mysql_fetch_row($result)){ $id = $row[0];} 

			return $id;
		}
		//*****************************************************************************
		public function get_images_path()
		{
			# code...
			parent::Conexion();
			$values = array();

			$query = "SELECT thumbnail_path_id, image_path_id, image_id FROM image WHERE status_id = 1;";	
			$result = mysql_query($query);

			$index = 0;
			while ($row = mysql_fetch_row($result))
				{ 
					//$id = $row[0];
					$thumb_url = $this->get_img_thumb_url($row[0]);
					$image_url = $this->get_img_thumb_url($row[1]);
					$values[$index] = array(
											'thumb_url' => $thumb_url, 
											'image_url' => $image_url,
											'id' 	=> $row[2]);
					$index++;
				} 

			return $values;
		}
		private function get_img_thumb_url($id)
		{
			# code...
			$query_thumb = "SELECT url_path FROM image_path WHERE image_path_id = $id;";
			$result_thumb = mysql_query($query_thumb);
			$row_thumb = mysql_fetch_row($result_thumb);
			return $row_thumb[0];
		}
	}	//End Class
?>