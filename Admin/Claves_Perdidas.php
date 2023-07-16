<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Conections/conexion_bbdd.php';

	
///////////////////////////////////////////////////////////////////////////////////////////////

		if(isset($_POST['oculto'])){if($form_errors = validate_form()){
					print("<table align='center'>
								<tr>
									<td>
										<font color='#FF0000'>
											NO SE HA ENVIADO EL FORMULARIO.
										</font>
									</td>
								</tr>
								<tr>
									<td align='center'>
					<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
							Contactos Juan Barros
					</a>
									</td>
								</tr>
							</table>
											");
												
						show_form($form_errors);
										
					} else {print("<table align='center' style=\"margin-top:80px\">
									<tr>
										<td>
											<font color='#0080C0'>
												SE HA PROCESADO SU PETICION CORRECTAMENTE.
											</font>
										</td>
									</tr>
									<tr>
										<td>
											<font color='#0080C0'>
												PULSE ENVIAR PARA RECIBIR SUS DATOS VIA MAIL.
											</font>
										</td>
									</tr>
								</table>");
											
							process_form();
											}
									}	/* Fin del if $_POST['oculto']*/
										
							else {show_form();}
												
				if(isset($_POST['oculto2'])){	process_Mail();
										unset($_SESSION['']);
														}

/////////////////////////////////////////////////////////////////////////////////////////

 function validate_form(){
	 
	global $sql;
	global $q;
	global $row;
	global $db;
	global $db_name;
		
	 $errors = array();
		
	/* Validamos el campo mail. */
	
		if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "Mail: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "Mail: <font color='#FF0000'>Escriba más de cinco carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "Mail: <font color='#FF0000'>Esta dirección no es válida.</font>";
		}
		
	/* Validamos el campo dni */
	
		if(strlen(trim($_POST['dni'])) == 0){
		$errors [] = "Nº DNI: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (!preg_match('/^[\d]+$/',$_POST['dni'])){
		$errors [] = "Nº DNI: <font color='#FF0000'>Sólo se admiten números.</font>";
		}

	elseif (strlen(trim($_POST['dni'])) < 8){
		$errors [] = "Nº DNI: <font color='#FF0000'>Más de 7 digitos.</font>";
		}

	/* Validamos el campo ldni */
	
	if(strlen(trim($_POST['ldni'])) == 0){
		$errors [] = "Letra DNI: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['ldni'])){
		$errors [] = "Letra DNI: <font color='#FF0000'>Solo texto</font>";
		}

	elseif (!preg_match('/^[^a-z]+$/',$_POST['ldni'])){
		$errors [] = "Letra DNI: <font color='#FF0000'>Solo mayusculas</font>";
		}

	/* Realizamos un condicional de validacion de campos Nombre y dni.*/
		

$sql =  "SELECT * FROM `$db_name`.`admin` WHERE `Email` = '$_POST[Email]' AND `dni` = '$_POST[dni]' AND `ldni` = '$_POST[ldni]' ";
 	
	$q = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($q);
	$_SESSION['L_Email'] = @$row['Email'];
	$_SESSION['L_dni'] = @$row['dni'];
	$_SESSION['L_ldni'] = @$row['ldni'];

	if(trim($_POST['Email'] != $_SESSION['L_Email'])){
		$errors [] = "Email, Nº DNI o Letra.";
		}
		
	elseif(trim($_POST['dni'] != $_SESSION['L_dni'])){
		$errors [] = "Email, Nº DNI o Letra.";
		} 
		
	elseif(trim($_POST['ldni'] != $_SESSION['L_ldni'])){
		$errors [] = "Email, Nº DNI o Letra.";
		} 

	return $errors;
 			}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	global $sql;
	global $q;
	global $row;
	
	if(isset($_POST['oculto2'])){

		global $email;
		if(isset($_POST['Email'])){$email = $_POST['Email'];} else { $email = ''; }
		global $dni;
		if(isset($_POST['dni'])){$dni = $_POST['dni'];} else { $dni = ''; }
		
				$defaults = array (	'Asunto' => 'Sus claves de usuario Web Cv.',
									'Email' => $_POST['Email'],
									'dni' => $_POST['dni'],	
									'ldni' => $_POST['ldni']	
																		);
								   }
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {global $ldni; 
				if(isset($_POST['ldni'])){$ldni = $_POST['ldni']; } else { $ldni = '';}
				$defaults = array (	'Asunto' => 'Sus claves de usuario Web Cv.',
									'Email' => '',
									'dni' => '',
									'ldni' => $ldni	
													);
									}
	
	if ($errors){
		print("<font color='#FF0000'>Solucione estos errores:</font><br/>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* </font>".$errors [$a]."<br/>");
			}
		}
	
	print("
			<table align='center' style=\"border:0px;margin_bottom:6px;margin-top:60px\">
			
			<form name='Perdidos' method='post' action='$_SERVER[PHP_SELF]'>
			
				<tr>
					<th colspan=2>
		<input name='Asunto' type='hidden' value='".$defaults['Asunto']."' />".$defaults['Asunto']."
					</th>
				</tr>

				<tr>
					<td>	
						Su E Mail:
					</td>
					<td>
		<input type='text' name='Email' size=30 value='".$defaults['Email']."' />
					</td>
				</tr>
	
				<tr>
					<td>	
						Su DNI:
					</td>
					<td>
		<input type='text' name='dni' size=30 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
	
				<tr>
					<td>	
						Su Letra DNI:
					</td>
					<td>
		<input type='text' name='ldni' size=30 maxlength=1 value='".$defaults['ldni']."' />
					</td>
				</tr>
				
				<tr align='center'>
				
					<td colspan='2' align='right'>
		<input type='submit' value='ENVIAR MIS CLAVES' />
		<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
				<tr>
					<td colspan='2' align='left'>
						<a href='Admin_Access.php'>
							Volver Admin Access.
						</a>
					</td>
				</tr>
				
		</form>	
	</table>				
				"); /* Fin del print */

	}	/* Fin de la función show_form(); */

/////////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
	//$eml = "%".$_POST['Email']."%";
	$sqlc =  "SELECT * FROM `$db_name`.`admin` WHERE `Email` = '$_POST[Email]' AND `dni` = '$_POST[dni]' AND `ldni` = '$_POST[ldni]' ";
	$qc = mysqli_query($db, $sqlc);

	if(!$qc){	print("Se ha producido un error: ".mysqli_error($db)."<br/><br/>");
			
		} else {	if(mysqli_num_rows($qc)== 0){
					print ("No hay datos.");
							
		} else { 	
			print ("<table align='center' style=\"border:0px;margin_bottom:6px;margin-top:80px\">");
			
			while($rowc = mysqli_fetch_assoc($qc)){
										
			print (	"<form name='modifica' action='$_SERVER[PHP_SELF]' method='POST'>
			
			<input name='Apellidos' type='hidden' value='".$rowc['Apellidos']."' />
			<input name='Email' type='hidden' value='".$rowc['Email']."' />
			<input name='Usuario' type='hidden' value='".$rowc['Usuario']."' />
			<input name='Password' type='hidden' value='".$rowc['Password']."' />

		<tr align='center'>
			<td>
				<input name='Asunto' type='hidden' value='".$_POST['Asunto']."' />".$_POST['Asunto']."
			</td>
														
			<td>
				<input name='Nombre' type='hidden' value='".$rowc['Nombre']."' />".$rowc['Nombre']."
			</td>
		</tr>
		<tr>
			<td colspan=2 align='center'>
				<input type='submit' value='ENVIAR MIS DATOS VIA MAIL' />
				<input type='hidden' name='oculto2' value=1 />
			</td>
				</form>
		</tr>");
						} /* Fin del while.*/
		print("</table>");
								} /* Fin segundo else anidado en if */
							} /* Fin de primer else . */
					}	/* Final de la función process_form(); */

/////////////////////////////////////////////////////////////////////////////////////////////////

 function process_Mail(){	 

	 $text_body = '
							 <!DOCTYPE HTML>
						<html>
						<head>
						<title>Untitled Document</title>
						<meta http-equiv="content-type" content="text/html" charset="utf-8" />
						<meta http-equiv="Content-Language" content="es-es">
						<META NAME="Language" CONTENT="Spanish">
						<!--
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						-->
						</head>
						
						<body bgcolor="#D7F0E7">
						
						<STYLE>
						body {
							font-family: "Times New Roman", Times, serif;
						}
						body a {
							text-decoration:none;
						}
						table a {
							color: #666666;
							text-decoration: none;
							font-family: "Times New Roman", Times, serif;
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
						
	<table font-family="Times New Roman" width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<th colspan="3">'.$_POST['Asunto'].'</th>
						  </tr>
						  <tr>
							<td align="right">Nombre:</td>
							<td width="12">&nbsp;</td>
							<td align="left">'.$_POST['Nombre'].'</td>
						  </tr>
						  <tr>
							<td align="right">Apellidos:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Apellidos'].'</td>
						  </tr>
						  <tr>
							<td align="right">Email:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Email'].'</td>
						  </tr>
						  <tr>
							<td align="right">Nombre de Usuario:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Usuario'].'</td>
						  </tr>
						  <tr>
							<td align="right">Password:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Password'].'</td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="font-size:11px">
								<b>AVISO LEGAL</b>
								<br/>
		Este mensaje y los archivos que en su caso lleve adjuntos son privados y confidenciales y se dirigen exclusivamente a su destinatario. Por ello, se informa a quien lo reciba por error de que la informaci&oacute;n contenida en el mismo es reservada y su utilizaci&oacute;n, copia odistribuci&oacute;n est&aacute; prohibida, por lo que, en tal caso, le rogamos nos lo comunique por esta misma v&iacute;a o por tel&eacute;fono al n&uacute;mero 654 639 155 de Espa&ntilde;a y proceda a borrarlo de inmediato. JuanBarros.es advierte expresamente que el env&iacute;o de correos electr&oacute;nicos a trav&eacute;s de Internet no garantiza la confidencialidad de los mensajes ni su integridad y correcta recepci&oacute;n, por lo que JuanBarros.es no asume responsabilidad alguna en relaci&oacute;n con dichas circunstancias.
	<br/>
		Gracias.
	<br/>
	<br/>
		 <b>DISCLAIMER</b>
	<br/>
		This message and the attached files are private and confidential and intended exclusively for the addressee. As such, JuanBarros.es informs to whom it may receive it in error that it contains privileged information and its use, copy or distribution is prohibited. If it  has been received by error, please notify us via e-mail or by telephone 654 639 155 Spain  and delete it immediately. JuanBarros.es expressly warns that the use of Internet e-mail neither guarantees the confidentiality of the messages nor its integrity and proper receipt, and ,therefore, JuanBarros.es does not assume any responsibilities for those circumstances.
	<br/>
		 Thank you.
	<td>
	</tr>	
						
	</table>
		</body>
			</html>
				';
			
	$headers = array ('From' => $_POST['Email'],
					  'Bcc' => 'juanbarrospazos@hotmail.es',
					  'Subject' => $_POST['Asunto']);
					  
		# datos del mensaje
		
				$destinatario= $_POST['Email'];
				$titulo= $_POST['Asunto']." ".$_POST['Nombre']." ".$_POST['Apellidos'].".";
				$responder= $_POST['Email'];
				$remite= $_POST['Email'];
				$remitente= "http://juanbarrospazos.blogspot.com.es/"; //sin tilde para evitar errores de servidor

				$separador = "_separador".md5 (uniqid (rand()));
		
				
		# cabeceras
		
				$cabecera = "Date: ".date("l j F Y, G:i")."\n";
				$cabecera .="MIME-Version: 1.0\n";
				$cabecera .="From: ".$remitente."<".$remite.">\n";
				$cabecera .="Bcc: juanbarrospazos@hotmail.es \n";
				$cabecera .="Return-path: ". $remite."\n";
				$cabecera .="Reply-To: ".$remite."\n";
				$cabecera .="X-Mailer: PHP/". phpversion()."\n";
				$cabecera .="Content-Type: multipart/mixed;"."\n";
				
				$cabecera .= " boundary=$separador"."\r\n\r\n";	/**/
				
				$texto_html ="\n"."--$separador"."\n";			/**/
				$texto_html .="Content-Type:text/html; charset=\"utf-8\""."\n";
				$texto_html .="Content-Transfer-Encoding: 7bit"."\r\n\r\n";
				
				# Añado la cadena que contiene el mensaje
				$texto_html .= $text_body;
				
				/* Le pasamos a la variable $mensaje el valor de $texto_html*/
				$mensaje= $texto_html;

				/* SOLO PARA ARCHIVOS ADJUNTOS. 
				Adjuntamos una imagen en el mensaje. 
				$adj1 = "\n"."--$separador"."\n"; 
				
				$adj1 .="Content-Type: image/gif;";
				$adj1 .=" name=\"Degra3A.gif\""."\n";
				$adj1 .="Content-Disposition: attachment; ";
				$adj1 .="filename=\"Degra3A.gif\""."\n";
				$adj1 .="Content-Transfer-Encoding: base64"."\r\n\r\n";
				
				$fp = fopen("Degra3A.gif", "r");
				$buff = fread($fp, filesize("Degra3A.gif"));
				fclose($fp);
				
				$adj1 .=chunk_split(base64_encode($buff));
				*/
								
				/* Le pasamos a la variable $mensaje el valor de $texto_html y $adj1, que es la imagen
				$mensaje= $texto_html.$adj1;
				*/
				
			if( mail($destinatario, $titulo, $mensaje, $cabecera)){
				
						print("<table align='center' style=\"margin-top:40px\">
								<tr>
									<td align='center'>
										<font color='#0080C0'>
											SUS DATOS HAN SIDO ENVIADOS.
											<br/>
											MUCHAS GRACIAS. ".$_POST['Nombre']."
										</font>
									</td>
								</tr>
								<tr>
									<td align='center'>
										<a href='Admin_Access.php'>
												Volver Admin Access.
										</a>
									</td>
								</tr>
							<table>
									");
						
							}else{
			print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr>
							<td align='center'>
								<font color='#FF0000'>
									EL MENSAJE NO HA PODIDO ENVIARSE,
									LO SENTIMOS MUCHO, ".$_POST['Nombre']."
									MUCHAS GRACIAS.
								</font>
							</td>
						</tr>
						<tr>
							<td align='center'>
								<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
									Contactos Juan Barros
								</a>
							</td>
						</tr>
						<tr>
							<td align='center'>
								<a href='Admin_Access.php'>
									Volver Admin Access.
								</a>
							</td>
						</tr>
					<table>
						");
														
					} /*Fin del if del mail*/
														
	 		}	/* Fin funcion process_Mail(); */
			
/////////////////////////////////////////////////////////////////////////////////////////////////
	
	require '../Inclu/Inclu_Footer.php';

/////////////////////////////////////////////////////////////////////////////////////////////////

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */

?>
