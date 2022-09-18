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
        

Evalución:
        
Se agregaron comentarios al final de cada ejercicio para facilitar lo que realice...

1. Clonar el siguiete repositorio en su maquina:
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
            
    
2. Crear un servicio nuevo para poder obtener los productos por una determinada categoria.
    
    Ejemplo: 
    Nombre función: 	getProductos 
    Parámetros: 	idCategoria 
            
El párametro "idCategoria" debe ser opcional, en caso de no pasar el mismo, el servicio deberá devolver todos los productos.
            
---

## Resolucion: 
```
1.- Correr Docker ./vendor/bin/sail up
2.- Abrir postman -> get -> http://localhost:8080/api/v1/products/idCategory/2 
info: Para ver mas informacion se puede realizar  http://localhost:8080/api/v1/products/help
Controllers->Api->V1->ProductController.php
```
3.  Dada la tabla "catagorias", escribir una única consulta SQL para poder obtener las categorías y sub categorías hasta 3 niveles.
            
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

---

## Resolucion - Query - Categorias y Sub Categorias:
```
select c1.nombre as padre, c2.nombre as categoria_lvl1,c3.nombre as categoria_lvl2
from categories c1
left join categories c2 on c1.id = c2.idcategoriapadre
left join categories c3 on c2.id = c3.idcategoriapadre
where c1.idcategoriapadre is null;
```

4. Crear los scripts y configuraciones necesarias para dejar funcionando un backup automático diario de la base de datos. 

## Resolucion 
```
- Se creo un nuevo servicio en docker-composer.yml llamado schedule para que verifique los schedule de laravel y se ejecuten...
- En Console -> Commands -> Existe un comando llamado db:backup este se agrego en Kernel.php y se correra todos los dias a la medianoche segun la documentacion... aunque la zonahoraria esta configurada en UTC... https://laravel.com/docs/9.x/scheduling
- El comando es bastante simple como es un sqlite realizo un copy() a storage/app/backup ahi dentro estan los backup de la base de datos
(Esta capturado el error de copy() en caso que se necesite agregar una notificacion... como correo o guardarlo en un log...)
Console->Commands->DbBackup.php
```

5. Escribir un comando para consola ( https://laravel.com/docs/9.x/artisan#generating-commands) que reciba como parámetro el domino (.com.AR) y haga una consulta de datos de whois por medio el servicio de RDAP de nic.ar (https://rdap.nic.ar/domain/$DOMINIO') y  devuelva la fecha de vencimiento

## Resolucion
```
- Se creo un comando llamado domain:verify -> Este devuelve la fecha de vencimiento -> Y-m-d H:i:s
Console->Commands->VerifyDomain.php
```

6. Escribir un servicio WEB que reciba como parámetro el domino (.com) y haga una consulta de datos de whois por medio de socket (servidor : whois.donweb.com puerto: 43) y devuelva los Name Server
Caso que funciona para poder probar : andes3d.com

## Problema
Hace falta algun dato mas en el ejercicio 6?
```
    Realices simples pruebas con wscat
        $ wscat -c ws://whois.donweb.com:43
        error: Parse Error: Expected HTTP/
```
## Resolucion Temporal
Investigue sobre alguna API donde pueda conseguir el nameservers de un dominio y encontre esta https://whoisjsonapi.com/
Decidi implementar utilizando esta API para entregar algo por lo menos hasta que tenga mas informacion sobre el WS. 

Al ingresar un dominio te devuelve los nameservers

En env se agrego un token (TOKEN_WHOISJSONAPI) para poder utilizar la API de whoisjsonapi.com

```
    http://localhost:8080/api/v1/whois/andes3d.com
    Se puede realizar http://localhost:8080/api/v1/whois/help para obtener mas informacion sobre el metodo...
```
