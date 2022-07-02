<?php
session_start();
 
		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."<br/>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////
		
	$sqlt =  "SELECT * FROM `admin` ORDER BY `ID` ASC LIMIT 1";
	$qt = mysqli_query($db, $sqlt);
	$rowt = mysqli_fetch_assoc($qt);
	$_SESSION['title'] = $rowt['Nombre']." ".$rowt['Apellidos'];
	$_SESSION['tdir'] = "City: ".$rowt['Direccion'].".<br/> ";
	$_SESSION['tmail'] = "Email: ".$rowt['Email']." / ";
	$_SESSION['ttlf'] = "Tlf: ".$rowt['Tlf1'].".";
	$_SESSION['mmail'] = $rowt['Email'];
	require '../Inclu/Admin_Inclu_01.php';

	$sql =  "SELECT * FROM `admin` WHERE `Usuario` = '$_POST[Usuario]' AND `Password` = '$_POST[Password]'";
 	
	$q = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($q);
	
	$_SESSION['ID'] = $row['ID'];
	$_SESSION['Nivel'] = $row['Nivel'];
	$_SESSION['Nombre'] = $row['Nombre'];
	$_SESSION['Apellidos'] = $row['Apellidos'];
	$_SESSION['Email'] = $row['Email'];
	$_SESSION['Usuario'] = $row['Usuario'];
	$_SESSION['Password'] = $row['Password'];
	$_SESSION['Direccion'] = $row['Direccion'];
	$_SESSION['Tlf1'] = $row['Tlf1'];
	$_SESSION['Tlf2'] = $row['Tlf2'];

///////////////////////////////////////////////////////////////////////////////////////////////

//require '../Inclu/Admin_1.php';
		
			if($_POST['oculto']){
					
					if($form_errors = validate_form()){
										suma_denegado ();
										show_form($form_errors);
										global $denegado;
										global $accion;
										$accion ="ACCESO DENEGADO ADMIN WCV N: ".$denegado.".";
										admin();
								} else {suma_acces();
										process_form();
										ver_todo();
										global $name;
										$name = $_SESSION['Nombre'];
										global $name2;
										$name2 = $_SESSION['Apellidos'];
										global $accion;
										//$accion ="SESION ABIERTA WCV: ".$name." ".$name2.".";
										$accion ="SESION ABIERTA WCV: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".";
										admin();
										$_SESSION['CloseN']=$_SESSION['Nombre'];
										$_SESSION['CloseA']=$_SESSION['Apellidos'];
										}
					} elseif ($_POST['cerrar']){
										global $name;
										$name = $_SESSION['CloseN'];
										global $name2;
										$name2 = $_SESSION['CloseA'];
										global $accion;
										//$accion ="SESION CERRADA WCV: ".$name." ".$name2.".";
										$accion ="SESION CERRADA WCV: ".$_SESSION['CloseN']." ".$_SESSION['CloseA'].".";
										admin();
										show_form();
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
										print("HA CERRADO SU SESION.<br/>");
								}
									else {	suma_visit();	
											show_form();
											global $visit;
											global $accion;
											$accion ="VISITA ADMIN WCV N: ".$visit.".";
											admin();
											unset($_SESSION['CloseN']);
											unset($_SESSION['CloseA']);
															}
				
/////////////////////////////////////////////////////////////////////////////////////////////////

function show_visit(){

	global $db;
	global $db_name;
	global $rowv;
	global $sumavisit;
	
	$sqlv =  "SELECT * FROM `visitas`";
	$qv = mysqli_query($db, $sqlv);
	
	$rowv = mysqli_fetch_assoc($qv);
	
	$_SESSION['admin'] = $rowv['admin'];
	
	$tot = $rowv['admin'];

	global $sumavisit;
	$sumavisit = $tot + 1;
	
	$idv = 69;

	if(mysqli_query($db, $sqlv)){
		/**/	print(" <table align='right'>
		
						<tr>	
							<td>
								<font color='#59746A'>
									Número De Visitas:
								</font>
							</td>
							<td  align='right'>
								<font color='#59746A'>
														".$tot."
								</font>
							</td>
						</tr>
						
						<tr>
							<td>
								<font color='#59746A'>
									Número De Accesos Permitidos:
								</font>
							</td>
							<td align='right'>
								<font color='#59746A'>
														".$rowv['acceso']."
								</font>
							</td>
						</tr>

						<tr>
							<td>
								<font color='#59746A'>
									Número De Accesos Denegados:
								</font>
							</td>
							<td align='right'>
								<font color='#59746A'>
														".$rowv['deneg']."
								</font>
							</td>
						</tr>
					</table>
					<br/>
								");
										} 
				
				 else {
				print("<font color='#FF0000'>
						* Error: </font>
						<br/>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						<br/>");
						
							}

								}

/////////////////////////////////////////////////////////////////////////////////////////////////

function suma_visit(){

	global $db;
	global $db_name;
	global $rowv;
	global $sumavisit;
	
	$sqlv =  "SELECT * FROM `visitas`";
	$qv = mysqli_query($db, $sqlv);
	$rowv = mysqli_fetch_assoc($qv);
	
	$_SESSION['admin'] = $rowv['admin'];
	
	$tot = $rowv['admin'];

	global $sumavisit;
	$sumavisit = $tot + 1;
	global $visit;
	$visit = $sumavisit;
	
	$idv = 69;
	
	$sqlv = "UPDATE `$db_name`.`visitas` SET `admin` = '$sumavisit' WHERE `visitas`.`idv` = '$idv' LIMIT 1 ";

	if(mysqli_query($db, $sqlv)){
			print(" <br/>");} 
				 else {
				print("<font color='#FF0000'>
						* Error: </font>
						<br/>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						<br/>");
						
							}

								}

/////////////////////////////////////////////////////////////////////////////////////////////////

function suma_acces(){

	global $db;
	global $db_name;
	global $rowa;
	global $sumaacces;
	
	$sqla =  "SELECT * FROM `visitas`";
	$qa = mysqli_query($db, $sqla);
	$rowa = mysqli_fetch_assoc($qa);
	
	$_SESSION['acceso'] = $rowa['acceso'];
	
	$tota = $rowa['acceso'];

	global $sumaacces;
	$sumaacces = $tota + 1;

	$idv = 69;
	
	$sqla = "UPDATE `$db_name`.`visitas` SET `acceso` = '$sumaacces' WHERE `visitas`.`idv` = '$idv' LIMIT 1 ";

	if(mysqli_query($db, $sqla)){ print ('<br/>');
													} 
				
				 else {
				print("<font color='#FF0000'>
						* Error: </font>
						<br/>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						<br/>");
						
							}

								}

/////////////////////////////////////////////////////////////////////////////////////////////////

function suma_denegado(){

	global $db;
	global $db_name;
	global $rowd;
	global $sumadeneg;
	

	$sqld =  "SELECT * FROM `visitas`";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);
	
	$_SESSION['deneg'] = $rowd['deneg'];
	
	$dng = $rowd['deneg'];

	global $sumadeneg;
	$sumadeneg = $dng + 1;
	global $denegado;
	$denegado = $sumadeneg;

	$idd = 69;
	
	$sqld = "UPDATE `$db_name`.`visitas` SET `deneg` = '$sumadeneg' WHERE `visitas`.`idv` = '$idd' LIMIT 1 ";

	if(mysqli_query($db, $sqld)){
			print("	<br/>");} 
				
				 else {
				print("<font color='#FF0000'>
						* Error: </font>
						<br/>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						<br/>");
						
							}

								}

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $db;
	
	$errors = array();
	
	if (strlen(trim($_POST['Usuario'])) == 0){
		$errors [] = "Usuario: Campo obligatorio.";
		}

	if (strlen(trim($_POST['Password'])) == 0){
		$errors [] = "Password: Campo Obligatorio:";
		}
		
	global $sql;
	global $q;
	global $row;
	
	if(trim($_POST['Usuario'] != $row['Usuario'])){
		$errors [] = "Nombre o Password incorrecto.";
		}
	
	elseif(trim($_POST['Password'] != $row['Password'])){
		$errors [] = "Nombre o Password incorrecto.";
		}

	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	
	print("Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
			master_index();
				
	}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	if($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array ('Usuario' => '',
								   'Password' => '');
								   }
	
	if ($errors){	print("	<div width='90%' style='float:left'>
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
		
	print("".show_visit()."
			<br/>
			<table align='center' style=\"margin-top:80px; margin-bottom:80px\" >
				<tr>
					<th colspan=2 width=100% valign=\"bottom\" class='BorderInf'>
						Introduzca sus datos de acceso.
					</th>
				</tr>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td>	
						Usuario:
					</td>
					<td>
<input type='Password' name='Usuario' size=20 maxlength=50 value='".$defaults['Usuario']."' />
					</td>
				</tr>
	
				<tr>
					<td>	
						Password:
					</td>
					<td>
<input type='Password' name='Password' size=20 maxlength=50 value='".$defaults['Password']."' />
					</td>
				</tr>
	
				<tr>
					<td colspan='2' align='right' valign='middle'>
						<input type='submit' value='Acceder' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
				<tr>
					<td colspan='2' align='center' valign='middle'>
						<a href='Claves_Perdidas.php'>
							HE PERDIDO MIS CLAVES
						</a>
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
		
	$sqlb =  "SELECT * FROM `web_cv` ORDER BY `year` DESC ";
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
	print("</br> <font color='#FF0000'>Se ha producido un error: </form>".mysqli_error($db)."<br/>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
							print ("<div align='center' style='margin-bottom:30px'>
											NO HAY DATOS.
									 </div>");

				} else { print ("<table align='center'>
									<tr>
										<th colspan=7  class='BorderInf'>
												FORMACIÓN & EXPERIENCIA
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

/////////////////

 function admin(){	 

/**/

	require_once('../geo_class/geoplugin.class.php');
	$geoplugin = new geoPlugin();
	$geoplugin->locate();

	global $accion;
 	
	$text_body = " <!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
				<html>
					<head>
						<title>Untitled Document</title>
						<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
						<meta http-equiv='content-type' content='text/html' charset='utf-8' />
						<meta http-equiv='Content-Language' content='es-es'>
						<META NAME='Language' CONTENT='Spanish'>
					</head>
						<body bgcolor='#D7F0E7'>
					<STYLE>
						body {
							font-family: 'Times New Roman', Times, serif;
						}
						body a {
							text-decoration:none;
						}
						table a {
							color: #666666;
							text-decoration: none;
							font-family: 'Times New Roman', Times, serif;
						}
						table a:hover {
							color: #FF9900;
							text-decoration: none;
						}
						tr {
							margin: 0px;
							padding: 0px;
						}
						td {
							margin: 0px;
							padding: 6px;
						}
						th {
							padding: 6px;
							margin: 0px;
							text-align: center;
							color: #666666;
						}
					</STYLE>
	<table font-family='Times New Roman' width='90%' border='0' align='center' cellpadding='0' cellspacing='0'>
				<tr>
					<th colspan='3'>NOTIFICACIÓN ".$accion."</th>
				</tr>
				<tr>
					<th colspan='3'>MENSAJE AUTOMÁTICO</th>
				</tr>
				 <tr>
					<td align='right'>ASUNTO:</td>
					<td width='12'>&nbsp;</td>
					<td align='left'>
							".$accion.".
					</td>
				</tr>
				<tr>
					<td align='right'>FECHA:</td>
					<td>&nbsp;</td>
					<td align='left'>".date('d-m-Y/H:i:s')."</td>
				</tr>
				<tr>
					<td align='right'>URL:</td>
					<td>&nbsp;</td>
					<td align='left'>".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."</td>
				</tr>
				<tr>
					<td align='right'>SERVER NAME:</td>
					<td>&nbsp;</td>
					<td align='left'>".$_SERVER['SERVER_NAME']."</td>
				</tr>
				<tr>
					<td align='right'>SERVER IP:</td>
					<td>&nbsp;</td>
					<td align='left'>".$_SERVER['SERVER_ADDR']."</td>
				</tr>
				<tr>
					<td align='right'>SERVER ADMIN:</td>
					<td>&nbsp;</td>
					<td align='left'>".$_SERVER['SERVER_ADMIN']."</td>
				</tr>
					<tr>
					<td align='right'>IP ACCESS:</td>
					<td>&nbsp;</td>
					<td align='left'>".$_SERVER['REMOTE_ADDR']."</td>
				</tr>
				<tr>
					<td align='right'>GEOLOCATION FOR:</td>
					<td>&nbsp;</td>
					<td align='left'>{$geoplugin->ip}</td>
				</tr>
				<tr>
					<td align='right'>LATITUD:</td>
					<td>&nbsp;</td>
					<td align='left'>{$geoplugin->latitude}</td>
				</tr>
				<tr>
					<td align='right'>LONGITUD:</td>
					<td>&nbsp;</td>
					<td align='left'>{$geoplugin->longitude}</td>
				</tr>
				<tr>
					<td align='right'>COUNTRY NAME</td>
					<td>&nbsp;</td>
					<td align='left'>{$geoplugin->countryName}</td>
				</tr>
				<tr>
					<td align='right'>COUNTY CODE:</td>
					<td>&nbsp;</td>
					<td align='left'>{$geoplugin->countryCode}</td>
				</tr>
				<tr>
					<td align='right'>REGION:</td>
					<td>&nbsp;</td>
					<td align='left'>{$geoplugin->region}</td>
				</tr>
				<tr>
					<td align='right'>CITY:</td>
					<td>&nbsp;</td>
					<td align='left'>{$geoplugin->city}</td>
				</tr>
				<tr>
					<td align='right'>AREA CODE:</td>
					<td>&nbsp;</td>
					<td align='left'>{$geoplugin->areaCode}</td>
				</tr>
				<tr>
					<td align='right'>DMA CODE:</td>
					<td>&nbsp;</td>
					<td align='left'>{$geoplugin->dmaCode}</td>
				</tr>
					</table>
				</body>
			</html>";
			
	$headers = array ('From' => "juanbarrospazos@hotmail.es",
					  'Subject' => "NOTIFICACION ".$accion.".");
				$destinatario= $_SESSION['mmail'];
				$titulo= "NOTIFICACION ".$accion.".";
				$responder= $_SESSION['mmail'];
				$remite= $_SESSION['mmail'];
				$remitente= "MENSAJE AUTO ".$accion.".";
				$separador = "_separador".md5 (uniqid (rand()));
				$cabecera = "Date: ".date('l j F Y, G:i')."\n";
				$cabecera .="MIME-Version: 1.0\n";
				$cabecera .="From: ".$remitente."<".$remite.">\n";
				$cabecera .="Return-path: ". $remite."\n";
				$cabecera .= "Reply-To: ".$remite."\n";
				$cabecera .="X-Mailer: PHP/". phpversion()."\n";
				$cabecera .= "Content-Type: multipart/mixed;"."\n";
				$cabecera .= " boundary=$separador"."\r\n\r\n";	/**/
				$texto_html ="\n"."--$separador"."\n";			/**/
				$texto_html .="Content-Type:text/html; charset=\'utf-8\'"."\n";
				$texto_html .="Content-Transfer-Encoding: 7bit"."\r\n\r\n";
				$texto_html .= $text_body;
				$mensaje= $texto_html;
			if( mail($destinatario, $titulo, $mensaje, $cabecera)){print("");
							}else{print("");}
	}

////////////////////////////

?>

