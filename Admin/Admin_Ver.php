<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';
		
	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."<br/>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////////////

if (trim($_SESSION['Nivel']) == 'XBPadmin'){
	
					print("Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
					
					master_index();
					
					if($_POST['todo']){
										show_form();							
										ver_todo();
							}
							
							elseif($_POST['oculto']){
								
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

function validate_form(){
	
	$errors = array();
	
	if (strlen(trim($_POST['Nombre'])) == 0){
		$errors [] = "Nombre: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
		
	elseif (!preg_match('/^\b[^0-9@#$%&<>]+$/',$_POST['Nombre'])){
		$errors [] = "Nombre: <font color='#FF0000'>Solo se admite texto.</font>";
		}

	if (strlen(trim($_POST['Apellidos'])) == 0){
		$errors [] = "Apellidos: <font color='#FF0000'>Este campo es obligatorio</font>";
		}
		
	elseif (!preg_match('/^\b[^0-9@#$%&<>]+$/',$_POST['Apellidos'])){
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
	$orden = $_POST['Orden'];
		
	$sqlc =  "SELECT * FROM `admin` WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape' ORDER BY $orden ";
 	
	$qc = mysqli_query($db, $sqlc);
	
	if(!$qc){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."<br/><br/>");
			
		} else {
			
			if(mysqli_num_rows($qc)== 0){
							print ("<table align='center' style=\"border:0px\">
										<tr>
											<td align='center'>
												<font color='#FF0000'>
														NINGÚN DATO SE CIÑE A ESTOS CRITERIOS.
													<br/>
														INTENTELO CON OTROS PARÁMETROS.
												</font>
											</td>
										</tr>
									</table>");
									
				} else { print ("<table align='center'>
									<tr>
										<th colspan=12 class='BorderInf'>
							Administradores con estos criterios : ".mysqli_num_rows($qc)." Resultados.
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										<th class='BorderInfDch'>
											Nombre
										</th>
										
										<th class='BorderInfDch'>
											Apellidos
										</th>
										
										<th class='BorderInfDch'>
											Tipo Documento
										</th>
										
										<th class='BorderInfDch'>
											N&uacute;mero
										</th>
										
										<th class='BorderInfDch'>
											Control
										</th>
										
										<th class='BorderInfDch'>
											Email
										</th>
										
										<th class='BorderInfDch'>
											Usuario
										</th>
										
										<th class='BorderInfDch'>
											Password
										</th>
										
										<th class='BorderInfDch'>
											Dirección
										</th>
										
										<th class='BorderInfDch'>
											Teléfono 1
										</th>
										
										<th class='BorderInf'>
											Teléfono 2
										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
				
			print (	"<tr align='center'>
									
						<td class='BorderInfDch'>
							".$rowc['ID']."
						</td>
						
						<td class='BorderInfDch'>
							".$rowc['Nombre']."
						</td>
							
						<td class='BorderInfDch'>
							".$rowc['Apellidos']."
						</td>
						
						<td class='BorderInfDch'>
							".$rowc['doc']."
						</td>
						
						<td class='BorderInfDch'>
							".$rowc['dni']."
						</td>
						
						<td class='BorderInfDch'>
							".$rowc['ldni']."
						</td>
						
						<td class='BorderInfDch'>
							".$rowc['Email']."
						</td>
													
						<td class='BorderInfDch'>
							".$rowc['Usuario']."
						</td>
						
						<td class='BorderInfDch'>
							".$rowc['Password']."
						</td>
						
						<td class='BorderInfDch'>
							".$rowc['Direccion']."
						</td>
						
						<td class='BorderInfDch'>
							".$rowc['Tlf1']."
						</td>
						
						<td class='BorderInf'>
							".$rowc['Tlf2']."
						</td>
						
					</tr>
					
					");
								}  

						print("</table>");
			
						} 

			} 
		
	}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if($_POST['oculto']){
		$defaults = $_POST;
		}
	elseif($_POST['todo']){
		$defaults = $_POST;
		} else {
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
	
	print("
			<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=3 width=100%>
						Busqueda de Administradores.
					</th>
				</tr>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='Realizar Consulta' />
						<input type='hidden' name='oculto' value=1 />
					</td>
					<td>	
						Nombre:
					</td>
					<td>
	<input type='text' name='Nombre' size=20 maxlenth=10 value='".$defaults['Nombre']."' />
					</td>
				</tr>
	
				<tr>
					<td>
					</td>
					<td>	
						Apellido:
					</td>
					<td>
	<input type='text' name='Apellidos' size=20 maxlenth=10 value='".$defaults['Apellidos']."' />
					</td>
				</tr>
	
				<tr>
					<td>
					</td>
					<td>	
						Ordenar Por:
					</td>
					<td>

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
		
		<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
				<tr>
					<td align='center'>
						<input type='submit' value='Ver Todos los Administradores' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td>	
						Ordenar Por:
					</td>
					<td>

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

	$sqlb =  "SELECT * FROM `admin` ORDER BY $orden ";
 	
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </form><br/>".mysqli_error($db)."<br/>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
							print ("No hay datos.");
							show_form();	

				} else { print ("<table align='center'>
									<tr>
										<th colspan=12 class='BorderInf'>
												Todos los Administradores de Tutoriales.
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											Nombre
										</th>
										
										<th class='BorderInfDch'>
											Apellidos
										</th>
										
										<th class='BorderInfDch'>
											DNI/NIE
										</th>
										
										<th class='BorderInfDch'>
											N&uacute;mero
										</th>
										
										<th class='BorderInfDch'>
											Control
										</th>
										
										<th class='BorderInfDch'>
											Email
										</th>
										
										<th class='BorderInfDch'>
											Usuario
										</th>
										
										<th class='BorderInfDch'>
											Password
										</th>
										
										<th class='BorderInfDch'>
											Dirección
										</th>
										
										<th class='BorderInfDch'>
											Teléfono 1
										</th>
										
										<th class='BorderInf'>
											Teléfono 2
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_row($qb)){
 			
										print (	"<tr align='center'>
													<td class='BorderInfDch'>
															".$rowb[0]."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[2]."
													</td>
														
													<td class='BorderInfDch'>
															".$rowb[3]."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[4]."
													</td>
																			
													<td class='BorderInfDch'>
															".$rowb[5]."
													</td>
																				
													<td class='BorderInfDch'>
															".$rowb[6]."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[7]."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[8]."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[9]."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[10]."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[11]."
													</td>
													
													<td class='BorderInf'>
															".$rowb[12]."
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

