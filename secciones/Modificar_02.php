<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Admin/Admin_select_rowd.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'XBPadmin'){

 	print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
		master_index();
			if (isset($_POST['oculto2'])){ show_form();}
			elseif($_POST['modifica']){
					if($form_errors = validate_form()){
						show_form($form_errors);
							} else { process_form();}
					} else { show_form();}
	} else { require '../Admin/Admin_denegado.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;
	
	require 'validate.php';
	
		return $errors;

	}

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;

	/***********************************************************************/
	/*************	SI EL VALOR DE LA VARIABLE SE MODIFICA	****************/
	/***********************************************************************/

		global $valor;	global $nombre;
		$nombre = $_POST['nombre'];
		$valor = $_POST['valor2'];
	
	global $tablename;	global $titulo;		global $titmod3;	global $titmod3a;
	if(isset($_POST['modalidad'])){ $tablename = "modalidad";
									$titulo = "NUEVOS DATOS DE MODALIDAD";
									$titmod3 = "INICIO MODALIDADES";
									$titmod3a = "Modalidad_Ver.php";
										}
    else { 	$tablename = "secciones"; 
			$titulo = "NUEVOS DATOS DE ESPECIALIDAD"; 
			$titmod3 = "INICIO ESPECIALIDADES";
			$titmod3a = "Secciones_Ver.php";
						}

	require 'table_process_form.php';

	/*************	MODIFICA VARIABLE DE SECTOR Y NOMBRE	*****************/
	
	if(trim($_POST['valor1'] != $_POST['valor2'])){
		/*
		print("Valor 1 ".$_POST['valor1']." y Valor Nuevo ".$_POST['valor2']." 
		<font color='#FF0000'>NO SON IGUALES</font>");
		*/
		
	$sqlc = "UPDATE `$db_name`.`$tablename` SET `valor` = '$_POST[valor2]', `nombre` = '$_POST[nombre]' WHERE `$tablename`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){	
		
		print( $tabla );

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
			} // FIN SE CUMPLE EL QUERY
				else {	print("<font color='#FF0000'>* </font>".mysqli_error($db))."</br>";
							show_form ();
								} // FIN SI NO SE CUMPLE EL QUERY

		} /* FIN DEL IF */
		
	/***********************************************************************/
	/*************	SI EL VALOR DE LA VARIABLE NO CAMBIA	****************/
	/***********************************************************************/

	elseif(trim($_POST['valor1'] == $_POST['valor2'])){
		/*
		print("Valor 1 ".$_POST['valor1']." y Valor Nuevo ".$_POST['valor1']." 
		<font color='#FF0000'>SON IGUALES</font>");
		*/
		
	/************	MODIFICA EL NOMBRE EN SECCIONES	*****************/
	
	$sqlc = "UPDATE `$db_name`.`$tablename` SET `valor` = '$_POST[valor2]', `nombre` = '$_POST[nombre]' WHERE `$tablename`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			print( $tabla );
				} else { print("<font color='#FF0000'>* </font>".mysqli_error($db))."</br>";
						 show_form ();
							}
			}	/* FINAL LA VARIABLE NO CAMBIA */

	}	/* Final de la función process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////
			
function show_form($errors=[]){
	
	if(isset($_POST['oculto2'])){
		
				$defaults = array ( 'id' => $_POST['id'],
									'valor1' => $_POST['valor'],
									'valor2' => $_POST['valor'],
									'nombre' => $_POST['nombre'],
										);
								}
								   
	elseif(isset($_POST['modifica'])){

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

	global $titmod;		global $titmod2;	global $titmod3;	global $titmod3a;		global $inputmod;
	if(isset($_POST['modalidad'])){ $titmod = "NUEVOS DATOS MODALIDAD";
									$titmod2 = "MODIFICAR MODALIDAD";
									$titmod3 = "INICIO MODALIDADES";
									$titmod3a = "Modalidad_Ver.php";
									$inputmod = "<input type='hidden' name='modalidad' value=1 />"; }
	else { 	$titmod = "NUEVOS DATOS ESPECIALIDAD"; 
			$titmod2 = "MODIFICAR ESPECIALIDAD";
			$titmod3 = "INICIO ESPECIALIDADES";
			$titmod3a = "Secciones_Ver.php";
			$inputmod = ""; }

	print("<table align='center' border=0>
				<tr>
					<th colspan=2 class='BorderInf'>".$titmod."</th>
				</tr>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td><font color='#FF0000'>*</font>Id:</td>
					<td>
			<input type='hidden' name='id' value='".$defaults['id']."' />".$defaults['id']."
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Valor:</td>
					<td>
			<input type='hidden' name='valor1' value='".$defaults['valor1']."' />".$defaults['valor1']."
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Valor Nuevo:</td>
					<td>
			<input type='text' name='valor2' size=25 maxlength=22 value='".$defaults['valor2']."' />
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Nombre:</td>
					<td>
			<input type='text' name='nombre' size=25 maxlength=22 value='".$defaults['nombre']."' />
					</td>
				</tr>
				<tr height=60px>
					<td align='center' valign='middle' class='BorderSup'>
						<input type='submit' value='".$titmod2."' />
						<input type='hidden' name='modifica' value=1 />
						".$inputmod."
					</td>
		</form>	
					<td align='center' valign='middle' class='BorderSup'>
						<form name='modifica' action='".$titmod3a."' method='POST'>
							<input type='hidden' name='todo' value=1 />
							<input type='submit' value='".$titmod3."' />
						</form>
					</td>
				</tr>
													
			</table>"); 
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
	
function master_index(){

	global $RutaDir;
	$RutaDir = "Secciones";
	require '../Inclu/Master_Index.php';
			
	} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Inclu_Footer.php';

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */
		
?>