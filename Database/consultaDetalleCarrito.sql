select usuarios.id as UserID, usuarios.user as Cliente, productos.id ProductID, productos.nombre as NombreProducto, productos.precio, categorias.nombre_cat as Categoria, carrito.cantidad 
from carrito, usuarios, productos, categorias 
where carrito.id_user = usuarios.id 
and carrito.id_producto = productos.id