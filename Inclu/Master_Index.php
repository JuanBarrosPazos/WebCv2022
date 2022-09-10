<?php

    global $RutaAdmin; 
    $RutaAdmin = "../Admin/";
    global $RutaSecciones;
    $RutaSecciones = "../secciones/";
    global $RutaUpBbdd;
    $RutaUpBbdd = "../upbbdd/";  
    global $RutaMail;
    $RutaMail = "../Mail_Php/";

    if( $RutaDir == "Admin"){ global $RutaAdmin; 
                              $RutaAdmin = "";
                                            } 
    elseif( $RutaDir == "Secciones"){ global $RutaSecciones;
                                      $RutaSecciones = "";
                                            }
    elseif( $RutaDir == "Upbbdd"){ global $RutaUpBbdd;
                                   $RutaUpBbdd = "";
                                            } else { }

	if ($_SESSION['Nivel'] == 'XBPadmin') {	
		
	print("<div style='clear:both'></div>
                    
            <div class='MenuVertical'>

            <!-- COMIENZA UL GLOBAL -->
            <ul id='MenuBar1' class='MenuBarVertical'>

                <li class='MenuBarItemSubmenu'>
                    <a href='#'>ADMINISTRACI&Oacute;N SISTEMA</a>
            
            <!-- COMIENZA SUBMENU -->
            <ul>
            
                <!-- MENU ADMINISTRADORES -->

                    <li><a href='".$RutaAdmin."Admin_Ver.php' >GESTION ADMINISTRADORES</a></li>

                <!-- Fin MENU ADMINISTRADORES-->
                
                <!-- MENU ADMINISTRACION DEL CV -->

                    <li><a href='".$RutaAdmin."CV_Ver.php' >ADMINISTRACI&Oacute;N DEL CV</a></li>

                <!-- Fin MENU ADMINISTRACION DEL CV -->
                    
                <!-- MENU SECCIONES -->

                    <li><a href='".$RutaSecciones."Secciones_Ver.php' >ESPECIALIDAD</a></li>

                <!-- Fin MENU SECCIONES-->
                
                <!-- Inicio MODALIDAD -->

                    <li><a href='".$RutaSecciones."Modalidad_Ver.php' >MODALIDAD</a></li>
                    
                    <!-- Fin MODALIDAD-->

                <!-- Inicio CV URL -->
                    
                    <li><a href='".$RutaAdmin."cvurl_Crear.php'>CREAR MODIFICAR CV PDF URL</a></li>

                <!-- Fin CV URL -->

                <!-- Inicio BBDD -->

                    <li><a href='".$RutaUpBbdd."bbdd.php'>RESPALDO TABLAS BBDD</a></li>
                    
                <!-- Fin BBDD -->

                <!-- Inicio NOTIFICACIONES -->

                    <li><a href='".$RutaMail."index.php' target='_blank' >NOTIFICACIONES</a></li>
                    
                <!-- Fin NOTIFICACIONES -->

            </ul> <!-- FIN SUBMENU -->
                </li>
            
                <li style='text-align:left'>
                                <form name='cerrar' action='".$RutaAdmin."Admin_Access.php' method='post'>	
                                            <input type='submit' value='CERRAR SESION' />
                                            <input type='hidden' name='cerrar' value=1 />
                                </form>	
                </li>
                
            </ul> <!-- FIN UL GLOBAL -->

            <script type='text/javascript'>
                <!--  
                    var MenuBar1 = new Spry.Widget.MenuBar('MenuBar1', {imgRight:'MenuVertical/SpryMenuBarRightHover.gif'});
                -->
            </script>

            </div>");

	} else { }

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */
	
?>