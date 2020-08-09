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

							if ($_POST['oculto2']){
								show_form();
								}
							elseif($_POST['modifica']){
								
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
	
	if(strlen(trim($_POST['valor2'])) == 0){
		$errors [] = "Valor Nuevo: <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['valor2'])) < 3){
		$errors [] = "Valor Nuevo: <font color='#FF0000'>Más de 2 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['valor2'])){
		$errors [] = "Valor Nuevo: <font color='#FF0000'>Solo texto.</font>";
		}
		
	elseif (!preg_match('/^[a-z\s_]+$/',$_POST['valor2'])){
	$errors [] = "Valor Nuevo: <font color='#FF0000'>Solo minusculas sin acentos</font>";
		}

	
	if(strlen(trim($_POST['nombre'])) == 0){
		$errors [] = "Nombre: <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['nombre'])) < 3){
		$errors [] = "Nombre: <font color='#FF0000'>Más de 2 carácteres.</font>";
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
	
	$tabla = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=2  class='BorderInf'>
						NUEVOS DATOS DEL SECTOR.
					</th>
				</tr>
				
				<tr>
					<td width=200px>
						ID:
					</td>
					<td width=200px>"
						.$_POST['id'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Valor:
					</td>
					<td>"
						.$_POST['valor2'].
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

	/***********************************************************************/
	/*************	SI EL VALOR DE LA VARIABLE SE MODIFICA	****************/
	/***********************************************************************/

	if(trim($_POST['valor1'] !== $_POST['valor2'])){
		/*
		print("Valor 1 ".$_POST['valor1']." y Valor Nuevo ".$_POST['valor2']." 
		<font color='#FF0000'>NO SON IGUALES</font>");
		*/
		
			global $db_name;
			global $nombre;
			global $valor;
			
			$nombre = $_POST['nombre'];
			$valor = $_POST['valor2'];
	
	/*************	MODIFICA VARIABLE DE SECTOR Y NOMBRE	*****************/
	
	$sqlc = "UPDATE `$db_name`.`secciones` SET `valor` = '$_POST[valor2]', `nombre` = '$_POST[nombre]' WHERE `secciones`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			print( $tabla );
				} else {
						print("<font color='#FF0000'>* </font>".mysqli_error($db))."</br>";
						show_form ();
					}
					
	$sqlc2 = "UPDATE `$db_name`.`web_cv` SET `sector` = '$_POST[valor2]' WHERE `web_cv`.`sector` = '$_POST[valor1]' ";

	if(mysqli_query($db, $sqlc2)){
				} else {
						print("<font color='#FF0000'>* </font>".mysqli_error($db))."</br>";
						show_form ();
					}

	$sqlc3 = "UPDATE `$db_name`.`web_cv` SET `sector2` = '$_POST[valor2]' WHERE `web_cv`.`sector2` = '$_POST[valor1]' ";

	if(mysqli_query($db, $sqlc3)){
				} else {
						print("<font color='#FF0000'>* </font>".mysqli_error($db))."</br>";
						show_form ();
					}

		} /* FIN DEL IF */
		
	/***********************************************************************/
	/*************	SI EL VALOR DE LA VARIABLE NO CAMBIA	****************/
	/***********************************************************************/

	elseif(trim($_POST['valor1'] == $_POST['valor2'])){
		/*
		print("Valor 1 ".$_POST['valor1']." y Valor Nuevo ".$_POST['valor1']." 
		<font color='#FF0000'>SON IGUALES</font>");
		*/
		
	global $db_name;
	global $nombre;
	global $valor;
	
	$nombre = $_POST['nombre'];
	$valor = $_POST['valor2'];

	$stock2 = "stock".$_POST['valor2'];
	$pro2 = "pro".$_POST['valor2'];
	$feed2 = "feed".$_POST['valor2'];
	$feedpro2 = "feedpro".$_POST['valor2'];

	/************	MODIFICA EL NOMBRE EN SECCIONES	*****************/
	
	$sqlc = "UPDATE `$db_name`.`secciones` SET `valor` = '$_POST[valor2]', `nombre` = '$_POST[nombre]' WHERE `secciones`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			print( $tabla );
				} else {
						print("<font color='#FF0000'>* </font>".mysqli_error($db))."</br>";
								show_form ();
							}

			}	/* FINAL CONDICIONAL IF BBDD*/

	}	/* Final de la función process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////
			
	global $dt;

function show_form($errors=''){
	
	if($_POST['oculto2']){
		
				$defaults = array ( 'id' => $_POST['id'],
									'valor1' => $_POST['valor'],
									'valor2' => $_POST['valor'],
									'nombre' => $_POST['nombre'],
																		 );
								}
								   
	elseif($_POST['modifica']){

				$defaults = array ( 'id' => $_POST['id'],
									'valor1' => $_POST['valor1'],
									'valor2' => $_POST['valor2'],
									'nombre' => $_POST['nombre'],
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
		
	print("<table align='center' border=0>
				<tr>
					<th colspan=2 class='BorderInf'>
						INTRODUZCA LOS NUEVOS DATOS.
					</th>
				</tr>
				
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						Id:
					</td>
					<td>
		<input type='hidden' name='id' value='".$defaults['id']."' />".$defaults['id']."
					</td>
				</tr>
					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						Valor:
					</td>
					<td>
		<input type='hidden' name='valor1' value='".$defaults['valor1']."' />".$defaults['valor1']."
					</td>
				</tr>
					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						Valor Nuevo:
					</td>
					<td>
		<input type='text' name='valor2' size=25 maxlength=22 value='".$defaults['valor2']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td>
		<input type='text' name='nombre' size=25 maxlength=22 value='".$defaults['nombre']."' />
					</td>
				</tr>

				
				<tr height=60px>
					<td colspan='2' align='right'>
						<input type='submit' value='MODIFICAR SECTOR' />
						<input type='hidden' name='modifica' value=1 />
						
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