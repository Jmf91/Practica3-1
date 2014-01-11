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

Esta es la tabla con los resultados:
<table cellspacing="0" cellpadding="0">
  <col width="99" />
  <col width="140" />
  <col width="65" span="3" />
  <col width="65" />
  <col width="65" />
  <tr>
    <td colspan="2" width="239">1º configuracion 256MB</td>
    <td width="65"></td>
    <td width="65"></td>
    <td width="65"></td>
    <td width="65"></td>
    <td width="65"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Prueba 1</td>
    <td>Prueba 2</td>
    <td>Prueba 3</td>
    <td>MEDIA</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>Tiempo de Respuesta</td>
    <td align="right">7,852</td>
    <td align="right">9,261</td>
    <td align="right">3,409</td>
    <td align="right">6,840666667</td>
    <td>seg</td>
  </tr>
  <tr>
    <td></td>
    <td>Velocidad de Transferencia</td>
    <td align="right">958,52</td>
    <td align="right">814,35</td>
    <td align="right">2216,92</td>
    <td align="right">1329,93</td>
    <td>Kbytes/sec</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2">2º   configuracion 1024MB</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Prueba 1</td>
    <td>Prueba 2</td>
    <td>Prueba 3</td>
    <td>MEDIA</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>Tiempo de Respuesta</td>
    <td align="right">5,81</td>
    <td align="right">3,435</td>
    <td align="right">3,443</td>
    <td align="right">4,229333333</td>
    <td>seg</td>
  </tr>
  <tr>
    <td></td>
    <td>Velocidad de Transferencia</td>
    <td align="right">1298,07</td>
    <td align="right">2199,67</td>
    <td align="right">2193,1</td>
    <td align="right">1896,946667</td>
    <td>Kbytes/sec</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2">3º   configuracion 1 nucleos 2048MB</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Prueba 1</td>
    <td>Prueba 2</td>
    <td>Prueba 3</td>
    <td>MEDIA</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>Tiempo de Respuesta</td>
    <td align="right">5,506</td>
    <td align="right">3,435</td>
    <td align="right">3,398</td>
    <td align="right">4,113</td>
    <td>seg</td>
  </tr>
  <tr>
    <td></td>
    <td>Velocidad de Transferencia</td>
    <td align="right">1554,24</td>
    <td align="right">2195,31</td>
    <td align="right">2219,12</td>
    <td align="right">1989,556667</td>
    <td>Kbytes/sec</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2">4º   configuracion 2 nucleos 1024MB</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Prueba 1</td>
    <td>Prueba 2</td>
    <td>Prueba 3</td>
    <td>MEDIA</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>Tiempo de Respuesta</td>
    <td align="right">2,109</td>
    <td align="right">2,08</td>
    <td align="right">4,799</td>
    <td align="right">2,996</td>
    <td>seg</td>
  </tr>
  <tr>
    <td></td>
    <td>Velocidad de Transferencia</td>
    <td align="right">3576,6</td>
    <td align="right">3625,99</td>
    <td align="right">1573,12</td>
    <td align="right">2925,236667</td>
    <td>Kbytes/sec</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2">5º   configuracion 2 nucleos 2048MB</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Prueba 1</td>
    <td>Prueba 2</td>
    <td>Prueba 3</td>
    <td>MEDIA</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>Tiempo de Respuesta</td>
    <td align="right">1,938</td>
    <td align="right">2,045</td>
    <td align="right">2,115</td>
    <td align="right">2,032666667</td>
    <td>seg</td>
  </tr>
  <tr>
    <td></td>
    <td>Velocidad de Transferencia</td>
    <td align="right">3892,36</td>
    <td align="right">3687,7</td>
    <td align="right">3531,1</td>
    <td align="right">3703,72</td>
    <td>Kbytes/sec</td>
  </tr>
</table>

Gráfica  de Tiempo de Respuesta:

![captura4](https://dl.dropbox.com/s/w6ne9emnchsigho/grafica_tiempos.png)

Gráfica  de Velocidad de Transferencia:

Conclusiones
------------

Observando los resultados y las gráficas nos declinamos por la configuración 4 ya esta por debajo del umbral en la gráfica de tiempo de respuesta y por encima en el umbral de la gráfica de velocidad de transferencia. Y a pesar de que la configuración 5 también lo esta, no es una buena elección ya que es una maquina muy potente para las acciones que va a realizar y no se aprecia gran mejoría con respecto a la configuración 4.

