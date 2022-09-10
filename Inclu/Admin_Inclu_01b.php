<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8" />
<meta http-equiv="Content-Language" content="es-es">
<META NAME="Language" CONTENT="Spanish">

<!--
<meta name="viewport" content="width=device-width, initial-scale=1.0">
-->
<meta name="description" content="<?php print($_SESSION['title']." CV WEB"); ?>" />

<meta name="keywords" content="<?php print($_SESSION['title']." CV WEB"); ?>" />
<meta name="robots" content="all, index, follow" />

<meta name="audience" content="All" />

<title><?php print($_SESSION['title']." CV WEB"); ?></title>
<link href="../Css/Descargas.css" rel="stylesheet" type="text/css" />

<link href="../Admin/favicon.ico" type='image/ico' rel='shortcut icon' />

<meta name="google-site-verification" content="eZH2zCJFS0R2mpv-pG5sLmYowSRSmDA48lBLzwfFj1I" />


<script src="../MenuVertical/SpryMenuBar.js" type="text/javascript"></script>
<link href="../MenuVertical/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />

<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
<script type="text/JavaScript">

function limitat(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("titulo");
 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfot(maximoCaracteres) {
  var elemento = document.getElementById("titulo");
  var info = document.getElementById("infot");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+" caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}


</script>


<script type="text/JavaScript">

function limita(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("modulos");
 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfo(maximoCaracteres) {
  var elemento = document.getElementById("modulos");
  var info = document.getElementById("infom");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+" caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}

</script>


<script type="text/JavaScript">

function limitaa(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("academia");
 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfoa(maximoCaracteres) {
  var elemento = document.getElementById("academia");
  var info = document.getElementById("infoa");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+" caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}


</script>

<script type="text/JavaScript">

function limitac(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("coment");
 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfoc(maximoCaracteres) {
  var elemento = document.getElementById("coment");
  var info = document.getElementById("infoc");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+" caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}

</script>

</head>

<body topmargin="0">
<div id="Conte">

  <div id="head"> 
  			<font style="font-family:'Times New Roman', Times, serif; font-size:24px">
  				<?php 
				$title = $_SESSION['title'];
				print("".strtoupper($title)."."); ?>
            </font>
  	<br />
			<font style="font-family:'Times New Roman', Times, serif; font-size:16px">
  				<?php print("".$_SESSION['tdir'].$_SESSION['tmail'].$_SESSION['ttlf']); ?>
          	</font>
  </div>
  
  <div style="clear:both"></div>
   
   <div id="TitTut" style="margin-top:6px; text-align:center; font-family:'Times New Roman', Times, serif; font-size:14px">
            <font color="#59746A">
                    <b>
                        PHP5 & SQL WEB CV
            <br />
                        ESTÁ EN LA ZONA DE ADMINISTRACIÓN
                    </b>
            <br />
	</font>
</div>
			  <div style="clear:both"></div>
        

  <div id="Caja2Admin">


