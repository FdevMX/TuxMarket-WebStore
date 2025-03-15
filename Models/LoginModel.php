<?php 

	class LoginModel extends Mysql
	{
		private $intIdUsuario;
		private $strUsuario;
		private $strPassword;
		private $strToken;

		public function __construct()
		{
			parent::__construct();
		}	

		public function loginUser(string $usuario, string $password)
		{
			$this->strUsuario = $usuario;
			$this->strPassword = $password;
			$sql = "SELECT idpersona,status FROM persona WHERE 
					email_user = '$this->strUsuario' and 
					password = '$this->strPassword' and 
					status != 0 ";
			$request = $this->select($sql);
			return $request;
		}

		public function sessionLogin(int $iduser){
			$this->intIdUsuario = $iduser;
			//BUSCAR ROLE 
			$sql = "SELECT p.idpersona,
							p.identificacion,
							p.nombres,
							p.apellidos,
							p.telefono,
							p.email_user,
							p.nit,
							p.nombrefiscal,
							p.direccionfiscal,
							r.idrol,r.nombrerol,
							p.status 
					FROM persona p
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.idpersona = $this->intIdUsuario";
			$request = $this->select($sql);
			$_SESSION['userData'] = $request;
			return $request;
		}

		public function getUserEmail(string $strEmail){
			$this->strUsuario = $strEmail;
			$sql = "SELECT idpersona,nombres,apellidos,status FROM persona WHERE 
					email_user = '$this->strUsuario' and  
					status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function setTokenUser(int $idpersona, string $token){
			$this->intIdUsuario = $idpersona;
			$this->strToken = $token;
			$sql = "UPDATE persona SET token = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function getUsuario(string $email, string $token){
			$this->strUsuario = $email;
			$this->strToken = $token;
			$sql = "SELECT idpersona FROM persona WHERE 
					email_user = '$this->strUsuario' and 
					token = '$this->strToken' and 					
					status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPassword(int $idPersona, string $password){
			$this->intIdUsuario = $idPersona;
			$this->strPassword = $password;
			$sql = "UPDATE persona SET password = ?, token = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function insertUsuario(string $identificacion, string $nombre, string $apellido, 
									 int $telefono, string $email, string $password, 
									 int $tipoid, int $status)
		{
			try {
				// Guardar los valores en propiedades
				$this->strIdentificacion = $identificacion;
				$this->strNombre = $nombre;
				$this->strApellido = $apellido;
				$this->intTelefono = $telefono;
				$this->strEmail = $email;
				$this->strPassword = $password;
				$this->intTipoId = $tipoid;
				$this->intStatus = $status;
				$return = 0;
				
				// Mostrar datos para depuración
				error_log("Intentando registrar: " . $email);
				
				// Verificar si el email ya existe
				$sql = "SELECT * FROM persona WHERE email_user = '{$this->strEmail}'";
				if(!empty($this->strIdentificacion)){
					$sql .= " OR identificacion = '{$this->strIdentificacion}'";
				}
				
				error_log("SQL de verificación: " . $sql);
				$request = $this->select_all($sql);
				
				if(empty($request))
				{
					// Preparar inserción
					$query_insert = "INSERT INTO persona(identificacion,nombres,apellidos,telefono,email_user,password,rolid,status) 
								  VALUES(?,?,?,?,?,?,?,?)";
					
					// Crear array de datos
					$arrData = array(
						$this->strIdentificacion,
						$this->strNombre,
						$this->strApellido,
						$this->intTelefono,
						$this->strEmail,
						$this->strPassword,
						$this->intTipoId,
						$this->intStatus
					);
					
					// Intentar insertar y capturar el resultado
					error_log("Ejecutando inserción con datos: " . json_encode($arrData));
					
					// Verificar si realmente hay conexión a la base de datos
					if($this->conexion){
						// Intentar inserción directa con PDO si hay problemas
						try {
							$stmt = $this->conexion->prepare($query_insert);
							$result = $stmt->execute($arrData);
							if($result) {
								$return = $this->conexion->lastInsertId();
								error_log("Inserción exitosa: ID=" . $return);
							} else {
								$error = $stmt->errorInfo();
								error_log("Error PDO: " . json_encode($error));
								$return = 0;
							}
						} catch(Exception $e) {
							error_log("Excepción PDO: " . $e->getMessage());
							// Si falla, intentamos con el método original
							$request_insert = $this->insert($query_insert, $arrData);
							$return = $request_insert;
							error_log("Resultado del insert(): " . $return);
						}
					} else {
						// Usar el método heredado de la clase padre
						$request_insert = $this->insert($query_insert, $arrData);
						$return = $request_insert;
						error_log("Resultado del insert(): " . $return);
					}
				} else {
					error_log("Usuario ya existe en la base de datos");
					$return = "exist";
				}
				
				return $return;
			} catch(Exception $e) {
				error_log("Error en insertUsuario: " . $e->getMessage());
				return 0;
			}
		}
	}
 ?>