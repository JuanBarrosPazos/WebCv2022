<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."<br/>".mysqli_connect_error());
				}

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
				} else { 
					
						print("<table align='center' style=\"margin-top:200px;margin-bottom:200px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													ACCESO RESTRINGIDO.
												<br/><br/>
													CONSULTE SUS PERMISOS ADMINISTRATIVOS.
											</font>
										</td>
									</tr>
								</table>");

							}

if($_POST['cerrar']){ 
	
	unset($_SESSION['ID']);
	unset($_SESSION['Nivel']);
	unset($_SESSION['Nombre']);
	unset($_SESSION['Apellidos']);
	unset($_SESSION['doc']);
	unset($_SESSION['dni']);
	unset($_SESSION['ldni']);
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
	
	print("<table align='center'>
				<tr>
					<th colspan=2  class='BorderInf'>
						Se han borrado estos datos del registro.
					</th>
				</tr>
				
				<tr>
					<td width=200px>
						ID:
					</td>
					<td width=200px>"
						.$_POST['ID'].
					"</td>
				</tr>
				
				<tr>
					<td width=200px>
						Nombre:
					</td>
					<td width=200px>"
						.$_POST['Nombre'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Apellidos:
					</td>
					<td>"
						.$_POST['Apellidos'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Tipo Documento:
					</td>
					<td>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						N&uacute;mero:
					</td>
					<td>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Control:
					</td>
					<td>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Mail:
					</td>
					<td>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Usuario:
					</td>
					<td>"
						.$_POST['Usuario'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Password:
					</td>
					<td>"
						.$_POST['Password'].
					"</td>
				</tr>
				
				
				<tr>
				
					<td>
						Direcci&oacute;n:
					</td>
					<td>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tel&eacute;fono 1:
					</td>
					<td>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tel&eacute;fono 2:
					</td>
					<td>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
				
			</table>	
		");

	global $db_name;

	$sql = "DELETE FROM `$db_name`.`admin` WHERE `admin`.`ID` = '$_POST[ID]' LIMIT 1 ";

	if(mysqli_query($db, $sql)){
			print("Se han Eliminado los datos correctamente");
				} else {
				print("<font color='#FF0000'>
						SE HA PRODUCIDO UN ERROR: </font>
						<br/>
						&nbsp;&nbsp;$nbsp;".mysqli_error($db))."
						<br/>";
						show_form ();
						
							}

			}	

//////////////////////////////////////////////////////////////////////////////////////////////
					
			$id = $_POST['Id'];

function show_form(){
		
	if($_POST['oculto2']){
		
				$defaults = array ( 'ID' => $_POST['ID'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2'],
																		 );
								   											}
	if($_POST['oculto']){
		
				$defaults = array ( 'ID' => $_POST['ID'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2'],
																		 );
								   											}
								   
	print("
			<table align='center' style=\"margin-top:20px\">
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
					<th colspan=2 class='BorderInf' style=\"text-align:right\">
							<a href='Admin_Borrar_01.php' >
													CANCELAR
							</a>
						</font>
					</th>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
				<input name='ID' type='hidden' value='".$defaults['ID']."' />					
					
		<tr>
			<td>	
						Nombre:
			</td>
			
			<td>
				".$defaults['Nombre']."
				<input  type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
			</td>
		</tr>
					
		<tr>
			<td>
						Apellidos:
			</td>
			
			<td>
				".$defaults['Apellidos']."
				<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
			</td>
		</tr>
				
		<tr>
			<td>
						Tipo Documeno:
			</td>
			
			<td>
				".$defaults['doc']."
				<input type='hidden' name='doc' value='".$defaults['doc']."' />
			</td>
		</tr>
				
		<tr>
			<td>
						N&uacute;mero:
			</td>
			
			<td>
				".$defaults['dni']."
				<input type='hidden' name='dni' value='".$defaults['dni']."' />
			</td>
		</tr>
				
		<tr>
			<td>
						Control:
			</td>
			
			<td>
				".$defaults['ldni']."
				<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
			</td>
		</tr>
				

		<tr>
			<td>
						Mail:
			</td>
			<td>
				".$defaults['Email']."
				<input type='hidden'' name='Email' value='".$defaults['Email']."' />
			</td>
		</tr>	
				
		<tr>
			<td>
						Nombre de Usuario:
			</td>
			<td>
				".$defaults['Usuario']."
				<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
			</td>
		</tr>
							
		<tr>
			<td>
						Password:
			</td>
			<td>
				".$defaults['Password']."
				<input type='hidden' name='Password' value='".$defaults['Password']."' />
			</td>
		</tr>

		<tr>
			<td>
						Dirección:
			</td>
			<td>
				".$defaults['Direccion']."
				<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
			</td>
		</tr>
				
		<tr>
			<td>
						Teléfono 1:
			</td>
			<td>
				".$defaults['Tlf1']."
				<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
			</td>
		</tr>
				
		<tr>
			<td class='BorderInf'>
						Teléfono 2:
			</td>
			<td class='BorderInf'>
				".$defaults['Tlf2']."
				<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
			</td>
		</tr>
				
		<tr align='center'>
			<td colspan='2'>
				<input type='submit' value='ELIMINAR DATOS DEFINITIVAMENTE' />
				<input type='hidden' name='oculto' value=1 />
			</td>
		</tr>
				
</form>														
			
	</table>				
			
				"); 
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Admin.php';
				
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	require '../Inclu/Admin_Inclu_02.php';
		
?>
