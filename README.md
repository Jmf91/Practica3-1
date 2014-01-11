Practica3
=========

Introducción
------------
Creamos una maquina virtual en vmware con el sistema operativo Ubuntu Server 12.04. Trabajaremos en primer lugar con esta maquina y después le realizaremos cambios (actualizando kernel, ram, procesador, etc).

La intención es el elegir el servidor que funcione de forma optima de forma que no se vea ni demasiado relajado ni con demasiado trabajo. Usando el mismo ejemplo que en la practica 1 y 2 montaremos una plataforma web con un periódico en php con consultas de noticias a una base de datos mySQL.

Maquina Virtual
---------------
Usaremos vmware para controlar las maquinas virtuales. Instalamos Ubuntu Server 12.04 con la configuración por defecto, sin instalar motor grafico ya que no lo necesitamos para la actividad que va a realizar el servidor y cuanto menos procesos procese la maquina virtuales mejores resultados nos dará el benchmark.

Entre los paquetes adicionales que instalamos a la maquina virtual señalamos: `apache`, `phpmyadmin`, `unzip` y `ssh`.

- Base de datos

Para que nos funcione phpmyadmin debemos realizar los dos siguientes comandos:
![captura1](https://dl.dropbox.com/s/2g3nyxngt8rtsq3/conf_phpmyadmin.png)

Con eso ya podremos acceder al panel de control de phpmyadmin entrando en la direccion http://192.168.45.128/phpmyadmin e importar las tablas de la base de datos que usa el periodico.

- Copia de los archivos a la maquina virtual

Usaremos scp para copiar los archivos (html, xls, css, php, inc) de la aplicación web en la maquina virtual. Lo copiamos como comprimido por comodida de realizar una unica transferencia tal como muestra la imagen:

![captura2](https://dl.dropbox.com/s/47nusk7e0w36mmr/scp.png)

Descomprimimos:

<pre>
unzip periodico2.zip
</pre>

Copiamos la carpeta descomprimida en /var/www/ que es donde cuelgan las paginas webs dentro de apache. Importante realizarlo como superusuario.

<pre>
sudo cp -r periodico /var/www
</pre>

- Prueba de funcionamiento

Ahora si accedemos a la dirección de nuestra maquina virtual desde el navegador de nuestra maquina local podemos observar que ya tenemos montada nuestra web del periódico

![captura3](https://dl.dropbox.com/s/nj3e1d4kz7bd15m/periodico.png)

Configuraciones de maquinas virtuales
-------------------------------------

Ya esta lista la maquina virtual base, es decir, ya podemos hacer copias de esta maquina virtual cambiando especificaciónes y de esta forma estudiar como se comporta mejor o peor. Realizaremos 5 maquinas virtuales:
<dl>
<dt>- 1º Configuración</dt>
<dd>Sistema Operativo: Ubuntu server 12.04</dd>
<dd>Kernel: Linux 3.2.0-29-generic-pae i686</dd> 
<dd>Procesador: 1 nucleo</dd>
<dd>RAM: 256MB</dd>
<dl>
<dt>- 2º Configuración</dt>
<dd>Sistema Operativo: Ubuntu server 12.04</dd>
<dd>Kernel: Linux 3.2.0-29-generic-pae i686</dd> 
<dd>Procesador: 1 nucleo</dd>
<dd>RAM: 1024MB</dd>
</dl>
<dl>
<dt>- 3º Configuración</dt>
<dd>Sistema Operativo: Ubuntu server 12.04</dd>
<dd>Kernel: Linux 3.2.0-29-generic-pae i686</dd> 
<dd>Procesador: 1 nucleo</dd>
<dd>RAM: 2048MB</dd>
</dl>
<dl>
<dt>- 4º Configuración</dt>
<dd>Sistema Operativo: Ubuntu server 12.04</dd>
<dd>Kernel: Linux 3.2.0-29-generic-pae i686</dd> 
<dd>Procesador: 2 nucleo</dd>
<dd>RAM: 1024MB</dd>
</dl>
<dl>
<dt>- 5º Configuración</dt>
<dd>Sistema Operativo: Ubuntu server 12.04</dd>
<dd>Kernel: Linux 3.2.0-29-generic-pae i686 </dd>
<dd>Procesador: 2 nucleo</dd>
<dd>RAM: 2048MB</dd>
</dl>

Benchmark
---------
La utilidad “ab” (Apache Benchmark) sirve para hacer pruebas de carga a un servidor apache.
Por ejemplo 500 consultas, con una concurrencia de 50 usuarios a la vez.
<pre>
ab -n500 -c50 http://192.168.45.128/periodicoII/
</pre>

Lo más relevante del resultado que se obtiene es lo siguiente:

- Requests per second: peticiones atendidas por segundo durante la prueba.
- Time per request (mean): tiempo miedo que el servidor ha tardado en atender a un grupo de peticiones concurrentes.
- Time per request (mean, across all concurrent requests): tiempo medio que el servidor ha tardado en atender una petición individual.

Analizar Resultados
-------------------

Vamos a marcar un umbral que nos indica que si los resultados están por encima es que el servidor no es recomendable ya que se pasara mucho tiempo para servir las peticiones y el trabajo se vera relentizado.

Para que los resultados sean fiables realizaremos tres benchmark por cada configuración y le aplicaremos la media, ese será el valor que se le otorgará a cada maquina virtual. Mediremos el tiempo de respuesta y la velocidad de transferencia obteniendo dos graficas con resultados.

