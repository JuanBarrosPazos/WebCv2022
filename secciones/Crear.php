<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Admin/Admin_select_rowd.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'XBPadmin'){

 	print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
		master_index();
			if(isset($_POST['oculto'])){
					if($form_errors = validate_form()){
						show_form($form_errors);
							} else {
								process_form();
														}
				} else { show_form(); }
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
	global $nombre;
	global $valor;
	global $db_name;
	
	
	/******** 	GRABAMOS LA SECTORES EN LA TABLA SECCIONES	*********/

	global $valor;		global $nombre;
	$valor = $_POST['valor'];
	$nombre = $_POST['nombre'];

	global $crear;
	$crear = 1;

	global $tablename;	global $titulo;		global $titmod3;	global $titmod3a;
	if(isset($_POST['modalidad'])){ $tablename = "modalidad";
									$titulo = "CREADA NUEVA MODALIDAD";
									$titmod3 = "INICIO MODALIDADES";
									$titmod3a = "Modalidad_Ver.php";
										}
    else { 	$tablename = "secciones"; 
			$titulo = "CREADA NUEVA ESPECIALIDAD"; 
			$titmod3 = "INICIO ESPECIALIDADES";
			$titmod3a = "Secciones_Ver.php";
						}

	require 'table_process_form.php';

	$sql = "INSERT INTO `$db_name`.`$tablename` (`valor`, `nombre`) VALUES ('$_POST[valor]', '$_POST[nombre]')";
		
	if(mysqli_query($db, $sql)){
			print( $tabla );
		} else { print("<font color='#FF0000'>* </font> ".mysqli_error($db))."</br>"; }
	
			}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
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
	
	global $titmod;		global $titmod2;	global $titmod3;	global $titmod3a;		global $inputmod;
	if(isset($_POST['modalidad'])){ $titmod = "CREAR NUEVA MODALIDAD";
									$titmod2 = "CREAR MODALIDAD";
									$titmod3 = "INICIO MODALIDADES";
									$titmod3a = "Modalidad_Ver.php";
									$inputmod = "<input type='hidden' name='modalidad' value=1 />"; }
	else { 	$titmod = "CREAR NUEVA ESPECIALIDAD"; 
			$titmod2 = "CREAR ESPECIALIDAD";
			$titmod3 = "INICIO ESPECIALIDADES";
			$titmod3a = "Secciones_Ver.php";
			$inputmod = ""; }

	print(" <table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>
							".$titmod."
					</th>
				</tr>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
				<tr>
					<td width=120px><font color='#FF0000'>*</font>Valor:</td>
					<td width=200px>
		<input type='text' name='valor' size=25 maxlength=22 value='".$defaults['valor']."' />
					</td>
				</tr>
				<tr>
					<td width=120px><font color='#FF0000'>*</font>Nombre:</td>
					<td width=200px>
		<input type='text' name='nombre' size=25 maxlength=22 value='".$defaults['nombre']."' />
					</td>
				</tr>
				<tr>
					<td align='center' valign='middle' class='BorderSup'>
						<input type='submit' value='".$titmod2."' />
						<input type='hidden' name='oculto' value=1 />
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