<?php 
	
	class Controllers
	{
		protected $views;
		protected $model;
		
		public function __construct()
		{
			$this->views = new Views();
			$this->loadModel();
		}

		public function loadModel()
		{
			//HomeModel.php
			$model = get_class($this)."Model";
			$routClass = "Models/".$model.".php";
			if(file_exists($routClass)){
				require_once($routClass);
				$this->model = new $model();
			}
		}
		
        // Método para enviar respuestas JSON correctamente

		protected function sendJson($data)
		{
			// Asegurarse de que no haya salida previa
			if (headers_sent()) {
				// Si ya se enviaron los encabezados, simplemente emitimos el JSON
				echo json_encode($data, JSON_UNESCAPED_UNICODE);
			} else {
				// Si podemos enviar encabezados, limpiamos cualquier salida previa
				if (ob_get_length() > 0) {
					ob_clean();
				}
				
				// Establecer encabezados
				header('Content-Type: application/json');
				
				// Enviar respuesta JSON
				echo json_encode($data, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}

 ?>