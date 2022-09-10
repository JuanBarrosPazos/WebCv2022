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

<script type="text/javascript">

 function hora(){
 var fecha = new Date()
 
 var diames = fecha.getDate()

 var daytext = fecha.getDay()
 if (daytext == 0)
 daytext = "Domingo"
 else if (daytext == 1)
 daytext = "Lunes"
 else if (daytext == 2)
 daytext = "Martes"
 else if (daytext == 3)
 daytext = "Miercoles"
 else if (daytext == 4)
 daytext = "Jueves"
 else if (daytext == 5)
 daytext = "Viernes"
 else if (daytext == 6)
 daytext = "Sabado"
 
 var mes = fecha.getMonth() + 1
 
 var ano = fecha.getYear()
 
 if (fecha.getYear() < 2000) 
 ano = 1900 + fecha.getYear()
 else 
 ano = fecha.getYear()
 
 var hora = fecha.getHours()
 var minuto = fecha.getMinutes()
 var segundo = fecha.getSeconds()
 
 if(hora>=12 && hora<=23)
 m="P.M"
 else
 m="A.M"
 
 if (hora < 10) {hora = "0" + hora}
 if (minuto < 10) {minuto = "0" + minuto}
 if (segundo < 10) {segundo = "0" + segundo}
 
 var nowhora = daytext + " " + diames + " / " + mes + " / " + ano + " - " + hora + ":" + minuto + ":" + segundo
 document.getElementById('hora').firstChild.nodeValue = nowhora
 tiempo = setTimeout('hora()',1000)
 }
 </script>


</head>

<body topmargin="0" onload="hora()">


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

                       PHP5 & SQL WEB CV

            <br />
        
					<span id="hora">000000</span> 

		    <br />
                
		               ESTÁ EN LA ZONA DE ADMINISTRACIÓN
            
	        <br />
            
    </font>



</div>
			  <div style="clear:both"></div>

  <div id="Caja2Admin">

