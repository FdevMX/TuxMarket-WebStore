# TuxMarket WebStore

TuxMarket es una plataforma de comercio electrónico completa y moderna desarrollada con PHP. Este sistema permite gestionar productos, usuarios, ventas y más a través de una interfaz intuitiva y responsiva.

## 📋 Tabla de Contenidos
- [TuxMarket WebStore](#tuxmarket-webstore)
  - [📋 Tabla de Contenidos](#-tabla-de-contenidos)
  - [✨ Características](#-características)
  - [🖥️ Requisitos del Sistema](#️-requisitos-del-sistema)
  - [🚀 Instalación](#-instalación)
  - [📁 Estructura del Proyecto](#-estructura-del-proyecto)
  - [💾 Configuración de la Base de Datos](#-configuración-de-la-base-de-datos)
  - [🔧 Uso](#-uso)
    - [Panel de Administración](#panel-de-administración)
    - [Tienda en línea](#tienda-en-línea)
  - [📄 Licencia](#-licencia)
  - [🔍 Solución de problemas comunes](#-solución-de-problemas-comunes)
    - [Problema de permisos](#problema-de-permisos)
    - [URLs amigables no funcionan](#urls-amigables-no-funcionan)
    - [Problemas de conexión a la base de datos](#problemas-de-conexión-a-la-base-de-datos)

## ✨ Características
- **Panel de Administración**: Gestión completa de productos, categorías, usuarios y ventas
- **Tienda Online**: Catálogo de productos, carrito de compras, proceso de pago
- **Sistema de Usuarios**: Registro, inicio de sesión, recuperación de contraseña
- **Gestión de Roles**: Control de acceso basado en roles (Administrador, Empleado, Cliente)
- **Responsive Design**: Experiencia optimizada en dispositivos móviles y de escritorio


## 🖥️ Requisitos del Sistema
- PHP 7.4.33 o superior
- MySQL 5.7 o superior / MariaDB 10.4 o superior
- Servidor web (Apache, Nginx)
- Extensiones PHP requeridas:
    - PDO_MySQL
    - cURL
    - GD
    - mbstring
    - OpenSSL

## 🚀 Instalación
1. Clonar el repositorio
2. Configurar el servidor web
     - Para Apache, asegúrate de que el directorio apunte a la carpeta raíz del proyecto y que mod_rewrite esté habilitado.
3. Configurar la base de datos
     - Importa el archivo de la base de datos ubicado en `Database/db_tiendavirtual.sql`
     - Configura las credenciales de la base de datos en `Config.php`
4. Configurar permisos
5. Acceder al sistema
     - Frontend: `http://localhost/TuxMarket-WebStore/`
     - Admin: `http://localhost/TuxMarket-WebStore/admin`
     - Credenciales por defecto:
         - Email: `admin@tuxmarket.com`
         - Contraseña: `admin123`

## 📁 Estructura del Proyecto
```
TuxMarket-WebStore/
├── Assets/               # Recursos públicos (CSS, JS, imágenes)
│   ├── css/              # Estilos
│   ├── js/               # Scripts
│   └── images/           # Imágenes del sistema
├── Config/               # Archivos de configuración
├── Controllers/          # Controladores MVC
├── Database/             # Script SQL y migraciones
├── Helpers/              # Funciones auxiliares
├── Libraries/            # Librerías del sistema
├── Models/               # Modelos MVC
├── Views/                # Vistas MVC
│   ├── Dashboard/        # Vistas del panel admin
│   ├── Errors/           # Páginas de error
│   ├── Login/            # Vistas de autenticación
│   └── Template/         # Plantillas base
├── index.php             # Punto de entrada
└── .htaccess             # Configuración de Apache
```

## 💾 Configuración de la Base de Datos
1. Crea una base de datos MySQL/MariaDB con el nombre `db_tiendavirtual`
2. Importa el esquema de la base de datos
3. Modifica el archivo `Config.php` con tus credenciales

## 🔧 Uso

### Panel de Administración
El panel de administración permite:
- Gestión de productos y categorías
- Administración de usuarios y roles
- Visualización de pedidos y ventas
- Configuración del sistema

### Tienda en línea
Los clientes pueden:
- Explorar el catálogo de productos
- Añadir productos al carrito
- Realizar el proceso de compra
- Gestionar su perfil y pedidos

## 📄 Licencia

Este proyecto está bajo la Licencia GNU GPL v3 - ver el archivo [LICENSE](LICENSE) para más detalles.

La licencia GNU GPL garantiza que el software permanezca libre, permitiendo a los usuarios ejecutar, estudiar, compartir y modificar el software libremente.

## 🔍 Solución de problemas comunes

### Problema de permisos
Si experimentas problemas de permisos, asegúrate de que el servidor web tenga acceso de escritura a las carpetas `uploads` y `Logs/`.

### URLs amigables no funcionan
Verifica que mod_rewrite esté habilitado en Apache y que el archivo `.htaccess` esté configurado correctamente.

### Problemas de conexión a la base de datos
Comprueba las credenciales en `Config.php` y asegúrate de que el servidor MySQL/MariaDB esté funcionando.

---

Desarrollado con ❤️ por TuxMarket Team