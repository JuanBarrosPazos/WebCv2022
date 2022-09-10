<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Conections/conexion_bbdd.php';

///////////////////////////////////////////////////////////////////////////////////////

if (trim($_SESSION['Nivel']) == 'XBPadmin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

							if ($_POST['oculto2']){
								show_form();
								}
							elseif($_POST['oculto']){
								
												process_form();
												
								
								} else {
											show_form();
									}

				} else { require 'Admin_denegado.php'; }

if(isset($_POST['cerrar'])){ 
	
	unset($_SESSION['ID']);
	unset($_SESSION['Nivel']);
	unset($_SESSION['Nombre']);
	unset($_SESSION['Apellidos']);
	unset($_SESSION['Email']);
	unset($_SESSION['Usuario']);
	unset($_SESSION['Password']);
	unset($_SESSION['Direccion']);
	unset($_SESSION['Tlf1']);
	unset($_SESSION['Tlf2']);
	
	print("Se ha cerrado la sesión.<br/><br/>");
		}

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	
	$tabla = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=2  class='BorderInf'>
						Se ha borrado estos datos
					</th>
				</tr>
				
				<tr>
					<td width=200px>
						Year
					</td>
					<td width=200px>"
						.$_POST['year'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Horas
					</td>
					<td>"
						.$_POST['horas'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Sector
					</td>
					<td>"
						.$_POST['sector'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Titulo
					</td>
					<td>"
						.$_POST['titulo'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Modulos
					</td>
					<td>"
						.$_POST['modulos'].
					"</td>
				</tr>
				
				<tr>
				
					<td>
						Academia
					</td>
					<td>"
						.$_POST['academia'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Comentarios
					</td>
					<td>"
						.$_POST['coment'].
					"</td>
				</tr>
								
			</table>	
		";	


	global $db_name;

	$sqlc = "DELETE FROM `$db_name`.`web_cv` WHERE `web_cv`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			print("<br/>
					Se han Borrado sus datos correctamente");
			print( $tabla );
				} else {
				print("<font color='#FF0000'>
						SE HA PRODUCIDO UN ERROR: </font>
						<br/>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						<br/>";
						show_form ();
						
							}

		
			}	

//////////////////////////////////////////////////////////////////////////////////////////////
					
function show_form(){
		
	if($_POST['oculto2']){

				$defaults = array ( 'id' => $_POST['id'],
									'year' => $_POST['year'],
									'horas' => $_POST['horas'],
									'sector' => $_POST['sector'],
									'titulo' => $_POST['titulo'],
									'modulos' => $_POST['modulos'],
									'academia' => $_POST['academia'],
									'coment' => $_POST['coment'],
																		 );
								   											}
								   
		elseif($_POST['oculto']){
			
			$defaults = $_POST;
			
						} else {
			
							$defaults = array (	'id' => '',
												'year' => '',
												'horas' => '',
												'sector' => '',
												'titulo' => '',
												'modulos' => '',
												'academia' => '',
												'coment' => '',
																	 );
											   							}
	

	print("<table align='center' border=0>
				<tr>
					<th colspan=2 class='BorderInf'>
						<font color='#FF0000'>
						SE BORRARÁN ESTOS DATOS DEL REGISTRO.
						<br/>
						NO SE PODRÁN VOLVER A RECUPERAR.
						</font>
					</th>
				</tr>
				<tr>
                    <td align='right' colspan=2 class='BorderInf'>
                        <form name='modifica' action='CV_Ver.php' method='POST'>
                            <input type='submit' value='CANCELAR' />
                        </form>
                    </td>
				</tr>
				
			<form name='borrar' method='post' action='$_SERVER[PHP_SELF]'>
			
						<input name='id' type='hidden' value='".$defaults['id']."' />					
					
				<tr>
					<td width='160px'>	
						<font color='#FF0000'>*</font>
						Year
					</td>
					<td width='400px'>
					".$defaults['year']."
		<input type='hidden' name='year' value='".$defaults['year']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Horas
					</td>
					<td>
					".$defaults['horas']."
			<input type='hidden' name='horas' value='".$defaults['horas']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Sector
					</td>
					<td>
					".$defaults['sector']."
			<input type='hidden' name='sector' value='".$defaults['sector']."' />
					</td>
				</tr>	
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Titulo
					</td>
					<td>
					".$defaults['titulo']."
		<input  type='hidden' name='titulo' value='".$defaults['titulo']."' />
					</td>
				</tr>
							
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Modulos
					</td>
					<td>
					".$defaults['modulos']."
		<input  type='hidden' name='modulos' value='".$defaults['modulos']."' />
					
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Academia
					</td>
					<td>
					".$defaults['academia']."
	<input type='hidden' name='academia' value='".$defaults['academia']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Comentarios
					</td>
					<td>
				".$defaults['coment']."
	<input type='hidden' name='coment' value='".$defaults['coment']."' />
					</td>
				</tr>
				<tr align='center' height=60px>
					<td colspan=2 >
						<input type='submit' value='BORRAR ESTA ENTRADA' />
						<input type='hidden' name='oculto' value=1 />
		</form>														
					</td>
				</tr>
			</table>"); 

	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
	
function master_index(){

	global $RutaDir;
	$RutaDir = "Admin";
	require '../Inclu/Master_Index.php';
			
	} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	require '../Inclu/Inclu_Footer.php';

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */
		
?>
