<?php

	$errors = array();
	
	if(strlen(trim($_POST['year'])) == 0){
		$errors [] = "Year: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['year'])) < 4){
		$errors [] = "Year: <font color='#FF0000'>Escriba más de tres carácteres.</font>";
		}
		
	if(strlen(trim($_POST['horas'])) == 0){
		$errors [] = "Horas: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	
	elseif (strlen(trim($_POST['horas'])) < 2){
		$errors [] = "Horas: <font color='#FF0000'>Escriba más de 1 carácter.</font>";
		}
		
	if(strlen(trim($_POST['titulo'])) == 0){
		$errors [] = "Titulo: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['titulo'])) < 11){
		$errors [] = "Titulo: <font color='#FF0000'>Escriba más de 10 carácteres.</font>";
		}
		
	if(strlen(trim($_POST['modulos'])) == 0){
		$errors [] = "Modulos: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['modulos'])) < 11){
		$errors [] = "Modulos: <font color='#FF0000'>Escriba más de 10 carácteres.</font>";
		}
		
	if ($_POST['sector'] == '') { 
		$errors [] = "Sector: <font color='#FF0000'>Seleccione un sector</font>";
		}	
		
	if ($_POST['sector2'] == '') { 
		$errors [] = "Sector 2: <font color='#FF0000'>Seleccione un sector</font>";
		}	
		
	if ($_POST['modalidad'] == '') { 
		$errors [] = "Modalidad: <font color='#FF0000'>Seleccione una modalidad</font>";
		}	


					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */
?>