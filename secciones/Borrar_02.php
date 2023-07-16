<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Conections/conexion_bbdd.php';

///////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'XBPadmin'){

 	print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
	
		master_index();
				if (isset($_POST['oculto2'])){ show_form(); } 
				elseif (isset($_POST['borrar'])){ process_form(); } 
				else { show_form(); }
	} else { require '../Admin/Admin_denegado.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;

	global $nombre;
	global $valor;
	$nombre = $_POST['nombre'];
	$valor = $_POST['valor'];
	
	global $tablename;	global $titulo;		global $titmod3;	global $titmod3a;	global $campo;
	if(isset($_POST['modalidad'])){ $tablename = "modalidad";
									$titulo = "DATOS BORRADOS DE MODALIDAD";
									$titmod3 = "INICIO MODALIDAD";
									$titmod3a = "Modalidad_Ver.php";
									$campo = "modalidad";
										}
    else { 	$tablename = "secciones"; 
			$titulo = "DATOS BORRADOS DE SECCION"; 
			$titmod3 = "INICIO SECCION";
			$titmod3a = "Secciones_Ver.php";
			$campo = "sector";
						}

	require 'table_process_form.php';


	/***********	BORRAMOS SECTORES DE TABLA SECCIONES O MODALIDAD		***************/
	
	$sql2c = "DELETE FROM `$db_name`.`$tablename` WHERE `$tablename`.`id` = '$_POST[id]' LIMIT 1 ";

		if(mysqli_query($db, $sql2c)){	print($tabla);
			
			// SI QUIERO BORRAR LOS RESULTADOS DE WEB_CV
			//$sql3c = "DELETE FROM `$db_name`.`web_cv` WHERE `web_cv`.`sector` = '$_POST[valor]' ";
			// SI QUIERO MODIFICAR LOS RESULTADOS DE WEB_CV
			$sql3c = "UPDATE `$db_name`.`web_cv` SET `$campo` = '' WHERE `web_cv`.`$campo` = '$_POST[valor]' ";
			if(mysqli_query($db, $sql3c)){
						} else {
							print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
											}
			// SI QUIERO BORRAR LOS RESULTADOS DE WEB_CV
			//$sql4c = "DELETE FROM `$db_name`.`web_cv` WHERE `web_cv`.`sector2` = '$_POST[valor]' ";
			// SI QUIERO MODIFICAR LOS RESULTADOS DE WEB_CV
			if($campo == "sector"){
					$sql4c = "UPDATE `$db_name`.`web_cv` SET `sector2` = '' WHERE `web_cv`.`sector2` = '$_POST[valor]'";
					if(mysqli_query($db, $sql4c)){
						} else { print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");}
				} else { } // FIN CONDICIONAL SI SECTOR
		} // FIN SI SE CUMPLE EL QUERY
			else { print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
						} // FIN SI NO SE CUMPLE EL QUERY

	} // FIN FUNCTION

//////////////////////////////////////////////////////////////////////////////////////////////
					
function show_form(){
		
	if(isset($_POST['oculto2'])){
		
				$defaults = array ( 'id' => $_POST['id'],
									'valor' => $_POST['valor'],
									'nombre' => $_POST['nombre'],
										);
								   			}
	elseif(isset($_POST['borrar'])){
		
				$defaults = array ( 'id' => $_POST['id'],
									'valor' => $_POST['valor'],
									'nombre' => $_POST['nombre'],
										);
								   			}

	global $titmod;		global $titmod2;	global $titmod3;	global $titmod3a;		global $inputmod;
	if(isset($_POST['modalidad'])){ $titmod = "MODALIDAD";
									$titmod2 = "BORRAR MODALIDAD";
									$titmod3 = "INICIO MODALIDAD";
									$titmod3a = "Modalidad_Ver.php";
									$inputmod = "<input type='hidden' name='modalidad' value=1 />"; }
	else { 	$titmod = "ESPECIALIDAD"; 
			$titmod2 = "BORRAR ESPECIALIDAD";
			$titmod3 = "INICIO ESPECIALIDADES";
			$titmod3a = "Secciones_Ver.php";
			$inputmod = ""; }

	print("<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3 class='BorderInf'>
						<font color='#FF0000'>
							SE BORRARÁ ESTA ".$titmod."
						</br>
						NO SE PODRÁ VOLVER A RECUPERAR
						</font>
					</th>
				</tr>
				<tr>
                    <td align='right' colspan=2 class='BorderInf'>
                        <form name='modifica' action='".$titmod3a."' method='POST'>
                            <input type='hidden' name='todo' value=1 />
                            <input type='submit' value='".$titmod3."' />
                        </form>
                    </td>
				</tr>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td>Id:</td>
				<td>".$defaults['id']."<input  type='hidden' name='id' value='".$defaults['id']."' /></td>
				</tr>
				<tr>
					<td>Valor:</td>
					<td>".$defaults['valor']."<input type='hidden' name='valor' value='".$defaults['valor']."' /></td>
				</tr>
				<tr>
					<td>Nombre:</td>
					<td>".$defaults['nombre']."<input  type='hidden' name='nombre' value='".$defaults['nombre']."' /></td>
				</tr>
				<tr>
					<td align='center' colspan='2' class='BorderSup'>
						<input type='submit' value='BORRAR DATOS PERMANENETEMENTE' />
						<input type='hidden' name='borrar' value=1 />
						".$inputmod."
					</td>
				</tr>
		</form>														
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