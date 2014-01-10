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

!(captura2)(https://dl.dropbox.com/s/47nusk7e0w36mmr/scp.png)

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

!(captura3)(https://dl.dropbox.com/s/nj3e1d4kz7bd15m/periodico.png)

Configuraciones de maquinas virtuales
-------------------------------------

Ya esta lista la maquina virtual base, es decir, ya podemos hacer copias de esta maquina virtual cambiando especificaciónes y de esta forma estudiar como se comporta mejor o peor. Realizaremos 5 maquinas virtuales:

- 1º Configuración

	Sistema Operativo: Ubuntu server 12.04
	Kernel: Linux 3.2.0-29-generic-pae i686 
	Procesador: 1 nucleo
	RAM: 256MB

- 2º Configuración
	
  Sistema Operativo: Ubuntu server 12.04
	Kernel: Linux 3.2.0-29-generic-pae i686 
	Procesador: 1 nucleo
	RAM: 1024MB

- 3º Configuración

	Sistema Operativo: Ubuntu server 12.04
	Kernel: Linux 3.2.0-29-generic-pae i686 
	Procesador: 1 nucleo
	RAM: 2048MB

- 4º Configuración

	Sistema Operativo: Ubuntu server 12.04
	Kernel: Linux 3.2.0-29-generic-pae i686 
	Procesador: 2 nucleo
	RAM: 1024MB

- 5º Configuración

	Sistema Operativo: Ubuntu server 12.04
	Kernel: Linux 3.2.0-29-generic-pae i686 
	Procesador: 2 nucleo
	RAM: 2048MB
