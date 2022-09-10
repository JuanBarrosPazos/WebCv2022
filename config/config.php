<?php

	//require '../Inclu/error_hidden.php';	
	require '../Inclu/Inclu_Menu_00c.php';
	if(isset($_POST['config'])){
							
	if($form_errors = validate_form()){	show_form($form_errors);
										require '../Inclu/Inclu_Footer.php';
																	} 
	else {	process_form();
			require '../Conections/conection.php';
			global $db;
			mysqli_report(MYSQLI_REPORT_OFF);
			@$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	
	if (!$db){ 	global $dbconecterror;
				@$dbconecterror = $dbname." * ".mysqli_connect_error()."\n"; 
				print ("<br/><font color='#FF0000'>NO CONECTA A BBDD ".$db_name."</br>".mysqli_connect_error()."/font");
						show_form();
						require '../Inclu/Inclu_Footer.php';
			}else{	crear_tablas();
					require '../Inclu/Inclu_Footer.php';
					}
			}

	} else {show_form();
			require '../Inclu/Inclu_Footer.php';
							}

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){

	//error_reporting (0);

	require 'config/validate_Index.php';

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

	require 'config/crea_tablas.php';
	
				
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
	
	if(isset($_POST['config'])){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'host' => '',
									'user' => '',
									'pass' => '',
									'name' => '',
														);
								   }
	
		require 'config/index_showform.php';
	
	}	

////////////////////////////////////////////////

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */

?>