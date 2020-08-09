<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

	$sqld =  "SELECT * FROM `admin` WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
	$qd = mysqli_query($db, $sqld);
	
	$rowd = mysqli_fetch_assoc($qd);

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'XBPadmin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();


						if($_POST['oculto']){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
																	}
							
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

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;
	
	if(strlen(trim($_POST['valor'])) == 0){
		$errors [] = "Valor: <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['valor'])) < 4){
		$errors [] = "Valor: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['valor'])){
		$errors [] = "Valor: <font color='#FF0000'>Solo texto.</font>";
		}
		
	elseif (!preg_match('/^[a-z\s_]+$/',$_POST['valor'])){
		$errors [] = "Valor: <font color='#FF0000'>Solo minusculas sin acentos.</font>";
		}

	
	if(strlen(trim($_POST['nombre'])) == 0){
		$errors [] = "Nombre: <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['nombre'])) < 5){
		$errors [] = "Nombre: <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['nombre'])){
		$errors [] = "Nombre: <font color='#FF0000'>Solo texto.</font>";
		}
		
	elseif (!preg_match('/^[A-Z\s_]+$/',$_POST['nombre'])){
		$errors [] = "Nombre: <font color='#FF0000'>Solo mayusculas sin acentos.</font>";
		}
		
			return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $nombre;
	global $valor;
	global $db_name;
	
	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 class='BorderInf'>
						CREADA UNA NUEVA SECCI&Oacute;N
					</th>
				</tr>
				
				<tr>
					<td width=120px>
						Valor:
					</td>
					<td width=200px>"
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
						";	 
		
	/******** 	GRABAMOS LA MODALIDAD EN LA TABLA MODALIDAD	*********/

	$valor = $_POST['valor'];
	$nombre = $_POST['nombre'];

	$sql = "INSERT INTO `$db_name`.`modalidad` (`valor`, `nombre`) VALUES ('$_POST[valor]', '$_POST[nombre]')";
		
	if(mysqli_query($db, $sql)){
			print( $tabla );
			
		} else {
				print("<font color='#FF0000'>* </font> ".mysqli_error($db))."</br>";
				
					}
	
			}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'valor' => '',
									'nombre' => '',
														);
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
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>
				</div>
				<div style='clear:both'></div>");
		}
		
	print("<table align='center' style=\"margin-top:10px\">

				<tr>
					<th colspan=2 class='BorderInf'>

							CREAR NUEVA MODALIDAD
							<br/>
							Sus entradas en el CV podrán configurarse por dos tipos de modalidad distintos.
							<br/>
							Y posteriormente filtrarse por los mismos criterios.
							<br />
							Cree las modalidades necesariss para organizar correctamente sus entradas.
							<br />
							Por ejemplo: Experiencia, Formacion, Otros...

					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						
				<tr>
					<td width=120px>	
						<font color='#FF0000'>*</font>
						Valor:
					</td>
					<td width=200px>
		<input type='text' name='valor' size=25 maxlength=22 value='".$defaults['valor']."' />
					</td>
				</tr>
					
				<tr>
					<td width=120px>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td width=200px>
		<input type='text' name='nombre' size=25 maxlength=22 value='".$defaults['nombre']."' />
					</td>
				</tr>
					
				<tr>
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
						<input type='submit' value='NUEVA MODALIDAD' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				
					"); 
	
							}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Modalidad.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>