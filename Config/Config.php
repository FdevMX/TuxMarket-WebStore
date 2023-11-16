<?php 
	// const BASE_URL = "http://localhost/tienda_virtual";
	const BASE_URL = "https://tuxmarket-production.up.railway.app/";
	//const BASE_URL = "https://abelosh.com/tiendavirtual";

	//Zona horaria
	date_default_timezone_set('America/Mexico_City');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "db_tiendavirtual";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";

	//Para envío de correo
	const ENVIRONMENT = 1; // Local: 0, Produccón: 1;

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "$";
	const CURRENCY = "USD";

	//Api PayPal
	//SANDBOX PAYPAL
	const URLPAYPAL = "https://api-m.sandbox.paypal.com";
	const IDCLIENTE = "";
	const SECRET = "";
	//LIVE PAYPAL
	//const URLPAYPAL = "https://api-m.paypal.com";
	//const IDCLIENTE = "";
	//const SECRET = "";

	//Datos envio de correo
	const NOMBRE_REMITENTE = "TuxMarket";
	const EMAIL_REMITENTE = "no-reply@tuxmarket.com";
	const NOMBRE_EMPESA = "TuxMarket";
	const WEB_EMPRESA = "www.tuxmarket.shop";

	const DESCRIPCION = "¡Siempe a tu servicio!";
	const SHAREDHASH = "TuxMarket";

	//Datos Empresa
	const DIRECCION = "Boulevard Belisario Domínguez, Km. 1081, Sin Número, Terán, Tuxtla Gutiérrez, Chiapas, México, 29050.";
	const TELEMPRESA = "+(961)8214300";
	const WHATSAPP = "+52 961 821 4300";
	const EMAIL_EMPRESA = "www.tuxmarket.shop";
	const EMAIL_PEDIDOS = "www.tuxmarket.shop"; 
	const EMAIL_SUSCRIPCION = "www.tuxmarket.shop";
	const EMAIL_CONTACTO = "www.tuxmarket.shop";

	const CAT_SLIDER = "1,2,3";
	const CAT_BANNER = "4,5,6";
	const CAT_FOOTER = "1,2,3,4,5";

	//Datos para Encriptar / Desencriptar
	const KEY = 'abelosh';
	const METHODENCRIPT = "AES-128-ECB";

	//Envío
	const COSTOENVIO = 5;

	//Módulos
	const MDASHBOARD = 1;
	const MUSUARIOS = 2;
	const MCLIENTES = 3;
	const MPRODUCTOS = 4;
	const MPEDIDOS = 5;
	const MCATEGORIAS = 6;
	const MSUSCRIPTORES = 7;
	const MDCONTACTOS = 8;
	const MDPAGINAS = 9;

	//Páginas
	const PINICIO = 1;
	const PTIENDA = 2;
	const PCARRITO = 3;
	const PNOSOTROS = 4;
	const PCONTACTO = 5;
	const PPREGUNTAS = 6;
	const PTERMINOS = 7;
	const PSUCURSALES = 8;
	const PERROR = 9;

	//Roles
	const RADMINISTRADOR = 1;
	const RSUPERVISOR = 2;
	const RCLIENTES = 3;

	const STATUS = array('Completo','Aprobado','Cancelado','Reembolsado','Pendiente','Entregado');

	//Productos por página
	const CANTPORDHOME = 8;
	const PROPORPAGINA = 4;
	const PROCATEGORIA = 4;
	const PROBUSCAR = 4;

	//REDES SOCIALES
	const FACEBOOK = "https://www.facebook.com/tuxmarket";
	const INSTAGRAM = "https://www.instagram.com/tuxmarket/";
	

 ?>