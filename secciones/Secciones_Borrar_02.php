<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	global $db;
	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'XBPadmin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

							if ($_POST['oculto2']){
													show_form();
													
							} elseif ($_POST['borrar']){
													process_form();
								
								} else {
											show_form();
									}
				} else { 
					
						print("<table align='center' style=\"margin-top:200px;margin-bottom:200px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													ACCESO RESTRINGIDO.
												</br></br>
													CONSULTE SUS PERMISOS ADMINISTRATIVOS.
											</font>
										</td>
									</tr>
								</table>");

							}

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;
	global $nombre;
	global $valor;
	
	
	print("<table align='center'>
				<tr>
					<th colspan=2  class='BorderInf'>
						Se han borrado estos datos del registro.
					</th>
				</tr>
				
				<tr>
					<td width=120px>
						ID:
					</td>
					<td width=160px>"
						.$_POST['id'].
					"</td>
					
				</tr>
				
				<tr>
					<td>
						Valor:
					</td>
					<td>"
						.$_POST['valor'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Nombre:
					</td>
					<td>"
						.$_POST['nombre'].
					"</td>
				</tr>

			</table>	
		");	

	/***********	BORRAMOS SECTORES DE TABLA SECCIONES		***************/
	
	$nombre = $_POST['nombre'];
	$valor = $_POST['valor'];

	$sql2c = "DELETE FROM `$db_name`.`secciones` WHERE `secciones`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sql2c)){
				} else {
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
									}
	$sql3c = "DELETE FROM `$db_name`.`web_cv` WHERE `web_cv`.`sector` = '$_POST[valor]' ";

	if(mysqli_query($db, $sql3c)){
				} else {
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
									}

	$sql4c = "DELETE FROM `$db_name`.`web_cv` WHERE `web_cv`.`sector2` = '$_POST[valor]' ";

	if(mysqli_query($db, $sql4c)){
				} else {
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
									}

			}

//////////////////////////////////////////////////////////////////////////////////////////////
					
function show_form(){
		
	if($_POST['oculto2']){
		
				$defaults = array ( 'id' => $_POST['id'],
									'valor' => $_POST['valor'],
									'nombre' => $_POST['nombre'],
																		 );
								   											}
	if($_POST['borrar']){
		
				$defaults = array ( 'id' => $_POST['id'],
									'valor' => $_POST['valor'],
									'nombre' => $_POST['nombre'],
																		 );
								   											}
								   
	print("<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3 class='BorderInf'>
						<font color='#FF0000'>
							SE BORRARÁ ESTA MODALIDAD.
						</br>
						NO SE PODRÁN VOLVER A RECUPERAR.
						</font>
					</th>
				</tr>
				<tr>
					<th colspan=2 class='BorderInf' style=\"text-align:right\">
							<a href='Secciones_Borrar_01.php' >
													CANCELAR
							</a>
						</font>
					</th>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
				<tr>
					<td>	
						Id:
				</td>
				
				<td>
				".$defaults['id']."
				<input  type='hidden' name='id' value='".$defaults['id']."' />
			</td>
			
				</tr>
							
				<tr>
					<td>
						Valor:
					</td>
					
					<td>
				".$defaults['valor']."
				<input type='hidden' name='valor' value='".$defaults['valor']."' />
					</td>
				</tr>
				
				<tr>
					<td>	
						Nombre:
					</td>
					
					<td>
				".$defaults['nombre']."
				<input  type='hidden' name='nombre' value='".$defaults['nombre']."' />
					</td>
				</tr>
							
				<tr>
					<td colspan='2' align='right'>
						<input type='submit' value='BORRAR DATOS PERMANENETEMENTE' />
						<input type='hidden' name='borrar' value=1 />
					</td>
				</tr>
				
		</form>														
			
	</table>				
				");
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Secciones.php';
		
				}

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>