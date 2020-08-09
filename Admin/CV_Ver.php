<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';
		
	global $db;
	global $db_name;

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."<br/>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////////////

if (trim($_SESSION['Nivel']) == 'XBPadmin'){
	
					print("<div style='margin-left:110px'>
					Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']."."); 
					master_index();
					print("</div>");
					
					if($_POST['todo']){
										show_form();							
										ver_todo();
							}

							elseif($_POST['oculto']){
								
												process_form();
								
								} else {
										show_form();
										ver_todo_1();			
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
	$orden = $_POST['Orden'];

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
	
		print("
		
		<div id=\"foto\">
 <img src=\"img/".$fget_img."\"  width='110' height='158' alt='Juan Barros Pazos' /> 
		</div>
							
							<table align='center'>
									<tr>
										<th colspan=7 class='BorderInf'>
												".$_sec."
										</th>
									</tr>
									
										<th class='BorderInfDch'>
											Year
										</th>
										
										<th class='BorderInfDch'>
											Horas
										</th>
										
										<th class='BorderInfDch'>
											Modalidad
										</th>
										
										<th class='BorderInfDch'>
											Titulo
										</th>
										
										<th class='BorderInfDch'>
											Modulos
										</th>
										
										<th class='BorderInfDch'>
											Academia
										</th>
										
										<th class='BorderInf'>
											Comentarios
										</th>
																				
									</tr>");
			
			while($rowb = mysqli_fetch_row($qb)){

						print (	"<tr align='center'>
							<td class='BorderInfDch'>
										".$rowb[1]."
							</td>
																
							<td class='BorderInfDch'>
										".$rowb[2]."
							</td>
																	
							<td class='BorderInfDch' width='150px' align='left'>
										".ucwords($rowb[5])."
							</td>
																
							<td class='BorderInfDch' width='200px' align='left'>
										".$rowb[6]."
							</td>
																						
							<td class='BorderInfDch' align='left' width='400px'>
										".$rowb[7]."
							</td>
																				
							<td class='BorderInfDch'>
										".$rowb[8]."
							</td>
													
							<td class='BorderInf' align='left' width='400px'>
										".$rowb[9]."
							</td>
																										
						</tr>");
					
					} 

			print("</table>");

					} 

			} 
		
	}


//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
	
	if($_POST['oculto']){
		$defaults = $_POST;
		}
	elseif($_POST['todo']){
		$defaults = $_POST;
		} else {
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
						
	$file_img = "img/new_img.txt";
	$fw_img = fopen($file_img, 'r+');
	$fget_img = fgets($fw_img);
	$fget_img = trim($fget_img);
	fclose($fw_img);
	$_SESSION['img_img'] = $fget_img;
	
		print("
		
		<div id=\"foto\">
 <img src=\"img/".$fget_img."\"  width='110' height='158' alt='Juan Barros Pazos' /> 
		</div>

			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='FILTRAR CONSULTA' />
						<input type='hidden' name='oculto' value=1 />
					</td>
					<td align='left'>

	<select name='sector'>");
				
	global $db;
	$sqlb =  "SELECT * FROM `secciones` ORDER BY `valor` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['valor']."' ");
					
					if($rows['valor'] == $defaults['sector']){
															print ("selected = 'selected'");
																								}
													print ("> ".$rows['nombre']." </option>");
												}
											} 
						
	print ("	</select>
					</td>

					<td align='left'>

						<select name='Orden'>");

						
				foreach($ordenar as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['Orden']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("	</select>
					</td>
				</tr>
	
				
		</form>	
		
			
			</table>				
				");
	
	}	
		
/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	
	$orden = $_POST['Orden'];
		
	$sqlb =  "SELECT * FROM `web_cv` ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
			print("</br> <font color='#FF0000'>Se ha producido un error: </form>".mysqli_error($db)."<br/>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
											print ("No hay datos.");

				} else { print ("<table align='center'>
									<tr>
										<th colspan=7  class='BorderInf'>
												FORMACIÓN Y EXPERIENCIA
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											Year
										</th>
										
										<th class='BorderInfDch'>
											Horas
										</th>
										
										<th class='BorderInfDch'>
											Sector
										</th>
										
										<th class='BorderInfDch'>
											Titulo
										</th>
										
										<th class='BorderInfDch'>
											Modulos
										</th>
										
										<th class='BorderInfDch'>
											Academia
										</th>
										
										<th class='BorderInf'>
											Comentarios
										</th>
																				
									</tr>");
			
			while($rowb = mysqli_fetch_row($qb)){
 			
										print (	"<tr align='center'>
													<td class='BorderInfDch'>
															".$rowb[1]."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[2]."
													</td>
														
													<td class='BorderInfDch' width='150px'>
															".ucwords($rowb[3])."
													</td>
													
													<td class='BorderInfDch' width='200px'>
															".$rowb[6]."
													</td>
																			
											<td class='BorderInfDch' align='left' width='400px'>
															".$rowb[7]."
													</td>
																				
													<td class='BorderInfDch' align='left'>
															".$rowb[8]."
													</td>
													
											<td class='BorderInf' align='left' width='400px'>
															".$rowb[9]."
													</td>
													
												</tr>");
					
										} 

						print("</table>");
			
						} 
		
			} 
		
	} 
		
/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo_1(){
		
	global $db;
		
	$sqlb =  "SELECT * FROM `web_cv` ORDER BY `sector`";
 	
	$qb = mysqli_query($db, $sqlb);
	
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

				} else { print ("<table align='center'>
									<tr>
										<th colspan=6 class='BorderInfDch'>
												FORMACIÓN Y EXPERIENCIA
										</th>
										<th class='BorderInf'>
<a href=\"https://dl.dropboxusercontent.com/u/74163769/Juan_Barros_CV.pdf\" target=\"_blank\">
Descargar Cv.Pdf</a>
										</th>
									</tr>
									
										<th class='BorderInfDch'>
											Year
										</th>
										
										<th class='BorderInfDch'>
											Horas
										</th>
										
										<th class='BorderInfDch'>
											Sector
										</th>
										
										<th class='BorderInfDch'>
											Titulo
										</th>
										
										<th class='BorderInfDch'>
											Modulos
										</th>
										
										<th class='BorderInfDch'>
											Academia
										</th>
										
										<th class='BorderInf'>
											Comentarios
										</th>
																				
									</tr>");
			
			while($rowb = mysqli_fetch_row($qb)){
				
										print (	"<tr align='center'>
													<td class='BorderInfDch'>
															".$rowb[1]."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[2]."
													</td>
														
													<td class='BorderInfDch' width='150px'>
															".ucwords($rowb[3])."
													</td>
													
													<td class='BorderInfDch' width='200px'>
															".$rowb[6]."
													</td>
																			
											<td class='BorderInfDch' align='left' width='400px'>
															".$rowb[7]."
													</td>
																				
													<td class='BorderInfDch'>
															".$rowb[8]."
													</td>
													
											<td class='BorderInf' align='left' width='400px'>
															".$rowb[9]."
													</td>
																										
												</tr>");
					
										} 

						print("</table>");
			
						} 

			} 
	
	} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Admin.php';

				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	require '../Inclu/Admin_Inclu_02.php';
		
?>

