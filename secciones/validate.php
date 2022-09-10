<?php

	global $valor;
	if(isset($_POST['valor'])){ $valor = $_POST['valor'];}
	elseif(isset($_POST['valor2'])){ $valor = $_POST['valor2']; }
	else { }

	$errors = array();

	if(strlen(trim($valor)) == 0){
		$errors [] = "Valor: <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($valor)) < 3){
		$errors [] = "Valor: <font color='#FF0000'>Más de 2 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^ @#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$valor)){
		$errors [] = "Valor: <font color='#FF0000'>Solo texto.</font>";
		}
		
	elseif (!preg_match('/^[a-z0-9\s_]+$/',$valor)){
		$errors [] = "Valor: <font color='#FF0000'>Solo minusculas sin acentos.</font>";
		}

	
	if(strlen(trim($_POST['nombre'])) == 0){
		$errors [] = "Nombre: <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['nombre'])) < 3){
		$errors [] = "Nombre: <font color='#FF0000'>Más de 2 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['nombre'])){
		$errors [] = "Nombre: <font color='#FF0000'>Solo texto.</font>";
		}
		
	elseif (!preg_match('/^[A-Z0-9\s_]+$/',$_POST['nombre'])){
		$errors [] = "Nombre: <font color='#FF0000'>Solo mayusculas sin acentos.</font>";
		}

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */

?>