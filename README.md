# Ahumados R y M - E-commerce de Embutidos y Carnes Selectas

Bienvenido al repositorio oficial del e-commerce **Ahumados R y M**, una tienda en línea moderna diseñada específicamente para la comercialización de embutidos, cortes de carne premium y packs artesanales.

Este proyecto ha sido desarrollado en **Laravel** con una arquitectura Modelo-Vista-Controlador (MVC), Blade Templates y Tailwind CSS, ofreciendo una experiencia altamente interactiva y visualmente premium.

---

## 🌟 Características Principales

### 🛒 Área Pública (Clientes)
* **Catálogo Dinámico:** Filtrado de productos por categorías (Carnes Selectas, Embutidos, Packs).
* **Carrito de Compras Persistente:** Gestión del carrito en la sesión del usuario para optimizar el rendimiento.
* **Proceso de Checkout Elegante:**
  - Registro de datos de envío (Dirección, Teléfono, Ciudad).
  - Selección de método de pago interactivo (Pago Contra Entrega o Pago por Yape).
  - Carga de voucher de pago (Captura de pantalla) cuando se realiza la compra por Yape.
* **Libro de Reclamaciones Virtual:** Formulario interactivo que cumple con las directivas de **INDECOPI** (Perú) para e-commerce, con asignación automática de códigos de seguimiento.

### 👑 Área Privativa (Administración)
* **Dashboard Estadístico:** Visualización interactiva de ventas totales en Soles (`S/.`), cantidad de pedidos realizados, alertas automáticas de bajo stock en tiempo real y listado de pedidos recientes.
* **CRUD Completo de Productos:** Interfaz para crear, leer, actualizar y eliminar productos del catálogo.
* **Gestión de Reclamos:** Bandeja de entrada para revisar e interactuar con los reclamos de los clientes, permitiendo marcarlos como resueltos.
* **Configuración del QR de Yape:** Panel para que el administrador actualice dinámicamente el código QR de cobro, número telefónico y titular de Yape que verán los clientes en la tienda.

---

## ⚙️ Requisitos de Instalación (Local XAMPP)

1. Instalar **XAMPP** (con PHP 8.2 o superior) y **Composer**.
2. Clonar este proyecto en tu directorio web (ej: `C:\xampp\htdocs\mi-app`).
3. En el panel de control de XAMPP, asegúrate de habilitar las siguientes extensiones en `php.ini`:
   ```ini
   extension=curl
   extension=fileinfo
   extension=gd
   extension=mbstring
   extension=openssl
   extension=pdo_mysql
   extension=zip
   extension_dir = "C:\xampp\php\ext"
   ```
4. Instala las dependencias del proyecto:
   ```bash
   composer install
   ```
5. Duplica tu archivo `.env.example` a `.env` y configura tu base de datos de MySQL:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mi_app_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
6. Genera tu clave criptográfica del proyecto:
   ```bash
   php artisan key:generate
   ```
7. Crea una base de datos vacía llamada `mi_app_db` en tu phpMyAdmin y corre las migraciones con sus datos base:
   ```bash
   php artisan migrate --seed
   ```
8. Enlaza el almacenamiento local para visualizar las imágenes subidas por el administrador:
   ```bash
   php artisan storage:link
   ```
9. Enciende tu servidor local apuntando directamente al binario PHP de tu XAMPP:
   ```bash
   C:\xampp\php\php.exe artisan serve
   ```
10. Abre en tu navegador la dirección: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📂 Estructura General del Código

* **`routes/web.php`:** Define el ruteo de la tienda y la protección del panel administrativo mediante Middlewares agrupados.
* **`app/Http/Controllers/`:**
  - `CartController.php`: Lógica del carrito de compras.
  - `OrderController.php`: Gestión de checkout y órdenes.
  - `ClaimController.php`: Registro de libro de reclamaciones.
* **`app/Http/Controllers/Admin/`:**
  - `AdminProductController.php`: CRUD de productos con subida de imágenes.
  - `AdminClaimController.php`: Gestión e historial de reclamaciones de los usuarios.
* **`resources/views/`:** Vistas estructuradas en plantillas Blade reutilizables y layouts adaptables.
* **`database/migrations/`:** Historial de creación de base de datos para fácil despliegue.

---

## 📖 Material de Exposición y Soporte Didáctico

Para acceder al material explicativo paso a paso, análisis de arquitectura, explicación técnica detallada del MVC y preguntas frecuentes con sus respuestas para tu sustentación académica, consulta el documento explicativo de soporte ubicado en:

📂 **[app_documentation.md](file:///C:/Users/LENOVO/.gemini/antigravity/brain/afe25d13-bb21-4229-b26d-2930c94abc5c/app_documentation.md)** (Ubicado en el directorio de la conversación).

---

*Proyecto diseñado con fines educativos y de demostración técnica avanzada para e-commerce.*
