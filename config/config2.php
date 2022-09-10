<?php
session_start();

	require '../Inclu/Inclu_Menu_00c2.php';
	require '../Conections/conection.php';
	require '../Conections/conexion_bbdd.php';
	require '../Admin/Admin_select_rowd.php';

///////////////////////////////////////////////////////////////////////////////////////////////


						if(isset($_POST['oculto'])){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											}
							
							} else {
										show_form();
								}


//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;
	
		require '../Inclu/validate.php';	
		
		return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	
	$tabla = "<table style='text-align:left' align='center' style='margin-top:10px,'>
				<tr>
					<th align='center' colspan=2 class='BorderInf'>
						Usted se ha registrado como Administrador con los siguientes datos.
					</th>
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
						Pais:
					</td>
					<td>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 1:
					</td>
					<td>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 2:
					</td>
					<td>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
								
				<tr>
					<td colspan=2 align='right' class='BorderSup'>
						<a href=\"../index.php\">
							
									ADMINISTRADOR ACCESO A INICIO DEL SISTEMA 
							
						</a>
					</td>
				</tr>

			</table>	
		";

	global $db_name;

	$sql = "INSERT INTO `$db_name`.`admin` (`Nombre`, `Apellidos`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`) VALUES ('$_POST[Nombre]', '$_POST[Apellidos]', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$_POST[Password]', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]')";
		
if(mysqli_query($db, $sql)){

print("<br/>Se ha registrado correctamente");

if(file_exists('../index.php')){unlink("../index.php");}

print( $tabla );
					
$datein = date('Y-m-d/H:i:s');
$logdate = date('Y_m_d');
$logtext = "- CREADO USER ADMIN 1. ".$datein.".\n \t Name: ".$_POST['Nombre']." ".$_POST['Apellidos'].". \n \t User: ".$_POST['Usuario'].".\n \t Pass: ".$_POST['Password'].".\n";
$filename = $logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
fclose($log);

copy("index_Play_System.php", "../index.php");

				} 
	
	else {print("	<br/><font color='#FF0000'>* DATOS NO VALIDOS: </font>
					<br/> ".mysqli_error($db))."<br/>";
					show_form ();
									}

			}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	if(@$_POST['oculto']){
		$defaults = $_POST;
		} else {	$defaults = array ( 'Nombre' => '',
										'Apellidos' => '',
										'doc' => '',
										'dni' => '',
										'ldni' => '',
										'Email' => 'Solo letras minúsculas',
										'Usuario' => '',
										'Usuario2' => '',
										'Password' => '',
										'Password2' => '',
										'Direccion' => '',
										'Tlf1' => '',
										'Tlf2' => '');
									   }
	
	if ($errors){
		print("	<div width='90%' style='float:left'>
					<table align='left' style='border:none'>
					<th style='text-align:left'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
					<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors[$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>
				</div>
				<div style='clear:both'></div>");
		}
		
	$doctype = array (	'DNI' => 'DNI/NIF Espa&ntilde;oles',
						'NIE' => 'NIE/NIF Extranjeros',
						'NIFespecial' => 'NIF Persona F&iacute;sica Especial',
						'NIFsa' => 'NIF Sociedad An&oacute;nima',
						'NIFsrl' => 'NIF Sociedad Responsabilidad Limitada',
						'NIFscol' => 'NIF Sociedad Colectiva',
						'NIFscom' => 'NIF Sociedad Comanditaria',
						'NIFcbhy' => 'NIF Comunidad Bienes y Herencias Yacentes',
						'NIFscoop' => 'NIF Sociedades Cooperativas',
						'NIFasoc' => 'NIF Asociaciones',
						'NIFcpph' => 'NIF Comunidad Propietarios Propiedad Horizontal',
						'NIFsccspj' => 'NIF Sociedad Civil, con o sin Personalidad Juridica',
						'NIFee' => 'NIF Entidad Extranjera',
						'NIFcl' => 'NIF Corporaciones Locales',
						'NIFop' => 'NIF Organismo Publico',
						'NIFcir' => 'NIF Congragaciones Instituciones Religiosas',
						'NIFoaeca' => 'NIF Organos Admin Estado y Comunidades Autonomas',
						'NIFute' => 'NIF Uniones Temporales de Empresas',
						'NIFotnd' => 'NIF Otros Tipos no Definidos',
						'NIFepenr' => 'NIF Establecimientos Permanentes Entidades no Residentes',
										);
	
	print("<table style='text-align:left' align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf' align='center'>

							Por favor introduzca sus datos de registro como Administrador.
					</th>
				</tr>
				
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td width=360px>
		<input type='text' name='Nombre' size=28 maxlength=25 value='".@$defaults['Nombre']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Apellidos:
					</td>
					<td>
		<input type='text' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' />
					</td>
				</tr>

				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Tipo Documento:
					</td>
					<td>
				<select name='doc'>");

				foreach($doctype as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['doc']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("</select>
					</td>
				</tr>
					

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						N&uacute;mero:
					</td>
					<td>
		<input type='text' name='dni' size=12 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Control:
					</td>
					<td>
		<input type='text' name='ldni' size=4 maxlength=1 value='".$defaults['ldni']."' />
					</td>
				</tr>
				
					<td>
						<font color='#FF0000'>*</font>
						Mail:
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
					</td>
				</tr>	
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nombre de Usuario:
					</td>
					<td>
		<input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme el Usuario:
					</td>
					<td>
		<input type='text' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' />
					</td>
				</tr>
							
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Password:
					</td>
					<td>
		<input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme el Password:
					</td>
					<td>
		<input type='text' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' />
					</td>
				</tr>


				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Dirección:
					</td>
					<td>
		<input type='text' name='Direccion' size=52 maxlength=52 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				
				<tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 1:
					</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 2:
					</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr>
					<td colspan='2'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='Registrarme con estos datos' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				
				"); 
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		print("	<table align='center' width='100%' style=\"margin-top:10px\">
					<tr>
						<td colspan='4' class='BorderInf' align='center'>
							<font color='#59746A'>
								<b>
										WEB CV ADMINISTRACI&Oacute;N DEL SISTEMA
								</b>
							</font>
						</td>
					</tr>
					
					<tr>			

						<td class='BorderInfDch' align='center'>
							<a href='Admin_Ver.php'>
											CONSULTAR ADMIN
							</a>
						</td>

						<td class='BorderInfDch' align='center'>
							<a href='Admin_Crear.php'>
											CREAR ADMIN
							</a>
						</td>

						<td class='BorderInfDch' align='center'>
							<a href='Admin_Modificar_01.php'>
											MODIFICAR ADMIN
							</a>
						</td>

						<td align='center' class='BorderInfDch'>
							<a href='Admin_Borrar_01.php'>
											ELIMINAR ADMIN
							</a>
						</td>
					</tr>

					<tr>
						<td colspan='4' class='BorderInf' align='center'>
							<font color='#59746A'>
								<b>
										WEB CV ADMINISTRACI&Oacute;N DEL CV
								</b>
							</font>
						</td>
					</tr>
					
					<tr>			
						<td class='BorderInfDch' align='center'>
							<a href='CV_Ver.php'>
											VER CV
							</a>		
						</td>

						<td class='BorderInfDch' align='center'>
							<a href='CV_Crear.php'>
											CREAR DATOS CV
							</a>
						</td>

						<td class='BorderInfDch' align='center'>
							<a href='CV_Modificar_01.php'>
											MODIFICAR DATOS CV
							</a>
						</td>

						<td class='BorderInfDch' align='center'>
							<a href='CV_Borrar_01.php'>
											ELIMINAR DATOS CV
							</a>
						</td>

					</tr>
							");
						
												desconexion ();
												
		print("</table>
								
						");
				
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){
		
			print("<form name='cerrar' action='Admin_Access.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Inclu_Footer.php';

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */
		
?>
