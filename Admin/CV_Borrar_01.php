<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."<br/>".mysqli_connect_error());
				}


///////////////////////////////////////////////////////////////////////////////////////////////

if (trim($_SESSION['Nivel']) == 'XBPadmin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

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
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;

	show_form();
		
	$fil = "%".$_POST['sector']."%";
	$orden = $_POST['Orden'];
		
	$sqlc =  "SELECT * FROM `web_cv` WHERE `sector` LIKE '$fil' ORDER BY $orden";
	$qc = mysqli_query($db, $sqlc);
	
	if(!$qc){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."<br/><br/>");
					
			show_form();	
			
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
										<th colspan=8 class='BorderInf'>
										Borrar Datos CV : ".mysqli_num_rows($qc)." Resultados.
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
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
											Coment
										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
				
			print (	"<tr align='center'>
									
		<form name='borra' action='CV_Borrar_02.php' method='POST'>
						<td class='BorderInfDch'>
		<input name='id' type='hidden' value='".$rowc['id']."' />".$rowc['id']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='year' type='hidden' value='".$rowc['year']."' />".$rowc['year']."
						</td>
							
						<td class='BorderInfDch'>
		<input name='horas' type='hidden' value='".$rowc['horas']."' />".$rowc['horas']."
						</td>
						
						<td class='BorderInfDch' width='150px'>
		<input name='sector' type='hidden' value='".$rowc['sector']."' />".$rowc['sector']."
						</td>
													
						<td class='BorderInfDch' width='200px'>
		<input name='titulo' type='hidden' value='".$rowc['titulo']."' />".$rowc['titulo']."
						</td>
						
						<td class='BorderInfDch' align='left' width='400px'>
		<input name='modulos' type='hidden' value='".$rowc['modulos']."' />".$rowc['modulos']."
						</td>
						<td class='BorderInfDch'>
		<input name='academia' type='hidden' value='".$rowc['academia']."' />".$rowc['academia']."
						</td>
						
						<td class='BorderInf' align='left' width='400px'>
		<input name='coment' type='hidden' value='".$rowc['coment']."' />".$rowc['coment']."
						</td>
						
					</tr>
					
					<tr>
						<td colspan=6 class='BorderInf'>
										&nbsp;
						</td>
						<td colspan=2 align='center' class='BorderInf'>
										<input type='submit' value='Borrar Estos Datos' />
										<input type='hidden' name='oculto2' value=1 />
						</td>
										
			</form>
										
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
						'`horas` DESC' => 'Horas Descendente',
						'`horas` ASC' => 'Horas Ascendente',
						'`academia` DESC' => 'Academia Descendente',
						'`academia` ASC' => 'Academia Ascendente',
						'`sector` DESC' => 'Sector Descendente',
						'`sector` ASC' => 'Sector Ascendente',
															);
						
		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='Filtrar Consulta' />
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
			print("<font color='#FF0000'>Se ha producido un error: </font><br/>".mysqli_error($db)."<br/>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
							print ("<table>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>.");
									
							show_form();	

				} else { print ("<table align='center'>
									<tr>
										<th colspan=8 class='BorderInf'>
										Borrar Datos CV : ".mysqli_num_rows($qb)." Resultados.
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
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
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
			print (	"<tr align='center'>
									
				<form name='borra' action='CV_Borrar_02.php' method='POST'>
						<td class='BorderInfDch'>
	<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
								
						</td>
						
						<td class='BorderInfDch'>
	<input name='year' type='hidden' value='".$rowb['year']."' />".$rowb['year']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='horas' type='hidden' value='".$rowb['horas']."' />".$rowb['horas']."
						</td>
						
						<td class='BorderInfDch' width='150px'>
	<input name='sector' type='hidden' value='".$rowb['sector']."' />".$rowb['sector']."
						</td>	
												
						<td class='BorderInfDch' width='200px'>
	<input name='titulo' type='hidden' value='".$rowb['titulo']."' />".$rowb['titulo']."
						</td>
						
						<td class='BorderInfDch' align='left' width='400px'>
	<input name='modulos' type='hidden' value='".$rowb['modulos']."' />".$rowb['modulos']."
						</td>
						
						<td class='BorderInfDch'>
	<input name='academia' type='hidden' value='".$rowb['academia']."' />".$rowb['academia']."
						</td>
						
						<td class='BorderInf' align='left' width='400px'>
	<input name='coment' type='hidden' value='".$rowb['coment']."' />".$rowb['coment']."
						</td>
						
										</tr>
										<tr>
											<td colspan=6 class='BorderInf'>
												&nbsp;
											</td>
											<td colspan=2 align='center' class='BorderInf'>
													<input type='submit' value='BORRAR DATOS' />
													<input type='hidden' name='oculto2' value=1 />
											</td>
										
										</form>
										
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
			print("<font color='#FF0000'>Se ha producido un error: </font><br/>".mysqli_error($db)."<br/>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
							print ("<table>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>.");
									
							show_form();	

				} else { print ("<table align='center'>
									<tr>
										<th colspan=8 class='BorderInf'>
										Borrar Datos CV : ".mysqli_num_rows($qb)." Resultados.
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
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
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
			print (	"<tr align='center'>
									
				<form name='borra' action='CV_Borrar_02.php' method='POST'>
						<td class='BorderInfDch'>
	<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
								
						</td>
						
						<td class='BorderInfDch'>
	<input name='year' type='hidden' value='".$rowb['year']."' />".$rowb['year']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='horas' type='hidden' value='".$rowb['horas']."' />".$rowb['horas']."
						</td>
						
						<td class='BorderInfDch' width='150x'>
	<input name='sector' type='hidden' value='".$rowb['sector']."' />".$rowb['sector']."
						</td>	
												
						<td class='BorderInfDch' width='200px'>
	<input name='titulo' type='hidden' value='".$rowb['titulo']."' />".$rowb['titulo']."
						</td>
						
						<td class='BorderInfDch' align='left' width='400px'>
	<input name='modulos' type='hidden' value='".$rowb['modulos']."' />".$rowb['modulos']."
						</td>
						
						<td class='BorderInfDch'>
	<input name='academia' type='hidden' value='".$rowb['academia']."' />".$rowb['academia']."
						</td>
						
						<td class='BorderInf' align='left' width='400px'>
	<input name='coment' type='hidden' value='".$rowb['coment']."' />".$rowb['coment']."
						</td>
						
										</tr>
										<tr>
											<td colspan=6 class='BorderInf'>
												&nbsp;
											</td>
											<td colspan=2 align='center' class='BorderInf'>
												<input type='submit' value='BORRAR DATOS' />
													<input type='hidden' name='oculto2' value=1 />
											</td>
										
										</form>
										
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
