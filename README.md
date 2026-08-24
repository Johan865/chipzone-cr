# ChipZone CR - Tienda Virtual

## Descripción del Proyecto
ChipZone CR es una tienda virtual de electrónica desarrollada como Proyecto Final para el curso **Tecnologías y Sistemas Web II (ITI-523)**. 
El sistema permite a los usuarios registrarse, navegar por un catálogo de productos categorizados, agregar artículos a un carrito de compras y realizar un proceso de "checkout" seguro. 

## Funcionalidades Principales
- **Autenticación y Gestión de Usuarios:** Registro, inicio de sesión seguro, perfil de usuario e historial de pedidos.
- **Catálogo de Productos:** Filtrado por categorías y búsqueda por nombre, con vistas detalladas de cada producto.
- **Carrito de Compras:** Gestión completa (agregar, actualizar cantidades, eliminar) y cálculo automático del subtotal, IVA (13%) y costos de envío.
- **Proceso de Compra (Checkout):** Integración de opciones de pago, generación de número de seguimiento, factura detallada y uso de sesiones seguras.
- **Experiencia de Usuario:** Uso de cookies para mostrar "Productos vistos recientemente". Diseño completamente responsivo (Bootstrap).
- **Reportes (Admin):** Generación de reportes de ventas mensuales y por cliente exportables a formato PDF.
- **Seguridad:** Protección contra inyecciones SQL y XSS, manejo seguro de contraseñas.

## Tecnologías Utilizadas
- **Backend:** PHP (Framework Laravel 11/12)
- **Base de Datos:** SQLite
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5
- **Servidor Web:** Optimizado para Apache/PHP artisan serve

## Instrucciones de Uso (Entorno de Desarrollo)
1. **Requisitos previos:** Instalar PHP >= 8.2 y Composer.
2. **Clonar repositorio:**
   \\\ash
   git clone https://github.com/Johan865/chipzone-cr.git
   cd chipzone-cr
   \\\
3. **Instalar dependencias:**
   \\\ash
   composer install
   \\\
4. **Configuración de entorno:**
   Copiar el archivo .env.example a .env y generar la llave de la aplicación:
   \\\ash
   cp .env.example .env
   php artisan key:generate
   \\\
5. **Base de datos (SQLite):**
   Asegurarse de que el archivo database/database.sqlite exista. Luego, ejecutar migraciones y seeders para poblar el catálogo de prueba:
   \\\ash
   php artisan migrate --seed
   \\\
6. **Ejecutar el servidor local:**
   \\\ash
   php artisan serve
   \\\
   Visita http://127.0.0.1:8000 en tu navegador.

## Diagrama de Caso de Uso (Proceso de Compra)

\\\mermaid
usecaseDiagram
    actor Cliente as "Cliente Autenticado"
    actor Sistema as "Sistema / Pasarela"

    package "Proceso de Compra (Checkout)" {
        usecase UC1 as "Ver Carrito de Compras"
        usecase UC2 as "Ingresar Dirección de Envío"
        usecase UC3 as "Seleccionar Método de Pago"
        usecase UC4 as "Validar Información"
        usecase UC5 as "Procesar Pago"
        usecase UC6 as "Generar Confirmación y Factura"
    }

    Cliente --> UC1
    Cliente --> UC2
    Cliente --> UC3
    UC3 .> UC4 : include
    UC4 --> Sistema : Solicitar validación
    Sistema --> UC5 : Aprobar pago
    UC5 .> UC6 : include
    UC6 --> Cliente : Mostrar recibo y tracking
\\\

