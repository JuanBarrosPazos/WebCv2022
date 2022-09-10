<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require 'Admin_select_rowd.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (trim($_SESSION['Nivel']) == 'XBPadmin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

						if(isset($_POST['oculto'])){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											}
							
							} else {
										show_form();
								}
				} else { require 'Admin_denegado.php'; } 

if(@$_POST['cerrar']){ 
	
	unset($_SESSION['id']);
	unset($_SESSION['horas']);
	unset($_SESSION['sector']);
	unset($_SESSION['sector2']);
	unset($_SESSION['titulo']);
	unset($_SESSION['modulos']);
	unset($_SESSION['academia']);
	unset($_SESSION['coment']);
	
	print("Se ha cerrado la sesión.<br/><br/>");
		}

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;

	require 'CV_Validate.php';

		return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	
	$tabla = "<table align='center' style='margin-top:10px' width='50%'>
				<tr>
					<th colspan=2 class='BorderInf'>
						Se han grabado los siguientes datos.
					</th>
				</tr>
				<tr>
					<td>Year</td>
					<td>".$_POST['year']."</td>
				</tr>				
				<tr>
					<td>Horas</td>
					<td>".$_POST['horas']."</td>
				</tr>
				<tr>
					<td>Especialidad 1</td>
					<td>".$_POST['sector']."</td>
				</tr>
				<tr>
					<td>Especialidad 2</td>
					<td>".$_POST['sector2']."</td>
				</tr>
				<tr>
					<td>Modalidad</td>
					<td>".$_POST['modalidad']."</td>
				</tr>
				<tr>
					<td>Titulo</td>
					<td>".$_POST['titulo']."</td>
				</tr>
				<tr>
					<td>M&oacute;dulos</td>
					<td>".$_POST['modulos']."</td>
				</tr>
				<tr>
					<td>Academia</td>
					<td>".$_POST['academia']."</td>
				</tr>
				<tr>
					<td>Comentarios</td>
					<td>".$_POST['coment']."</td>
				</tr>
				<tr>
					<td align='right' colspan=2 ><a href='CV_Ver.php'>INICIO GESTIÓN CV</a></td>
				</tr>
			</table>"; 
		
	global $db_name;

	$sql = "INSERT INTO `$db_name`.`web_cv` (`year`, `horas`,`sector`, `sector2`, `modalidad`, `titulo`, `modulos`, `academia`, `coment`) VALUES ('$_POST[year]', '$_POST[horas]', '$_POST[sector]',  '$_POST[sector2]',  '$_POST[modalidad]', '$_POST[titulo]', '$_POST[modulos]', '$_POST[academia]', '$_POST[coment]')";
		
	if(mysqli_query($db, $sql)){
			print( $tabla );
				} else {
				print("<br/>
				<font color='#FF0000'>
	* DATOS NO VALIDOS: </font><br/> ".mysqli_error($db))."
				<br/>";
				show_form ();
				
					}
		
			}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'year' => '',
									'horas' => '',
									'sector' => @$_POST['sector'],
									'sector2' => @$_POST['sector2'],
									'modalidad' => @$_POST['modalidad'],
									'titulo' => '',
									'modulos' => '',
									'academia' => '',
									'coment' => '');
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
		
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							Introduzca los datos
					</th>
				</tr>
				
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						Year
					</td>
					<td width=360px>
		<input type='text' name='year' size=12 maxlength=12 value='".$defaults['year']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Horas
					</td>
					<td>
			<input type='text' name='horas' size=7 maxlength=7 value='".$defaults['horas']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Especialidad 1
					</td>
					<td>
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
						
	print ("</select>
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Especialidad 2
					</td>
					<td>
<select name='sector2'>");

	global $db;
	$sqlb2 =  "SELECT * FROM `secciones` ORDER BY `valor` ASC ";
	$qb2 = mysqli_query($db, $sqlb2);
	if(!$qb2){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows2 = mysqli_fetch_assoc($qb2)){
					
					print ("<option value='".$rows2['valor']."' ");
					
					if($rows2['valor'] == $defaults['sector2']){
															print ("selected = 'selected'");
																								}
													print ("> ".$rows2['nombre']." </option>");
												}
											}
						
	print ("</select>
					</td>
				</tr>	
				
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Modalidad
					</td>
					<td>
<select name='modalidad'>");

	global $db;
	$sqlm =  "SELECT * FROM `modalidad` ORDER BY `valor` ASC ";
	$qbm = mysqli_query($db, $sqlm);
	if(!$qbm){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rowm = mysqli_fetch_assoc($qbm)){
					
					print ("<option value='".$rowm['valor']."' ");
					
					if($rowm['valor'] == $defaults['modalidad']){
															print ("selected = 'selected'");
																								}
													print ("> ".$rowm['nombre']." </option>");
												}	
											}
	print ("</select>
					</td>
				</tr>	
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Titulo
					</td>
					
					
					<td>
					
		<textarea cols='35' rows='2'  onkeypress='return limitat(event, 50);' onkeyup='actualizaInfot(50)' name='titulo' id='titulo'>".$defaults['titulo']."</textarea>
			    
			</br>
				
				<div id='infot' align='center' style='color:#0080C0;'>
        					Maximum 50 characters            
				</div>

					</td>
				</tr>
				
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						M&oacute;dulos
					</td>
					
					
					<td>
					
	<textarea cols='35' rows='10' onkeypress='return limita(event, 300);' onkeyup='actualizaInfo(300)' name='modulos' id='modulos'>".$defaults['modulos']."</textarea>
	
			</br>
	            <div id='infom' align='center' style='color:#0080C0;'>
        					Maximum 300 characters            
				</div>

					</td>
					
				</tr>
				
				
				<tr>
					<td>
						- Academia
					</td>
					<td>
					
		<textarea cols='35' rows='2'  onkeypress='return limitaa(event, 50);' onkeyup='actualizaInfoa(50)' name='academia' id='academia'>".$defaults['academia']."</textarea>
			    
			</br>
				
				<div id='infoa' align='center' style='color:#0080C0;'>
        					Maximum 50 characters            
				</div>

					</td>
				</tr>
				
				<tr>
				<tr>
					<td>
						- Comentarios
					</td>
					<td>
					
	<textarea cols='35' rows='10' onkeypress='return limitac(event, 300);' onkeyup='actualizaInfoc(300)' name='coment' id='coment'>".$defaults['coment']."</textarea>
	
			</br>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 300 characters            
				</div>

					</td>
				</tr>
								
				<tr>
					<td colspan='2'  align='right' 'valign='middle'  class='BorderSup'>
						<input type='submit' value='GRABAR ESTOS DATOS' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				
				");
				
	}

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
