<?php 

	class Login extends Controllers{
		public function __construct()
		{
			session_start();
			if(isset($_SESSION['login']))
			{
				header('Location: '.base_url().'/dashboard');
				die();
			}
			parent::__construct();
		}

		public function login()
		{
			$data['page_tag'] = 'Login '.NOMBRE_EMPESA;
			$data['page_title'] = NOMBRE_EMPESA;
			$data['page_name'] = "login";
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this,"login",$data);
		}

		public function loginUser(){
			//dep($_POST);
			if($_POST){
				if(empty($_POST['txtEmail']) || empty($_POST['txtPassword'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de datos' );
				}else{
					$strUsuario  =  strtolower(strClean($_POST['txtEmail']));
					$strPassword = hash("SHA256",$_POST['txtPassword']);
					$requestUser = $this->model->loginUser($strUsuario, $strPassword);
					if(empty($requestUser)){
						$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.' ); 
					}else{
						$arrData = $requestUser;
						if($arrData['status'] == 1){
							$_SESSION['idUser'] = $arrData['idpersona'];
							$_SESSION['login'] = true;

							$arrData = $this->model->sessionLogin($_SESSION['idUser']);
							sessionUser($_SESSION['idUser']);							
							$arrResponse = array('status' => true, 'msg' => 'ok');
						}else{
							$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo.');
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function resetPass(){
			if($_POST){
				error_reporting(0);

				if(empty($_POST['txtEmailReset'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de datos' );
				}else{
					$token = token();
					$strEmail  =  strtolower(strClean($_POST['txtEmailReset']));
					$arrData = $this->model->getUserEmail($strEmail);

					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Usuario no existente.' ); 
					}else{
						$idpersona = $arrData['idpersona'];
						$nombreUsuario = $arrData['nombres'].' '.$arrData['apellidos'];

						$url_recovery = base_url().'/login/confirmUser/'.$strEmail.'/'.$token;
						$requestUpdate = $this->model->setTokenUser($idpersona,$token);

						$dataUsuario = array('nombreUsuario' => $nombreUsuario,
											 'email' => $strEmail,
											 'asunto' => 'Recuperar cuenta - '.NOMBRE_REMITENTE,
											 'url_recovery' => $url_recovery);
						if($requestUpdate){
							$sendEmail = sendEmail($dataUsuario,'email_cambioPassword');

							if($sendEmail){
								$arrResponse = array('status' => true, 
												 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.');
							}else{
								$arrResponse = array('status' => false, 
												 'msg' => 'No es posible realizar el proceso, intenta más tarde.' );
							}
						}else{
							$arrResponse = array('status' => false, 
												 'msg' => 'No es posible realizar el proceso, intenta más tarde.' );
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function confirmUser(string $params){

			if(empty($params)){
				header('Location: '.base_url());
			}else{
				$arrParams = explode(',',$params);
				$strEmail = strClean($arrParams[0]);
				$strToken = strClean($arrParams[1]);
				$arrResponse = $this->model->getUsuario($strEmail,$strToken);
				if(empty($arrResponse)){
					header("Location: ".base_url());
				}else{
					$data['page_tag'] = "Cambiar contraseña";
					$data['page_name'] = "cambiar_contrasenia";
					$data['page_title'] = "Cambiar Contraseña";
					$data['email'] = $strEmail;
					$data['token'] = $strToken;
					$data['idpersona'] = $arrResponse['idpersona'];
					$data['page_functions_js'] = "functions_login.js";
					$this->views->getView($this,"cambiar_password",$data);
				}
			}
			die();
		}

		public function setPassword(){

			if(empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])){

					$arrResponse = array('status' => false, 
										 'msg' => 'Error de datos' );
				}else{
					$intIdpersona = intval($_POST['idUsuario']);
					$strPassword = $_POST['txtPassword'];
					$strPasswordConfirm = $_POST['txtPasswordConfirm'];
					$strEmail = strClean($_POST['txtEmail']);
					$strToken = strClean($_POST['txtToken']);

					if($strPassword != $strPasswordConfirm){
						$arrResponse = array('status' => false, 
											 'msg' => 'Las contraseñas no son iguales.' );
					}else{
						$arrResponseUser = $this->model->getUsuario($strEmail,$strToken);
						if(empty($arrResponseUser)){
							$arrResponse = array('status' => false, 
											 'msg' => 'Erro de datos.' );
						}else{
							$strPassword = hash("SHA256",$strPassword);
							$requestPass = $this->model->insertPassword($intIdpersona,$strPassword);

							if($requestPass){
								$arrResponse = array('status' => true, 
													 'msg' => 'Contraseña actualizada con éxito.');
							}else{
								$arrResponse = array('status' => false, 
													 'msg' => 'No es posible realizar el proceso, intente más tarde.');
							}
						}
					}
				}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		// Método para mostrar la vista de registro
		public function register()
		{
			$data['page_tag'] = "Registro - ".NOMBRE_EMPESA;
			$data['page_title'] = NOMBRE_EMPESA;
			$data['page_name'] = "registro";
			$data['page_functions_js'] = "functions_registro.js";
			$this->views->getView($this,"register",$data);
		}

		// Método para procesar el registro
		public function registro()
		{
			// Desactivar mensajes de error para evitar que interfieran con la respuesta JSON
			error_reporting(0);
			
			if($_POST){
				// Validar campos requeridos
				if(empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || 
				empty($_POST['txtEmail']) || empty($_POST['txtPassword']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					// Limpiar y preparar los datos
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$strPassword = hash("SHA256", $_POST['txtPassword']);
					
					// Valores por defecto para registro de cliente
					$strIdentificacion = ""; // Opcional
					$intTelefono = 0;        // Opcional
					$intTipoId = 3;          // Cliente
					$intStatus = 1;          // Activo
					
					// Debug para ver los datos que se están enviando
					error_log("Datos de registro: Nombre=$strNombre, Email=$strEmail, Rol=$intTipoId");
					
					// Intentar insertar usuario
					$request_user = $this->model->insertUsuario(
						$strIdentificacion,
						$strNombre, 
						$strApellido, 
						$intTelefono,
						$strEmail,
						$strPassword,
						$intTipoId,
						$intStatus
					);
					
					error_log("Resultado de inserción: " . $request_user);
					
					// Evaluar respuesta y preparar mensaje
					if($request_user > 0){
						$arrResponse = array('status' => true, 
										'msg' => 'Registro exitoso. Ya puedes iniciar sesión.',
										'userId' => $request_user);
					}else if($request_user == 'exist'){
						$arrResponse = array('status' => false, 
										'msg' => 'El email ya está registrado.');
					}else{
						$arrResponse = array('status' => false, 
										'msg' => 'No es posible completar el registro. Intenta más tarde.');
					}
				}
				
				// Enviar respuesta usando el método sendJson del controlador base
				// $this->sendJson($arrResponse);
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>