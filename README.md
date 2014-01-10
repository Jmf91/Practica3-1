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
