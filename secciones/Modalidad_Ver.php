<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Conections/conexion_bbdd.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'XBPadmin'){

 	print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
		master_index();
			if(isset($_POST['todo'])){	show_form();							
										ver_todo();
						} else { show_form();}
				} else { require '../Admin/Admin_denegado.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if(isset($_POST['todo'])){ $defaults = $_POST; } 
	
	$ordenar = array (	'`nombre` ASC' => 'Nombre Ascendente',
						'`nombre` DESC' => 'Nombre Descendente',
						'`valor` ASC' => 'Valor Ascenedente',
						'`valor` DESC' => 'Valor Descendente',
						'`id` ASC' => 'ID Ascendente',
						'`id` DESC' => 'ID Descendente',
							);

	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=3 width=100%>VER MODALIDADES</th>
				</tr>
			<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
				<tr>
					<td align='center'>
						<input type='submit' value='VER MODALIDADES' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td>Ordenar Por: </td>
					<td>
						<select name='Orden'>");
							foreach($ordenar as $option => $label){
								print ("<option value='".$option."' ");
								if($option == @$defaults['Orden']){	print ("selected = 'selected'");}
																	print ("> $label </option>");
															}	
				print ("</select>
						</td>
					</tr>
						</form>														
					</table>"); 
		
			}	// FIN FUNCTION

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;

	global $orden;
	if(isset($_POST['Orden'])){$orden = $_POST['Orden'];}
	else{$orden = "`id` ASC";}
	
	$sqlb =  "SELECT * FROM `modalidad` ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
		} else {
			if(mysqli_num_rows($qb)== 0){
					print ("<table align='center'>
								<tr>
									<td>
										<font color='#FF0000'>NO HAY DATOS</font>
									</td>
								</tr>
							</table>.");

			} else { $nunrows = (mysqli_num_rows($qb) - 1);
						print ("<table align='center'>
								<tr>
									<td colspan=4 class='BorderInf'></td>
									<td class='BorderInf'>
										<form name='modifica' action='Crear.php' method='POST'>
											<input type='submit' value='CREAR NUEVA MODALIDAD' />
											<input type='hidden' name='modalidad' value=1 />
											</form>
									</td>
								</tr>
								<tr>
									<th colspan=5 class='BorderInf'>MODALIDADES : ".$nunrows."</th>
								</tr>
								<tr>
									<th class='BorderInfDch'>ID</th>
									<th class='BorderInfDch'>VALOR</th>
									<th class='BorderInfDch'>NOMBRE</th>
									<th colspan=2 class='BorderInf'>ACCIONES</th>
								</tr>");
			
		while($rowb = mysqli_fetch_assoc($qb)){
 			
			if ($rowb['valor'] == ''){}
			elseif($rowb['valor'] != ''){	
												
					print (	"<tr align='center'>
								<form name='modifica' action='Modificar_02.php' method='POST'>				
								<td class='BorderInfDch'>".$rowb['id']."</td>
								<td class='BorderInfDch' align='left'>".$rowb['valor']."</td>
								<td class='BorderInfDch' align='left'>".$rowb['nombre']."</td>");

							require 'CV_row_total.php';

						print("	<td class='BorderInf' align='left'>
									<input type='submit' value='MODIFICAR MODALIDAD' />
									<input type='hidden' name='oculto2' value=1 />
									<input type='hidden' name='modalidad' value=1 />
									</td>
								</form>
							<form name='modifica' action='Borrar_02.php' method='POST'>	
								");

							require 'CV_row_total.php';

						print("<td class='BorderInf' align='left'>
									<input type='submit' value='BORRAR MODALIDAD' />
									<input type='hidden' name='oculto2' value=1 />
									<input type='hidden' name='modalidad' value=1 />
									</td>
							</form>
								</tr>");
			} /* FIN DEL CONDICIONAL ELSEIF*/
				} /* Fin del while.*/ 
						print("</table>");
						} /* Fin segundo else anidado en if */
			} /* Fin de primer else . */

		}	/* Final ver_todo(); */

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