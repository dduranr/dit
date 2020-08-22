<h1 align="center">INSTRUCCIONES</h1>
<h3 align="left">Requerimientos</h3>
<ol>
  <li>Este proyecto está basado en una instalación Laravel 7. Por tanto, el servidor debe contar con los requerimientos definidos para esta versión de Laravel. Los cuales pueden encontrarse én <a href="https://laravel.com/docs/7.x/installation" target="_blank">https://laravel.com/docs/7.x/installation</a></li>
  <li>Crear una base de datos MySQL o MariaDB</li>
  <li>El servidor debe tener instalado Git</li>
  <li>El servidor debe tener instalado Composer</li>
  <li>El servidor debe tener instalado Node.js (opcional)</li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
</ol>

<h3 align="center">DEPLOY</h3>
<p align="left">Deben seguirse estas instrucciones para hacer deploy de este proyecto en su máquina local:</p>
<ol>
  <li>Abrir la consola del sistema operativo (si es Windows, preferentemente abrir el Gitbash)</li>
  <li>Mediante la consola acceder a la carpeta donde se guarden los proyectos Laravel (preferentemente dentro de la carpeta "htdocs")</li>
  <li>Descargar el proyecto ejecutando: git clone https://github.com/dduranr/dit.git</li>
  <li>Accedemos a la carpeta del proyecto ejecutando: cd dit</li>
  <li>
    Editar el archivo .env ubicado en la raíz del proyecto, y se modificar los siguientes valores según las especificaciones locales (de nuestro servidor y base de datos):
    <ol>
      <li>APP_ENV=production</li>
      <li>APP_DEBUG=false</li>
      <li>APP_URL=http://localhost</li>
      <li>DB_HOST=127.0.0.1</li>
      <li>DB_PORT=3306</li>
      <li>DB_DATABASE=dit</li>
      <li>DB_USERNAME=root</li>
      <li>DB_PASSWORD=</li>
    </ol>
  </li>
  <li>Instalar dependencias (son las que van a parar a la carpeta "vendor"), ejecutando: php composer install --optimize-autoloader --no-dev</li>
  <li>Generar key de la app ejecutando: php artisan key:generate</li>
  <li>Ejecutar: php composer dumpautoload</li>
  <li>
    Ejecutar migraciones:
    <ol>
      <li>Migrar base de datos: php artisan migrate</li>
      <li>Sólo después de hacer las pruebas con la app, editando, borrando los libros, para regresar la base de datos tal como estaba desde un principio, ejecutar: php artisan migrate:refresh --seed</li>
    </ol>
  </li>
  <li>
    Limpiar caché:
    <ol>
      <li>php artisan optimize:clear</li>
      <li>php artisan view:clear</li>
      <li>php artisan route:clear</li>
      <li>php artisan clear-compiled</li>
      <li>php artisan auth:clear-resets</li>
      <li>php artisan cache:clear</li>
      <li>php artisan config:clear</li>
      <li>php artisan event:clear</li>
      <li>php artisan queue:flush</li>
    </ol>
  </li>
</ol>
