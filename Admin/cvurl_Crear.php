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

				if($_POST['oculto']){	process_form();

							} else {
										show_form();
								}
				}else { print("<table align='center' style=\"margin-top:200px;margin-bottom:200px\">
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

function process_form(){
	
	
	global $url;
	$url = $_POST['url'];
	$url = trim($_POST['url']);
	if($url == ''){	$url = '#';}
	else{$url = $url;}

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						NUEVA URL EXTERNA DEL CV EN PDF
					</th>
				</tr>
												
				<tr>
					<td>"
						.$url.
					"</td>
				</tr>
				
				<tr>
					<td align='center'>
						<a href='cvurl_Crear.php'>VOLVER A MODIFICAR LA URL</a>
					</td>
				</tr>

			</table>
				
		";	
		
		/////////////

	$logtext = $url;
	$filename = "../Inclu/cvurl.php";
	$log = fopen($filename, 'w+');
	fwrite($log, $logtext);
	fclose($log);
	print ($tabla);
					
}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array (	'url' => $_POST['url'],	
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
		
////////////////////

	$ruta = "../Inclu/";
	global $docurl;
	$docurl = $ruta."cvurl.php";
	global $cvurl;
	$cvurl = file_get_contents($docurl);
	//print("* ".$cvurl);

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>
								CREAR / MODIFICAR URL EXTERNA DEL CV EN PDF					
					</th>
				</tr>
				<tr>
					<td class='BorderInf'>
								URL ACTUAL: 					
					</td>
					<td class='BorderInf'>
								".$cvurl."					
					</td>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>

				<tr>
					<td>						
						NUEVA URL
					</td>
					<td>
<input type='text' name='url' size=80 maxlength=300 value='".$defaults['url']."' />

					</td>
				</tr>
					
				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='GRABAR LA NUEVA URL' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
		</form>														
			
			</table>				
						"); 
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Admin.php';
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>