<?php 
   const GUARDAR = 'Guardar';
   const VER_DATOS = 'Ver datos';
   $datos = [];

   $ID = $_POST['ID'] ?? null;
   $producto = $_POST['producto'] ?? null;
   $precio = $_POST['precio'] ?? null;
   $categoria = $_POST['categoria'] ?? null;

   if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operacion'])){
      if($_POST['operacion'] === GUARDAR){
         $file = @fopen("archivo.txt", "a"); 
         fwrite($file, "$ID, $producto,$precio,$categoria".PHP_EOL);
         fclose($file);        
   } else {
     if(file_exists('archivo.txt')){
         $content = trim(file_get_contents('archivo.txt'), PHP_EOL);
         $lineas = explode(PHP_EOL, $content);
         foreach($lineas as $linea){
            list($ID, $productoE, $precioE, $categoriaE) = explode(',', $linea);
            $datos[] = ['ID' => $ID, 'producto' => $productoE, 'precio' => $precioE, 'categoria' => $categoriaE];
         }
     }
   }
   }
   //Cuerpo de la página
   $body = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agregar un Producto</title>
<style type="text/css">
</style>
</head>

<body bgcolor="#FFFFFF">
<H2> Agregar un Producto </H2>
<FORM method="post" name="formulario" autocomplete="off">
ID:<input type="text" name="ID" id="ID"><P>
Producto:<input type="text" name="producto" id="producto"><P>
Precio: <input type="text" name="precio" id="precio"><P>
Categoría: <input type="text" name="categoria" id="categoria">

<br /><br />
<input type="submit" value="'.GUARDAR.'" name="operacion">
<input type="submit" value="'.VER_DATOS.'" name="operacion">

</FORM>

';

   if(!empty($datos)){
      $body .= '
<br />
<table border="1">
<tr>
<th>ID</th>
<th>Producto</th>
<th>Precio</th>
<th>Categoría</th>
</tr>
';
foreach($datos as $elemento){
$body .= '
<tr>
<td>'.$elemento['ID'].'</td>
<td>'.$elemento['producto'].'</td>
<td>'.$elemento['precio'].'</td>
<td>'.$elemento['categoria'].'</td>
</tr>
';
}
$body .= '</table>';
}
$body .= '
</body>
</html>';

   //Renderizo el cuerpo de la página
   echo $body;
?>
<button onclick="window.close()">CERRAR</button>