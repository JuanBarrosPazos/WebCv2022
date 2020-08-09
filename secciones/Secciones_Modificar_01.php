<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'XBPadmin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

								if($_POST['todo']){
										show_form();							
										ver_todo();
									
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

function show_form($errors=''){
	
	if($_POST['oculto']){
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
		
	$ordenar = array (	'`nombre` ASC' => 'Nombre Ascendente',
						'`nombre` DESC' => 'Nombre Descendente',
						'`valor` ASC' => 'Valor Ascenedente',
						'`valor` DESC' => 'Valor Descendente',
						'`id` ASC' => 'ID Ascendente',
						'`id` DESC' => 'ID Descendente',
																);
	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=3 width=100%>
						MODIFICAR SECTORES
					</th>
				</tr>
				
				
				<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
				<tr>
					<td align='center'>
						<input type='submit' value='VER SECTORES' />
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
	
	$sqlb =  "SELECT * FROM `secciones` ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
	print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>.");
									
				} else { print ("<table align='center'>
									<tr>
										<th colspan=4 class='BorderInf'>
									SECTORES ".mysqli_num_rows($qb).".
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											VALOR
										</th>
										
										<th class='BorderInfDch'>
											NOMBRE
										</th>
										
										<th class='BorderInf'>
											&nbsp;
										</th>
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
	if ($rowb['valor'] == ''){}
				
				
	elseif($rowb['valor'] !== ''){	
										
			print (	"<tr align='center'>
									
		<form name='modifica' action='Secciones_Modificar_02.php' method='POST'>
						<td class='BorderInfDch'>
		<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
						</td>
						
						<td class='BorderInfDch' align='left'>
		<input name='valor' type='hidden' value='".$rowb['valor']."' />".$rowb['valor']."
						</td>
							
						<td class='BorderInfDch' align='left'>
		<input name='nombre' type='hidden' value='".$rowb['nombre']."' />".$rowb['nombre']."
						</td>
							
						<td colspan=2 align='center' class='BorderInfDch'>
										<input type='submit' value='MODIFICAR SECTORES' />
										<input type='hidden' name='oculto2' value=1 />
						</td>
			</form>
										
									</tr>");
					
	} /* FIN DEL CONDICIONAL ELSEIF */
	
			} /* Fin del while.*/ 

						print("</table>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final ver_todo(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Secciones.php';
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>