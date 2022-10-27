Objetivo:
    El objetivo de la evaluación es probar los conocimientos en PHP en un entorno POO bajo algún framework conocido, 
    modelo MVC y SQLite.

FrameWork utilizado: Laravel 9 + Laravel Sail (entorno dokerizado)


Herramientas necesarias:
        + Conexión a Internet
        + GIT
        + Docker  
        + Browser
        + IDE 
        + Cliente para api REST o en su defecto curl.

Repositorio:
La rama main está protegida. Para que podamos evaluar tu codigo tenes que 
crear una nueva rama con tu nombre, hacer push a origin y generar un Pull Request

Evalución:
            
        1) Clonar el siguiete repositorio en su maquina:
            - Dentro del directorio raíz del proyecto

                - Renombrar el archivo database/database.txt a database/database.sqlite

                - Renombrar archivo .env.example a .env
            
                - Ejecutar composer install

                - Si tiene Docker correctamente instalado debería arrancar el proyecto entrando al directorio raíz y ejecutando el siguiente comando:
            
                    ./vendor/bin/sail up

                Más info en (https://laravel.com/docs/9.x/sail)
            
                Ya tenemos una api configurada que devuelve todas las categorías, puede probrarlo con la siguente info:
        
                METHOD: GET
                ACTION: http://localhost:8080/api/v1/categories

                IMPORTANTE: Para correr los comandos de artisan o php en consola debe reemplazar la palabra 'php' por 'sail'. 
            
                Ej: sail artisan route:list
            
    
        2)  Crear un servicio nuevo para poder obtener los productos por una determinada categoria.
            Ejemplo: 
    	    Nombre función: 	getProductos 
            Parámetros: 	idCategoria 
            
            El párametro "idCategoria" debe ser opcional, en caso de no pasar el mismo, el servicio deberá
            devolver todos los productos.
            
        
        3)  Dada la tabla "catagorias", escribir una única consulta SQL para poder obtener las categorías y sub categorías hasta 3 niveles.
            
            Resultado esperado de la consulta.
            
            Categorías:
            ========================
            Indumentaria -> Adidas
            Indumentaria -> Nike
            Calzado -> Calzado Dita
            Calzado -> Calzado Nike
            Calzado -> Calzado Adidas
            Calzado -> Running -> Adidas
            Calzado -> Running -> Puma 


        4) Crear los scripts y configuraciones necesarias para dejar funcionando un backup automático diario de la base de datos. 

        5) Escribir un comando para consola ( https://laravel.com/docs/9.x/artisan#generating-commands) que reciba como parámetro el domino (.com.AR) y haga una consulta de datos de whois por medio el servicio de RDAP de nic.ar (https://rdap.nic.ar/domain/$DOMINIO') y  devuelva la fecha de vencimiento

        6) Escribir un servicio WEB que reciba como parámetro el domino (.com) y haga una consulta de datos de whois por medio de socket (servidor : whois.donweb.com puerto: 43) y devuelva los Name Server

        Caso que funciona para poder probar : andes3d.com
