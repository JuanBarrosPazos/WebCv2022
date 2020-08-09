<?php
 
		require 'Conections/conection.php';

	global $db;
	global $db_name;
	
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
	$_SESSION['mmail'] = $rowt['Email'];
	$_SESSION['ttlf'] = "Tlf: ".$rowt['Tlf1'].".";
		require 'Inclu/Inclu_Menu_00.php';

	$sql =  "SELECT * FROM `web_cv`";
	$q = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($q);
	
	$_SESSION['id'] = $row['id'];
	$_SESSION['year'] = $row['year'];
	$_SESSION['horas'] = $row['horas'];
	$_SESSION['sector'] = $row['sector'];
	$_SESSION['titulo'] = $row['titulo'];
	$_SESSION['modulos'] = $row['modulos'];
	$_SESSION['academia'] = $row['academia'];
	$_SESSION['coment'] = $row['coment'];

///////////////////////////////////////////////////////////////////////////////////////////////
		
					//require 'Inclu/Admin_2.php';
					if($_POST['oculto']){show_form();
										 process_form();
										 
									} else {visit();	
											show_form();
											ver_todo();
											admin();
													}

/////////////////////////////////////////////////////////////////////////////////////////////////

function visit(){

	global $db;
	global $db_name;
	global $rowv;
	global $sumavisit;

	$sqlv =  "SELECT * FROM `visitas`";
 	
	$qv = mysqli_query($db, $sqlv);
	$rowv = mysqli_fetch_assoc($qv);
	
	$_SESSION['visita'] = $row['visita'];

	$tot = $rowv['visita'];

	global $sumavisit;
	$sumavisit = $tot + 1;
	$_SESSION['vt'] = $sumavisit;

	$idv = 69;
	
	$sqlv = "UPDATE `$db_name`.`visitas` SET `visita` = '$sumavisit' WHERE `visitas`.`idv` = '$idv' LIMIT 1 ";

	if(mysqli_query($db, $sqlv)){
		}else {print("<font color='#FF0000'>
						* Error: </font>
						<br/>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						<br/>";
				}

		}

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){

	global $db;
	global $db_name;
	global $rowv;

	$sqlv =  "SELECT * FROM `visitas`";
	$qv = mysqli_query($db, $sqlv);
	$rowv = mysqli_fetch_assoc($qv);
	$_SESSION['visita'] = $row['visita'];
	$tot = $rowv['visita'];
	
	$fil = "%".$_POST['sector']."%";
	$orden = $_POST['Orden'];

$sqlc =  "SELECT * FROM `web_cv` WHERE `sector` LIKE '$fil' OR `sector2` LIKE '$fil' ORDER BY $orden ";
 	
	$qc = mysqli_query($db, $sqlc);
	
	if($_POST["sector"] == ''){
	
		$_sec = 'TODOS LOS DATOS DEL CV';}
		
	else{$_sec = 'SECCION '.strtoupper($_POST['sector']);}

	if(!$qc){
		print("<font color='#FF0000'>Se ha producido un error: </font>".mysqli_error($db)."<br/>");
			
		} else {
			
			if(mysqli_num_rows($qc)== 0){
							print ("<table align='center'>
										<tr>
											<td align='center'>
												<font color='#FF0000'>
													NO HAY DATOS.
												</font>
											</td>
										</tr>
									</table>");

				} else {
					
	$file_img = "Admin/img/new_img.txt";
	$fw_img = fopen($file_img, 'r+');
	$fget_img = fgets($fw_img);
	$fget_img = trim($fget_img);
	fclose($fw_img);
	$_SESSION['img_img'] = $fget_img;

	$ruta = "Inclu/";
	global $docurl;
	$docurl = $ruta."cvurl.php";
	global $cvurl;
	$cvurl = file_get_contents($docurl);
			
		print("
		
		<div id=\"foto\">
 <img src=\"Admin/img/".$fget_img."\"  width='110' height='158' alt='Juan Barros Pazos' /> 
		</div>
					 
					 <table align='center'>
									<tr>
										<th colspan=5 class='BorderInfDch'>
										<font color='#59746A'>
															".$_sec."
										</font>
										</th>
										
										<td  class='BorderInfDch'>
<a href='".$cvurl."' target='_blank'>
							CV EN PDF
</a>
										</td>
										
										<td class='BorderInf'>
											<font color='#59746A'>
												Número de visitas: ".$tot."
											</font>
										</td>
										
									</tr>
									
									<tr>
										
										<th class='BorderInfDch' width='85px'>
											Year
										</th>
										
										<th class='BorderInfDch' width='40px'>
											Horas
										</th>
										
										<th class='BorderInfDch' width='75px'>
											Modalidad
										</th>
										
										<th class='BorderInfDch' width='180px'>
											Titulo
										</th>
										
										<th class='BorderInfDch' width='260px'>
											M&oacute;dulos
										</th>
										
										<th class='BorderInfDch' width='80px'>
											Centro
										</th>
										
										<th class='BorderInf' width='240px'>
											Comentarios
										</th>
										
										
									</tr>");
			
			while($rowc = mysqli_fetch_row($qc)){

										print (	"<tr align='center'>
													
													<td class='BorderInfDch'>
															".$rowc[1]."
													</td>
														
													<td class='BorderInfDch'>
															".$rowc[2]."
													</td>
														
													<td class='BorderInfDch' align='left'>
															".ucwords($rowc[5])."
													</td>
													
													<td class='BorderInfDch' align='left'>
															".$rowc[6]."
													</td>
																				
													<td class='BorderInfDch' align='left'>
															".$rowc[7]."
													</td>
													
													<td class='BorderInfDch' align='left'>
															".$rowc[8]."
													</td>
													
													<td class='BorderInf' align='left'>
															".$rowc[9]."
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
	
/*
	$filtrar = array (	'' => 'Ver todos los datos del CV',
						'informatica' => 'Informatica Programacion & Diseño Web',
						'gestion' => 'Gestion empresa y relaciones laborales',
						'psicologia' => 'Psicologia',
						'formacion' => 'Sector Formacion',
						'prl' => 'Prevencion Riesgos Laborales',
						'alimentacion' => 'Alimentacion y Hosteleria',
						'decoracion' => 'Decoracion',
						'experiencia' => 'Experiencia Practica y Laboral',
						'otros' => 'Otros datos: Salud, idiomas...',
															);
*/
														
	$ordenar = array (	'`year` DESC' => 'Year Descendente',
						'`year` ASC' => 'Year Ascendente',
						'`modalidad` ASC' => 'Modalidad Ascendente',
						'`modalidad` DESC' => 'Modalidad Descendente',
						'`horas` DESC' => 'Horas Descendente',
						'`horas` ASC' => 'Horas Ascendente',
						'`academia` DESC' => 'Centro Descendente',
						'`academia` ASC' => 'Centro Ascendente',

															);
						

	$file_img = "Admin/img/new_img.txt";
	$fw_img = fopen($file_img, 'r+');
	$fget_img = fgets($fw_img);
	$fget_img = trim($fget_img);
	fclose($fw_img);
	$_SESSION['img_img'] = $fget_img;
	
		print("
		
		<div id=\"foto\">
 <img src=\"Admin/img/".$fget_img."\"  width='110' height='158' alt='Juan Barros Pazos' /> 
		</div>

			<table align='center' style=\"border:0px;margin-top:4px\" width='780px'>
				
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

					<td align='right' width='140px'>
						ORDENAR POR
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
	global $db_name;
	global $rowv;
	

	$sqlv =  "SELECT * FROM `visitas`";
 	
	$qv = mysqli_query($db, $sqlv);
	
	$rowv = mysqli_fetch_assoc($qv);
	
	$_SESSION['visita'] = $row['visita'];
	
	$tot = $rowv['visita'];
	$orden = $_POST['Orden'];

	$sqlb =  "SELECT * FROM `web_cv` ORDER BY `year` DESC";
	$qb = mysqli_query($db, $sqlb);
	
	$ruta = "Inclu/";
	global $docurl;
	$docurl = $ruta."cvurl.php";
	global $cvurl;
	$cvurl = file_get_contents($docurl);
	//print("* ".$cvurl);
			
	if(!$qb){
			print("</br> <font color='#FF0000'>Se ha producido un error: </form>".mysqli_error($db)."<br/>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
											print ("NO HAY DATOS.</br>");

				} else { print ("<table align='center'>
									<tr>
										<th colspan=5 class='BorderInfDch'>
										<font color='#59746A'>
								TODO EL CV ORDENADO POR A&Nacute;O DESCENDENTE.
										</font>
										</th>

										<td  class='BorderInfDch'>
<a href='".$cvurl."' target='_blank'>
							CV EN PDF
</a>
										</td>

										<td class='BorderInf'>
											<font color='#59746A'>
												Número de visitas: ".$tot."
											</font>
										</td>

									</tr>
									
										<th class='BorderInfDch' width='90px'>
											Year
										</th>
										
										<th class='BorderInfDch' width='40px'>
											Horas
										</th>
										
										<th class='BorderInfDch' width='130px'>
											Sector
										</th>
										
										<th class='BorderInfDch' width='180px'>
											Titulo
										</th>
										
										<th class='BorderInfDch' width='220px'>
											Modulos
										</th>
										
										<th class='BorderInfDch' width='80px'>
											Centro
										</th>
										
										<th class='BorderInf' width='220px'>
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
														
													<td class='BorderInfDch'>
															".ucwords($rowb[3])."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[6]."
													</td>
																			
													<td class='BorderInfDch' align='left'>
															".$rowb[7]."
													</td>
																				
													<td class='BorderInfDch'>
															".$rowb[8]."
													</td>
													
													<td class='BorderInf' align='left'>
															".$rowb[9]."
													</td>
																										
												</tr>");
					
										}

						print("</table>");

						} 

			}
		
	}

/////////////////////////////////////////////////////////////////////////////////////////////////

	require 'Inclu/Inclu_Footer_01.php';
	
 function admin(){

	//print("ME CAGO EN ********* TOOOOOO.");
	require_once('geo_class/geoplugin.class.php');
	$geoplugin = new geoPlugin();
	$geoplugin->locate();

 $text_body = " <!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
				<html>
					<head>
						<title>Untitled Document</title>
						<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
						<meta http-equiv='content-type' content='text/html' charset='utf-8' />
						<meta http-equiv='Content-Language' content='es-es'>
						<META NAME='Language' CONTENT='Spanish'>
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
</head>
						<body bgcolor='#D7F0E7'>
	<table font-family='Times New Roman' width='90%' border='0' align='center' cellpadding='0' cellspacing='0'>
				<tr>
					<th colspan='3'>MENSAJE AUTOMÁTICO</th>
				</tr>
				<tr>
				<th colspan='3'>
					VISITA Nº.".$_SESSION['vt']." A WEB CV ".$_SESSION['title'].".
				</th>
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
				'Subject' => "VISITA Nº.".$_SESSION['vt']." A WEB CV ".$_SESSION['title'].".");
				$destinatario= $_SESSION['mmail'];
				$titulo= "VISITA Nº.".$_SESSION['vt']." A WEB CV ".$_SESSION['title'].".";
				$responder= $_SESSION['mmail'];
				$remite= $_SESSION['mmail'];
				$remitente= "MENSAJE AUTOMATICO VISITA CV";
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

?>
