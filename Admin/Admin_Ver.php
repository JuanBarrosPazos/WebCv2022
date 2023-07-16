<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Conections/conexion_bbdd.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (trim($_SESSION['Nivel']) == 'XBPadmin'){
	
					print("Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
					
					master_index();
					
					if(isset($_POST['todo'])){
										show_form();							
										ver_todo();
							}
							
							elseif(isset($_POST['oculto'])){
								
									if($form_errors = validate_form()){
										show_form($form_errors);
											} else {
												process_form();
													}
								
								} else { show_form(); }		

				} else { require 'Admin_denegado.php'; }

if(isset($_POST['cerrar'])){ 
	
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

function validate_form(){

	global $nombre;
	if(isset($_POST['Nombre'])){$nombre = trim($_POST['Nombre']);} else { }
	global $apellidos;
	if(isset($_POST['Apellidos'])){$apellidos = trim($_POST['Apellidos']);} else { }

	$errors = array();
	
	if ((strlen(trim($_POST['Nombre'])) == 0) && (strlen(trim($_POST['Apellidos'])) == 0)){
		$errors [] = "Nombre: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]*$/',$nombre)){
		$errors [] = "Nombre: <font color='#FF0000'>Solo se admite texto.</font>";
		}
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]*$/',$apellidos)){
		$errors [] = "Apellidos: <font color='#FF0000'>Solo se admite texto.</font>";
		}

	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;

	show_form();

	$nom = "%".$_POST['Nombre']."%";
	$ape = "%".$_POST['Apellidos']."%";

	global $orden; 
	if(isset($_POST['Orden'])){$orden = $_POST['Orden'];}
	else{$orden = "`id` ASC";}
		

	global $sqlb;
	if ((strlen(trim($_POST['Nombre'])) != 0) && (strlen(trim($_POST['Apellidos'])) != 0)){$sqlb =  "SELECT * FROM `admin` WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape' ORDER BY $orden "; } 
	elseif ((strlen(trim($_POST['Nombre'])) != 0) && (strlen(trim($_POST['Apellidos'])) == 0)){$sqlb =  "SELECT * FROM `admin` WHERE `Nombre` LIKE '$nom' ORDER BY $orden "; } 
	elseif ((strlen(trim($_POST['Nombre'])) == 0) && (strlen(trim($_POST['Apellidos'])) != 0)){$sqlb =  "SELECT * FROM `admin` WHERE `Apellidos` LIKE '$ape' ORDER BY $orden "; }
	else { }
		
		global $qb;
		$qb = mysqli_query($db, $sqlb);

		require 'Admin_while_total.php';

	} // Fin Function

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		}
	elseif(isset($_POST['todo'])){
		$defaults = $_POST;
		} else {global $ordenar;
				$defaults = array ('Nombre' => '',
								   'Apellidos' => '',
								   'Orden' => $ordenar);
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
		
	$ordenar = array (	'`ID` ASC' => 'ID Ascendente',
						'`ID` DESC' => 'ID Descendente',
						'`Nombre` ASC' => 'Nombre Ascendente',
						'`Nombre` DESC' => 'Nombre Descendente',
						'`Apellidos` ASC' => 'Apellidos Ascenedente',
						'`Apellidos` DESC' => 'Apellidos Descendente',
						'`Email` ASC' => 'Dirección de Email Ascendente',
						'`Email` DESC' => 'Dirección de Email Descendente',
						'`Tlf1` ASC' => 'Teléfono 1 Ascendente',
						'`Tlf1` DESC' => 'Teléfono 1 Descendente',
						'`Tlf2` ASC' => 'Teléfono 2 Ascendente',
						'`Tlf2` DESC' => 'Teléfono 2 Descendente',
																);
	
			require 'Admin_form_filtro.php';
		
	}
		
/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;

	global $orden; 
	if(isset($_POST['Orden'])){$orden = $_POST['Orden'];}
	else{$orden = "`id` ASC";}
		
	$sqlb =  "SELECT * FROM `admin` ORDER BY $orden ";
 	
	global $qb;
	$qb = mysqli_query($db, $sqlb);

	require 'Admin_while_total.php';
		
	} // Fin Function
		
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

