# Demo_Gallery
Para poder usar este proyecto lo que debes de hacer es siguiente:

1-	Si cuando clonas el proyecto al te crea el directorio del proyecto asi Demo_Gallery-master entonces renombralo a Demo_Gallery para que tenga una buena ejecucion

2-	Copiar el folder Demo_Gallery a tu servidor web.

3-	Dentro del directorio Demo_Gallery/DB ubicado adentro de este proyecto se encuentra la 		base de datoses un script sql lo puedes ejeutar desde el workbench o bien puede hacerlo desde 		phpmyadmin eso es opcional.

4-	Dentro del directorio Demo_Gallery/includes/config/ se encuentra el archivo db.php aqui ponemos los datos del server como el host, db, user y pass con estos datos nos podremos conectar al servidor

5-	Desde tu navegador pon la ruta del proyecto para empezar a usarlop p.e localhost/Demo_Gallery

6-	Para poder ingresar al sistema podremos usar un nombre de usuario o un email.
	Los valores por defecto del sistema son: 
	*user: admin
	*email:email@email.com
	*pass admin
	
Nota: Las imagenes que vayamos a subir se guardaran en el directorio Demo_Gallery/images/gallery/

Ojo el tamaño de las imagenes que subira dependera de la configuracion de tu php.ini para cambiar eso tiene que editar el php.ini y buscar las siguientes lineas, el tamaño nuevo dependera de tus necesidades

upload_max_filesize=2M
max_file_uploads=20
post_max_size = 8M 

max_execution_time = 30
memory_limit = 64M 