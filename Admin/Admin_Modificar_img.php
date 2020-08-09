<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

	$sqld =  "SELECT * FROM `admin` WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
 	
	$qd = mysqli_query($db, $sqld);
	
	$rowd = mysqli_fetch_assoc($qd);

///////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'XBPadmin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
							master_index();
					
							if ($_POST['oculto2']){
								show_form();
								}
							elseif($_POST['imagenmodif']){
								
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
												</br></br>
													CONSULTE SUS PERMISOS ADMINISTRATIVOS.
											</font>
										</td>
									</tr>
								</table>");
								
							}

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	$errors = array();

	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
	$extension = substr($_FILES['myimg']['name'],-3);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	$tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg']['type']);

		if($_FILES['myimg']['size'] == 0){
			$errors [] = "Ha de seleccionar una fotograf&iacute;a.";
			global $img2;
			$img2 = 'untitled.png';
		}
		 
		elseif(!$ext_correcta){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}

		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}

		elseif ($_FILES['myimg']['size'] > $limite){
		$tamanho = $_FILES['myimg']['size'] / 1024;
		$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 500 KBytes. ".$tamanho." KB";
		global $img2;
		$img2 = 'untitled.png';
			}
		
			elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				global $img2;
				$img2 = 'untitled.png';
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					global $img2;
					$img2 = 'untitled.png';
					}
					
		return $errors;
					
		}

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	
	global $safe_filename;
	
			$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
			$safe_filename = trim(str_replace('..', '', $safe_filename));

		  $nombre = $_FILES['myimg']['name'];
		  $nombre_tmp = $_FILES['myimg']['tmp_name'];
		  $tipo = $_FILES['myimg']['type'];
		  $tamano = $_FILES['myimg']['size'];
		  
			global $destination_file;
			$destination_file = 'img/'.$safe_filename;

			if( file_exists( 'img/'.$nombre) ){
							print("El archivo ".$nombre." ya existe, seleccione otra imagen.");
							show_form();
			}
			
			elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){

			// print("El archivo se ha guardado en: ".$destination_file);
					
	$file_old = "img/old_img.txt";
	$fw_old = fopen($file_old, 'r+');
	$fget_old = fgets($fw_old);
	$fget_old = trim($fget_old);
	fclose($fw_old);
	$_SESSION['img_old2'] = $fget_old;
	unlink ("img/Old".$_SESSION['img_old2']);
	unset ($_SESSION['img_old2']);
	
	if(file_exists('img/old_img.txt')){ unlink("img/old_img.txt");}
	copy("img/new_img.txt","img/old_img.txt");

	copy("img/".$_SESSION['borra_oldimg'],"img/Old".$_SESSION['borra_oldimg']);
	$_SESSION['img_old'] = "Old".$_SESSION['borra_oldimg'];

	unlink ("img/".$_SESSION['borra_oldimg']);

	
/////////////////////////////
	
	
	$file_new = "img/new_img.txt";
	$fw2 = fopen($file_new, 'w+');
	$img_new = $nombre;
	fwrite($fw2, $img_new);
	fclose($fw2);
	
	$_SESSION['img_new'] = $img_new;

			print("<table align='center' style=\"margin-top:20px\">
						<tr>
							<th colspan=3  class='BorderInf'>
								IMAGEN MODIFICADA.
							</th>
						</tr>
						
						<tr>
							<td width=200px>
								Nombre:
							</td>
							<td width=200px>"
								.$_SESSION['Nombre'].
							"</td>
						</tr>
						
						<tr>
							<td>
								Apellidos:
							</td>
							<td>"
								.$_SESSION['Apellidos'].
							"</td>
						</tr>
						<tr>				
							<td colspan='2' align='center' width='100px'>
		OLD IMG	<img src='img/".$_SESSION['img_old']."' height='120px' width='90px' />
								&nbsp; X &nbsp;
		NEW IMG	<img src='img/".$_SESSION['img_new']."' height='120px' width='90px' />
							</td>
						</tr>
		
					</table>"); 
					
			}else {
					print("No se ha podido guardar el archivo en el direcctorio img_admin/");
			}

	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	global $db; 	
	
	$file_old = "img/new_img.txt";
	$fw_old = fopen($file_old, 'r+');
	$fget_old = fgets($fw_old);
	$fget_old = trim($fget_old);
	fclose($fw_old);

	$_SESSION['borra_oldimg'] = $fget_old;	
	
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
		
	print("<table align='center' border=0 style='margin-top:22px;'>
			
				<tr>
					<th colspan=2 class='BorderInf'>
						SELECCIONE UNA NUEVA IMAGEN.
					</th>
				</tr>
				
				<tr>
					<th class='BorderInf'>
				LA IMAGEN ACTUAL DE : </br>".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".
					</th>
					<th class='BorderInf'>
						<img src='img/".$fget_old."' height='120px' width='90px' />
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
			
				<tr>
					<td>
							Seleccione una Fotografía:	
					</td>
					<td>
		<input type='file' name='myimg' value='myimg' />						
					</td>
				</tr>
				
				<tr align='center' height=60px>
					<td>
					</td>
					<td >
						<input type='submit' value='MODIFICAR LA IMAGEN' />
						<input type='hidden' name='imagenmodif' value=1 />
					</td>
					
					<td align='right'>
					</td>
					
		</form>														
				</tr>
				
			
			</table>	");

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Admin.php';
				
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	require '../Inclu/Admin_Inclu_02.php';
		
?>