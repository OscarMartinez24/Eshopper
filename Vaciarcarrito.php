<?php
   //Aqui se borra el Carrito de Compras
   if(file_exists('carritocompras.txt')) unlink("carritocompras.txt");
      echo "<CENTER><H2>EL Carrito de Compras se ha Vaciado</H2>";
      echo "</CENTER>";
      echo "<BR>";
   ?>
   <script>window.opener.location.reload;</script>
   <center>
   <a href="javascript:window.close();">Volver a la página anterior</a>
   </center>
?>