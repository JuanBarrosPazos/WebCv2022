<?php

	require 'Inclu/Inclu_Menu_00c.php';
	//require 'Inclu/Admin_0.php';
	if($_POST['config']){
							
	if($form_errors = validate_form()){
										show_form($form_errors);
										require 'Inclu/Inclu_Footer_01.php';
																	} 
	else {	process_form();
			require 'Conections/conection.php';
			global $db;
			$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	
	if (!$db){ 	global $dbconecterror;
				$dbconecterror = $dbname." * ".mysqli_connect_error()."\n"; 
				print ("<br/><font color='#FF0000'>NO CONECTA A BBDD ".$db_name."</br>".mysqli_connect_error()."/font");
						show_form();
						require 'Inclu/Inclu_Footer_01.php';
//						require 'Inclu/Admin_0.php';
			}else{	crear_tablas();
					admin();
					require 'Inclu/Inclu_Footer_01.php';
					}
			}

	} else {
			show_form();
			require 'Inclu/Inclu_Footer_01.php';
							}

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	if(strlen(trim($_POST['host'])) == 0){
		$errors [] = "HOST: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['host'])) < 4){
		$errors [] = "HOST: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 _\.]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['user'])) == 0){
		$errors [] = "USER: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['user'])) < 4){
		$errors [] = "USER: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 _ \.]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['pass'])) == 0){
		$errors [] = "PASS: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['pass'])) < 4){
		$errors [] = "PASS: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 _\.]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['name'])) == 0){
		$errors [] = "NAME: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['name'])) < 4){
		$errors [] = "NAME: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 _ \.]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>NO VALIDOS</font>";
		}

			return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $host;
	global $user;
	global $pass;
	global $name;
	
	$host = "'".$_POST['host']."'";
	$user = "'".$_POST['user']."'";
	$pass = "'".$_POST['pass']."'";
	$name = "'".$_POST['name']."'";

	$bddata = '<?php
				$db_host = '.$host.'; 
				$db_user = '.$user.'; 
				$db_pass = '.$pass.'; 
				$db_name = '.$name.'; 
				?>';
	
	$filename = "Conections/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);
	

			}	

//////////////////////////////////////////////////////////////////////////////////////////////
	
	function crear_tablas(){
	
	global $db;	
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	global $dbconecterror;
	
	global $host;
	global $user;
	global $pass;
	global $name;
	
		print("<div align='center' style='margin-left:auto; margin-right:auto'>
					<table>
		
					<tr>
						<td colspan='2' align='center'>
								SE HA CREADO EL ARCHIVO DE CONEXIONES.
							</br>
								CON LAS SIGUIENTES VARIABLES.
						</td>
					</tr>
					<tr>
						<td>
								VARIABLE HOST ADRESS
						</td>
						<td>
								\$db_host = ".$host."; \n
						</td>		
					</tr>								

					<tr>
						<td>
								VARIABLE USER NAME
						</td>
						<td>
								\$db_user = ".$user."; \n
						</td>		
					</tr>	
												
					<tr>
						<td>
								VARIABLE PASSWORD
						</td>
						<td>
								\$db_pass = ".$pass."; \n
						</td>		
					</tr>	
												
					<tr>
						<td>
								VARIABLE BBDD NAME
						</td>
						<td>
								\$db_name = ".$name."; \n
						</td>		
					</tr>
													
				</table>
				</div>
							");
//////////////////

	$admin = "CREATE TABLE `$db_name`.`admin` (
			  `ID` int(4) NOT NULL auto_increment,
			  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'XBPadmin',
			  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
			  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
			  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
			  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
			  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
			  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
			  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
			  `Password` varchar(10) collate utf8_spanish2_ci NOT NULL,
			  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
			  `Tlf1` int(9) NOT NULL,
			  `Tlf2` varchar(9) NOT NULL default '000000000',
			  UNIQUE KEY `ID` (`ID`),
			  UNIQUE KEY `Email` (`Email`),
			  UNIQUE KEY `Usuario` (`Usuario`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db , $admin)){
					global $table1;
					$table1 = "\t* OK TABLA ADMIN. \n";
				} else {
					global $table1;
					$table1 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db)." \n";
					}
					
	$visitas = "CREATE TABLE `$db_name`.`visitas` (
				  `idv` int(2) NOT NULL,
				  `visita` int(10) NOT NULL,
				  `admin` int(10) NOT NULL,
				  `deneg` int(10) NOT NULL,
				  `acceso` int(10) NOT NULL,
				  PRIMARY KEY  (`idv`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci";
		
	if(mysqli_query($db, $visitas)){
					global $table3;
					$table3 = "\t* OK TABLA VISITAS. \n";
				} else {
					global $table3;
					$table3 = "\t* NO OK TABLA VISITAS. ".mysqli_error($db)." \n";
					}
					
	$vd = "INSERT INTO `$db_name`.`visitas` (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
(69, 0, 0, 0, 0)";
		
	if(mysqli_query($db, $vd)){
			print ("<table align='center'>
									<tr>
										<td>
											<a href='config/config2.php'>
														CREE EL USUARIO ADMINISTRADOR
											</a>
										</td>
									</tr>
								</table>
										");			
										
					global $table4;
					$table4 = "\t* OK INIT VALUES EN VISITAS. \n";
				} else {
					global $table4;
					$table4 = "\t* NO OK INIT VALUES EN VISITAS. ".mysqli_error($db)." \n";
					}
					
	$visitas = "CREATE TABLE `web_cv` (
			  `id` int(4) NOT NULL auto_increment,
			  `year` varchar(12) character set utf8 collate utf8_spanish_ci NOT NULL,
			  `horas` varchar(7) character set utf8 collate utf8_spanish_ci NOT NULL,
			  `sector` varchar(60) character set utf8 collate utf8_spanish_ci NOT NULL,
			  `sector2` varchar(60) character set utf8 collate utf8_spanish_ci NOT NULL,
			  `modalidad` varchar(22) character set utf8 collate utf8_spanish_ci NOT NULL,
			  `titulo` varchar(50) character set utf8 collate utf8_spanish_ci NOT NULL,
			  `modulos` varchar(340) character set utf8 collate utf8_spanish_ci NOT NULL,
			  `academia` varchar(50) character set utf8 collate utf8_spanish_ci NOT NULL,
			  `coment` varchar(400) character set utf8 collate utf8_spanish_ci NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1";
		
	if(mysqli_query($db, $visitas)){
					global $table5;
					$table5 = "\t* OK TABLA VISITAS ADMIN. \n";
				} else {
					global $table5;
					$table5 = "\t* NO OK TABLA VISITAS ADMIN. ".mysqli_error($db)." \n";
					}
					
	$secciones = "CREATE TABLE `$db_name`.`secciones` (
  `id` int(3) NOT NULL auto_increment,
  `valor` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `nombre` varchar(22) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`,`valor`,`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $secciones)){
					global $table6;
					$table6 = "\t* OK TABLA SECCIONES. \n";
				} else {
					global $table6;
					$table6 = "\t* NO OK TABLA SECCIONES. ".mysqli_error($db)." \n";
					}
					
	$vd = "INSERT INTO `$db_name`.`secciones` (`id`, `valor`, `nombre`) VALUES ('0', '', 'SECTOR')";
		
	if(mysqli_query($db, $vd)){
					global $table7;
					$table7 = "\t* OK INIT VALUES EN SECCIONES. \n";
				} else {
					global $table7;
					$table7 = "\t* NO OK INIT VALUES EN SECCIONES. ".mysqli_error($db)." \n";
					}
					
	$modalidad = "CREATE TABLE `$db_name`.`modalidad` (
  `id` int(3) NOT NULL auto_increment,
  `valor` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `nombre` varchar(22) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`,`valor`,`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $modalidad)){
					global $table8;
					$table8 = "\t* OK TABLA MODALIDAD. \n";
				} else {
					global $table8;
					$table8 = "\t* NO OK TABLA MODALIDAD. ".mysqli_error($db)." \n";
					}
					
$vd2 = "INSERT INTO `$db_name`.`modalidad` (`id`, `valor`, `nombre`) VALUES ('0', '', 'MODALIDAD')";
		
	if(mysqli_query($db, $vd2)){
					global $table9;
					$table9 = "\t* OK INIT VALUES EN MODALIDAD. \n";
				} else {
					global $table9;
					$table9 = "\t* NO OK INIT VALUES EN MODALIDAD. ".mysqli_error($db)." \n";
					}
					
$datein = date('Y-m-d/H:i:s');
$logdate = date('Y_m_d');
$logtext = "- CONFIG INIT ".$datein.".\n * ".$db_name.". \n * ".$db_host.". \n * ".$db_user.". \n * ".$db_pass."\n".$dbconecterror.$table1.$table3.$table4.$table5.$table6.$table7.$table8.$table9."\n";
$filename = "config/".$logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
fclose($log);

	}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	/* Se pasan los valores por defecto y se devuelven los que ha escrito el usuario. */
	
	if($_POST['config']){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'host' => '',
									'user' => '',
									'pass' => '',
									'name' => '',
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
		
	print("<div align='center' style='margin-left:auto; margin-right:auto'>
	
			<table align='center' style=\"margin-top:10px\">
					<tr>
					<td style='color:red' align='center'>
					
					INTRODUZCA LOS DATOS DE CONEXI&Oacute;N A LA BBDD.
							</br>
				SE CREAR&Aacute; EL ARCHIVO DE CONEXI&Oacute;N Y LAS TABLAS DE CONFIGURACI&Oacute;N.
					</td>
				</tr>
			</table>
			
			<table style=\"margin-top:10px\">

				<tr>
					<th colspan=2 class='BorderInf'>

							INIT CONFIG DATA
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB HOST ADRESS
					</td>
					<td width=200px>
		<input type='text' name='host' size=25 maxlength=22 value='".$defaults['host']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB USER NAME
					</td>
					<td width=200px>
		<input type='text' name='user' size=25 maxlength=22 value='".$defaults['user']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB PASSWORD
					</td>
					<td width=200px>
		<input type='text' name='pass' size=25 maxlength=22 value='".$defaults['pass']."' />
					</td>
				</tr>
				
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB NAME
					</td>
					<td width=200px>
		<input type='text' name='name' size=25 maxlength=22 value='".$defaults['name']."' />
					</td>
				</tr>
					
					
				<tr>
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
						<input type='submit' value='INIT CONFIG' />
						<input type='hidden' name='config' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>	
			</div>			
					"); 
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////


 function admin(){
	 	 
/**/

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
					<th colspan='3'>INSTALACIÓN DE LA APLICACIÓN WEB CV</th>
				</tr>
				<tr>
					<th colspan='3'>MENSAJE AUTOMÁTICO</th>
				</tr>
				 <tr>
					<td align='right'>ASUNTO:</td>
					<td width='12'>&nbsp;</td>
					<td align='left'>
							SE HA INSTALADO LA APLICACIÓN WEB CV.
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
					  'Subject' => "NOTIFICACION DEL INSTALACIÓN DE WEB CV GRATUITA");
				$destinatario= "juanbarrospazos@hotmail.es";
				$titulo= "NOTIFICACION DEL INSTALACIÓN WEB CV GRATUITA";
				$responder= "juanbarrospazos@hotmail.es";
				$remite= "juanbarrospazos@hotmail.es";
				$remitente= "MENSAJE GENERADO AUTOMATICAMENTE";
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

////////////////////////////////////////////////

?>