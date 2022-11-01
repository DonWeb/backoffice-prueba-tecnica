-- Resuelto en MySQL
    SELECT CASE WHEN hijo2.nombre IS NOT NULL 
		   THEN CONCAT(padre.nombre, "->", hijo.nombre,"->" ,hijo2.nombre)
		   ELSE CONCAT(padre.nombre, "->", hijo.nombre)
		END AS Categorias FROM 
	(SELECT id, nombre, idcategoriapadre FROM categories WHERE idcategoriapadre IS NULL) padre
    INNER JOIN (
		SELECT id, nombre, idcategoriapadre FROM categories WHERE idcategoriapadre IS NOT NULL
    ) hijo ON hijo.idcategoriapadre = padre.id
    LEFT JOIN (
		SELECT id, nombre, idcategoriapadre FROM categories WHERE idcategoriapadre IS NOT NULL
    ) hijo2 ON hijo2.idcategoriapadre = hijo.id;
    
-- Resuelto en SQLITE
      SELECT CASE WHEN hijo2.nombre IS NOT NULL 
		   THEN padre.nombre|| '->' || hijo.nombre || '->' || hijo2.nombre
		   ELSE padre.nombre|| '->' || hijo.nombre 
		END AS Categorias FROM 
	(SELECT id, nombre, idcategoriapadre FROM categories WHERE idcategoriapadre IS NULL) padre
    INNER JOIN (
		SELECT id, nombre, idcategoriapadre FROM categories WHERE idcategoriapadre IS NOT NULL
    ) hijo ON hijo.idcategoriapadre = padre.id
    LEFT JOIN (
		SELECT id, nombre, idcategoriapadre FROM categories WHERE idcategoriapadre IS NOT NULL
    ) hijo2 ON hijo2.idcategoriapadre = hijo.id;