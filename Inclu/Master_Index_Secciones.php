<?php

	if ($_SESSION['Nivel'] == 'XBPadmin') {	
		
		print("

<div style='clear:both'></div>
		
<div class='MenuVertical'>

 <!-- Comienza ul global -->
 		
<ul id='MenuBar1' class='MenuBarVertical'>

  <li class='MenuBarItemSubmenu'>
  <a href='#'>ADMINISTRACI&Oacute;N SISTEMA</a>
  <ul>
 
<!-- MENU ADMINISTRADORES -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTION ADMINISTRADORES</a>
    <ul>

      <li><a href='../Admin/Admin_Ver.php'>CONSULTAR</a></li>  
      <li><a href='../Admin/Admin_Crear.php'>CREAR</a></li> 
      <li><a href='../Admin/Admin_Modificar_01.php'>MODIFICAR</a></li>
      <li><a href='../Admin/Admin_Borrar_01.php'>BORRAR</a></li>
      <li><a href='../Admin/Admin_Modificar_img.php'>MODIFICA IMG</a></li>

      </ul>
    </li>

<!-- Fin MENU ADMINISTRADORES-->
 
<!-- MENU ADMINISTRACION DEL CV -->

  <li><a href='#' class='MenuBarItemSubmenu'>ADMINISTRACI&Oacute;N DEL CV</a>
    <ul>

	<li><a href='../Admin/CV_Ver.php'>CV VER</a></li>  
	<li><a href='../Admin/CV_Crear.php'>CREAR ENTRADA</a></li> 
	<li><a href='../Admin/CV_Modificar_01.php'>MODIFICAR</a></li>
	<li><a href='../Admin/CV_Borrar_01.php'>BORRAR</a></li>

    </ul>
  </li>

<!-- Fin MENU ADMINISTRACION DEL CV -->
	
<!-- MENU SECTORES -->

  <li><a href='#' class='MenuBarItemSubmenu'>SECTORES</a>
    <ul>

	<li><a href='Secciones_Ver.php'>CONSULTAR</a></li>  
	<li><a href='Secciones_Crear.php'>CREAR SECTORES</a></li> 
	<li><a href='Secciones_Modificar_01.php'>MODIFICAR</a></li>
	<li><a href='Secciones_Borrar_01.php'>BORRAR</a></li>

      </ul>
    </li>

<!-- Fin MENU SECTORES-->
 
<!-- Inicio MODALIDAD -->

  <li><a href='#' class='MenuBarItemSubmenu'>MODALIDAD</a>
    <ul>
    
    <li><a href='../modalidad/Modalidad_Ver.php'>CONSULTAR</a></li>
    <li><a href='../modalidad/Modalidad_Crear.php'>CREAR MODALIDAD</a></li>
    <li><a href='../modalidad/Modalidad_Modificar_01.php'>MODIFICAR</a></li>
    <li><a href='../modalidad/Modalidad_Borrar_01.php'>BORRAR</a></li>

      </ul>
    </li>
	
<!-- Fin MODALIDAD -->

<!-- Inicio CV URL -->

    <li><a href='../Admin/cvurl_Crear.php'>CREAR MODIFICAR CV PDF URL</a></li>
	
<!-- Fin CV URL -->

<!-- Inicio BBDD -->

  <li><a href='../upbbdd/bbdd.php'>RESPALDO TABLAS BBDD</a></li>
	
<!-- Fin BBDD -->

 <!-- Inicio NOTIFICACIONES -->

  <li><a href='#' class='MenuBarItemSubmenu'>NOTIFICACIONES</a>
    <ul>
		<li>
		<a href='../Mail_Php/index.php' target='_blank'>
		NOTIFICAR UN ERROR
		</a>
		</li>
 		<li>
		<a href='../Mail_Php/index.php' target='_blank'>
		AGRADECIMIENTOS
		</a>
		</li>
     </ul>
    </li>
	
<!-- Fin NOTIFICACIONES -->

 	</ul>
  </li>
  
  <!-- FIN MENU ADMINISTRADORES -->

  	<li style='text-align:left'>
					<form name='cerrar' action='../Admin/Admin_Access.php' method='post'>	
											<input type='submit' value='CERRAR SESION' />
											<input type='hidden' name='cerrar' value=1 />
					</form>	
	</li>
	
</ul>
 	<!-- FIN UL GLOBAL -->
 

<script type='text/javascript'>
<!--
var MenuBar1 = new Spry.Widget.MenuBar('MenuBar1', {imgRight:'MenuVerticalTutor/SpryMenuBarRightHover.gif'});
//-->
</script>

</div>

	");

	} 
	
?>