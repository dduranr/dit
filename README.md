<h1 align="center">INSTRUCCIONES</h1>
<h3 align="left">REQUERIMIENTOS</h3>
<ol>
  <li>Este proyecto está basado en una instalación Laravel 7. Por tanto, el servidor debe contar con los requerimientos definidos para dicha versión. Los cuales pueden encontrarse en <a href="https://laravel.com/docs/7.x/installation" target="_blank">https://laravel.com/docs/7.x/installation</a></li>
  <li>El servidor debe contar con una base de datos MySQL o MariaDB disponible</li>
  <li>El servidor debe tener instalado Git</li>
  <li>El servidor debe tener instalado Composer</li>
  <li>El servidor debe tener instalado Node.js (opcional)</li>
</ol>

<h3 align="left">DEPLOY</h3>
<p align="left">Deben seguirse estas instrucciones para hacer deploy de este proyecto en su máquina local:</p>
<ol>
  <li>Abrir la consola del sistema operativo (si es Windows, preferentemente abrir el Gitbash)</li>
  <li>Mediante la consola acceder a la carpeta donde se guarden los proyectos Laravel (preferentemente dentro de la carpeta "htdocs")</li>
  <li>Descargar el proyecto ejecutando: git clone https://github.com/dduranr/dit.git</li>
  <li>Accedemos a la carpeta del proyecto. El proyecto se llama <strong>dit</strong>, por lo que se debe ejecutar: cd dit</li>
  <li>
    Editar el archivo <strong>.env</strong> ubicado en la raíz del proyecto, y se modifican los siguientes valores según las especificaciones locales (es decir, las especificaciones de nuestro servidor y base de datos):
    <ol>
      <li><strong>APP_ENV</strong>=production</li>
      <li><strong>APP_DEBUG</strong>=false</li>
      <li><strong>APP_URL</strong>=http://localhost</li>
      <li><strong>DB_HOST</strong>=127.0.0.1</li>
      <li><strong>DB_PORT</strong>=3306</li>
      <li><strong>DB_DATABASE</strong>=dit</li>
      <li><strong>DB_USERNAME</strong>=root</li>
      <li><strong>DB_PASSWORD</strong>=</li>
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
  <li>Eso es todo.</li>
</ol>

<h3 align="left">AFTER DEPLOY</h3>
<ol>
  <li>Después del deploy, ejecutar: php artisan serve</li>
  <li>Con lo anterior se lanza el servidor para el proyecto Laravel y ahora se puede acceder desde el navegador según la URL mostrada por la consola después de ejecutar el comando anterior, que normalmente será: http://127.0.0.1:8000)</li>
  <li>Una vez abierto el proyecto en el navegador se podrá visualizar la lista de libros, los cuales sólo podrán editarse si se está logueado. Para esto deberán crear una cuenta usando el link <strong>Register</strong> ubicado en la parte superior derecha de la ventana del navegador.</li>
  <li>En cualquier caso, dejo las credenciales por defecto del único usuario creado:
    <ol>
      <li><strong>Email</strong>: official.dduran@gmail.com</li>
      <li><strong>Contraseña</strong>: abc123</li>
    </ol>
  </li>
</ol>
