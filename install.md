# Guía de instalación (Entorno local con XAMPP)

## Requisitos previos

-   Tener instalado [XAMPP](https://www.apachefriends.org/index.html) en tu equipo.

---

## Pasos de instalación

### Paso 1: Descargar el proyecto

Accede al siguiente repositorio:

[https://github.com/SantosAlexis/landing](https://github.com/SantosAlexis/landing)

Haz clic en el botón verde **Code** y selecciona **Download ZIP**.

---

### Paso 2: Extraer el proyecto

-   Extrae el archivo `.zip` descargado.
-   Renombra la carpeta `landing-main` a `landing`.

---

### Paso 3: Mover el proyecto a la carpeta de XAMPP

-   Ve a la ruta: `C:\xampp\htdocs`
-   Copia la carpeta `landing` dentro de esa ruta.

---

### Paso 4: Iniciar servicios

Abre el **Panel de Control de XAMPP** y asegúrate de iniciar los siguientes servicios:

-   Apache
-   MySQL

---

### Paso 5: Configurar la base de datos

1. Abre [phpMyAdmin](http://localhost/phpmyadmin) desde tu navegador.
2. Crea una nueva base de datos con el nombre: `estacion_m`.
3. Ve a la pestaña **Importar**.
4. Selecciona el archivo `.sql` ubicado en la carpeta `landing/database` y haz clic en **Continuar**.

---

### Paso 6: Visualizar el proyecto

Abre tu navegador y visita:

[http://localhost/landing](http://localhost/landing)

---

¡Listo! Ahora deberías poder ver la landing page funcionando en tu entorno local.
