<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Conections/conexion_bbdd.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (trim($_SESSION['Nivel']) == 'XBPadmin'){
	
	print("<div style='margin-left:110px'>
			Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']."."); 
			master_index();
	print("</div>");
		if(isset($_POST['todo'])){	show_form();							
									ver_todo();
				}elseif(isset($_POST['oculto'])){ process_form();
					} else {	show_form();
								ver_todo_1();			
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
		
/////////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
		
	global $db;
	global $db_name;
		
show_form();
	
	$fil = "%".$_POST['sector']."%";

	global $orden; 
	if(isset($_POST['Orden'])){$orden = $_POST['Orden'];}
	else{$orden = "`id` ASC";}
		

	$sqlb =  "SELECT * FROM `web_cv` WHERE `sector` LIKE '$fil' OR `sector2` LIKE '$fil' ORDER BY $orden";
 	
	$qb = mysqli_query($db, $sqlb);
	
	if($_POST["sector"] == ''){
	
		$_sec = 'TODOS LOS DATOS DEL CV';}
		
	else{$_sec = 'SECCION '.strtoupper($_POST['sector']);}
	
	if(!$qb){
			print("</br> <font color='#FF0000'>Se ha producido un error: </form>".mysqli_error($db)."<br/>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
											print ("<table align='center'>
											<tr>
											<td>
											NO HAY DATOS.
											</td>
											<tr>
											</table>
											</br></br>");

				} else { 	
				
	$file_img = "img/new_img.txt";
	$fw_img = fopen($file_img, 'r+');
	$fget_img = fgets($fw_img);
	$fget_img = trim($fget_img);
	fclose($fw_img);
	$_SESSION['img_img'] = $fget_img;
	
		print("<div id=\"foto\">
					<img src=\"img/".$fget_img."\"  width='110' height='158' alt='Juan Barros Pazos' /> 
				</div>
					<table align='center'>
						<tr>
							<td colspan=5 class='BorderInf'></td>
							<td colspan=2 class='BorderInf'>
								<form name='modifica' action='CV_Crear.php' method='POST'>
									<input type='submit' value='CREAR NUEVA ENTRADA EN EL CV' />
								</form>
							</td>
						</tr>
						<tr>
							<th colspan=7 class='BorderInf'>".$_sec."</th>
						</tr>
						<tr>
							<th class='BorderInfDch'>Year</th>
							<th class='BorderInfDch'>Horas</th>
							<th class='BorderInfDch'>Modalidad</th>
							<th class='BorderInfDch'>Titulo</th>
							<th class='BorderInfDch'>Modulos</th>
							<th class='BorderInfDch'>Academia</th>
							<th class='BorderInf'>Comentarios</th>
						</tr>");
			while($rowc = mysqli_fetch_row($qb)){

				print (	"<tr align='center'>
							<td class='BorderInfDch'>".$rowc[1]."</td>
							<td class='BorderInfDch'>".$rowc[2]."</td>
							<td class='BorderInfDch' width='150px' align='left'>".ucwords($rowc[5])."</td>
							<td class='BorderInfDch' width='200px' align='left'>".$rowc[6]."</td>
							<td class='BorderInfDch' align='left' width='400px'>".$rowc[7]."</td>
							<td class='BorderInfDch'>".$rowc[8]."</td>
							<td class='BorderInf' align='left' width='400px'>".$rowc[9]."</td>
						</tr>");
					} // FIN WHILE
			print("</table>");
					} // FIN ELSE
			} // FIN ELSE
		
	} // FIN FUNCTION

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		}
	elseif(isset($_POST['todo'])){
		$defaults = $_POST;
		} else {global $filtrar; global $ordenar;
				$defaults = array ('sector' => $filtrar,
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
	
	$ordenar = array (	'`year` DESC' => 'Year Descendente',
						'`year` ASC' => 'Year Ascendente',
						'`modalidad` DESC' => 'Modalidad Descendente',
						'`modalidad` ASC' => 'Modalidad Ascendente',
						'`horas` DESC' => 'Horas Descendente',
						'`horas` ASC' => 'Horas Ascendente',
						'`academia` DESC' => 'Academia Descendente',
						'`academia` ASC' => 'Academia Ascendente',
															);
						
		require 'CV_form_filtro.php';
		
	}	
		
/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	
	global $orden;
	if(isset($_POST['Orden'])){$orden = $_POST['Orden'];}
	else{$orden = "`id` ASC";}
		
	$sqlb =  "SELECT * FROM `web_cv` ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
			print("</br> <font color='#FF0000'>Se ha producido un error: </form>".mysqli_error($db)."<br/>");
		} else {
			if(mysqli_num_rows($qb)== 0){ print ("No hay datos.");
				} else { print ("<table align='center'>
									<tr>
										<td colspan=6 class='BorderInf'></td>
										<td colspan=2 class='BorderInf'>
											<form name='modifica' action='CV_Crear.php' method='POST'>
												<input type='submit' value='CREAR NUEVA ENTRADA EN EL CV' />
											</form>
										</td>
									</tr>
									<tr>
										<th colspan=8  class='BorderInf'>FORMACIÓN Y EXPERIENCIA</th>
									</tr>
									<tr>
										<th class='BorderInfDch'>Year</th>
										<th class='BorderInfDch'>Horas</th>
										<th class='BorderInfDch'>Especialidad</th>
										<th class='BorderInfDch'>Titulo</th>
										<th class='BorderInfDch'>Modulos</th>
										<th class='BorderInfDch'>Academia</th>
										<th class='BorderInf'>Comentarios</th>
										<th class='BorderInf'>Acciones</th>
									</tr>");
			while($rowc = mysqli_fetch_assoc($qb)){
				print (	"<tr align='center'>
								<td class='BorderInfDch'>".$rowc['id']."</td>
								<td class='BorderInfDch'>".$rowc['horas']."</td>
								<td class='BorderInfDch' width='150px'>".ucwords($rowc['sector'])."</td>
								<td class='BorderInfDch' width='200px'>".$rowc['titulo']."</td>
								<td class='BorderInfDch' align='left' width='400px'>".$rowc['modulos']."</td>
								<td class='BorderInfDch'>".$rowc['academia']."</td>
								<td class='BorderInfDch' align='left' width='400px'>".$rowc['coment']."</td>
							<td class='BorderInf' align='left' width='400px'>
								<form name='modifica' action='CV_Modificar_02.php' method='POST'>
							");
					require 'CV_row_total.php';
				print("		<input type='submit' value='MODIFICAR DATOS' />
							<input type='hidden' name='oculto2' value=1 />
						</form>
						<form name='borra' action='CV_Borrar_02.php' method='POST'>
							");
					require 'CV_row_total.php';
				print("		<input type='submit' value='Borrar Estos Datos' />
							<input type='hidden' name='oculto2' value=1 />
						</form>
							</td>
						</tr>");
				} // FIN WHILE
			print("</table>");
			} // FIN ELSE 
		} // FIN ELSE
		
	} // FIN FUNCTION
		
/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo_1(){
		
	global $db;
		
	$sqlb =  "SELECT * FROM `web_cv` ORDER BY `sector`";
 	
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
			print("</br> <font color='#FF0000'>Se ha producido un error: </form>".mysqli_error($db)."<br/>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
					print ("<table align='center'><tr><td>NO HAY DATOS</td><tr></table></br></br>");

				} else { print ("<table align='center'>
									<tr>
										<td colspan=6 class='BorderInf'></td>
										<td colspan=2 class='BorderInf'>
											<form name='modifica' action='CV_Crear.php' method='POST'>
												<input type='submit' value='CREAR NUEVA ENTRADA EN EL CV' />
											</form>
										</td>
									</tr>
									<tr>
									<th colspan=7 class='BorderInfDch'>
											FORMACIÓN Y EXPERIENCIA
									</th>
									<th class='BorderInf'>
			<a href=\"https://drive.google.com/file/d/1Qll9AtM9HuDRi0pVZz5r57xBXoNphDsX/view\" target=\"_blank\">Descargar Cv Pdf</a>
									</th>
									</tr>
										<th class='BorderInfDch'>Year</th>
										<th class='BorderInfDch'>Horas</th>
										<th class='BorderInfDch'>Especialidad</th>
										<th class='BorderInfDch'>Titulo</th>
										<th class='BorderInfDch'>Modulos</th>
										<th class='BorderInfDch'>Academia</th>
										<th class='BorderInfDch'>Comentarios</th>
										<th class='BorderInf'>Acciones</th>
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qb)){
					print (	"<tr align='center'>
								<td class='BorderInfDch'>".$rowc['id']."</td>
								<td class='BorderInfDch'>".$rowc['horas']."</td>
								<td class='BorderInfDch' width='150px'>".ucwords($rowc['sector'])."</td>
								<td class='BorderInfDch' width='200px'>".$rowc['titulo']."</td>
								<td class='BorderInfDch' align='left' width='400px'>".$rowc['modulos']."</td>
								<td class='BorderInfDch'>".$rowc['academia']."</td>
								<td class='BorderInfDch' align='left' width='400px'>".$rowc['coment']."</td>
								<td class='BorderInf' align='left' width='400px'>
								<form name='modifica' action='CV_Modificar_02.php' method='POST'>
							");
					require 'CV_row_total.php';

				print("		<input type='submit' value='MODIFICAR DATOS' />
							<input type='hidden' name='oculto2' value=1 />
						</form>
						<form name='borra' action='CV_Borrar_02.php' method='POST'>
							");
					require 'CV_row_total.php';

				print("		<input type='submit' value='BORRAR DATOS' />
							<input type='hidden' name='oculto2' value=1 />
						</form>
							</td>

								</tr>");
						} 
			print("</table>");
						} // FIN ELSE
			} // FIN ELSE
	
	} // FIN FUNCTION

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

