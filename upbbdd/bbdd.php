<?php
	session_start();

	//error_reporting (0);
	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Conections/conexion_bbdd.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'XBPadmin'){

 		print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
		master_index();

			if(isset($_POST['delete'])){ delete();
										 show_form();
										 listfiles();
											}

			elseif(isset($_POST['oculto2'])){ show_form();
											  ver_todo();
											  listfiles();
			} else { show_form();
					 listfiles();
						}
									
	} else { require '../Admin/Admin_denegado.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form(){

	global $db;
	global $db_name;
		
/* Se busca las tablas en la base de datos */
	$consulta = "SHOW TABLES FROM $db_name";
	$respuesta = mysqli_query($db, $consulta);
	if(!$respuesta){
	print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {	print( "<table align='center'>
									<tr>
										<th colspan=2 class='BorderInf'>
									NUMERO DE TABLAS ".mysqli_num_rows($respuesta).".
										</th>
									</tr>");
			while ($fila = mysqli_fetch_row($respuesta)) {
				print(	"<tr>
							<td class='BorderInfDch'>
											".$fila[0]."
							</td>
							<td class='BorderInf'>
				<form name='exporta' action='$_SERVER[PHP_SELF]' method='POST'>
					<input name='tabla' type='hidden' value='".$fila[0]."' />
						<input type='submit' value='EXPORTA TABLA ".$fila[0]."' />
						<input type='hidden' name='oculto2' value=1 />
						</form>
										</td>
							<tr>			
								");
					}
			print("</table>");		
					
		}
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){

		require 'export_bbdd.php';
		
	}	/* FINAL ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function listfiles(){
	
	global $ruta;
	$ruta ="bbdd/";
	
	$directorio = opendir($ruta);
	global $num;
	$num=count(glob("bbdd/{*}",GLOB_BRACE));
	if($num < 1){print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
	<tr><td align='center' class='BorderInf'>NO HAY ARCHIVOS PARA DESCARGAR</td></tr>");
	}else{
		
	print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
	<tr><td align='center' colspan='3' class='BorderInf'>ARCHIVOS RESPALDO BBDD </td></tr>");
	while($archivo = readdir($directorio)){
		if($archivo != ',' && $archivo != '.' && $archivo != '..'){
			print("<tr>
			<td class='BorderInfDch'>
			<form name='delete' action='$_SERVER[PHP_SELF]' method='post'>
			<input type='hidden' name='tablas' value='".@$_SESSION['tablas']."' />
			<input type='hidden' name='ruta' value='".$ruta.$archivo."'>
			<input type='submit' value='ELIMINAR' >
			<input type='hidden' name='delete' value='1' >
			</form>
			</td>
			<td class='BorderInfDch'>
			<form name='archivos' action='".$ruta.$archivo."' target='_blank' method='post'>
			<input type='hidden' name='tablas' value='".@$_SESSION['tablas']."' />
			<input type='submit' value='DESCARGAR'>
			</form>
			</td>
			<td class='BorderInf'>".strtoupper($archivo)."</td>
			");
		}else{}
	} // FIN DEL WHILE
	}
	closedir($directorio);
	print("</table>");
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function delete(){unlink($_POST['ruta']);}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
function master_index(){

	global $RutaDir;
	$RutaDir = "Upbbdd";
	require '../Inclu/Master_Index.php';
			
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Inclu_Footer.php';

					////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

				 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */

?>