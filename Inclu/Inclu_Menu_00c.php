<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8" />
<meta http-equiv="Content-Language" content="es-es">
<META NAME="Language" CONTENT="Spanish">

<meta name="description" content="Juan Manuel Barros Pazos, Descargas " />

<meta name="keywords" content="Juan Manuel Barros Pazos, Descargas " />
<meta name="robots" content="all, index, follow" />

<meta name="audience" content="All" />

<title>Juan Barros Pazos</title>
<link href="Css/Descargas.css" rel="stylesheet" type="text/css" />

<link href="favicon.ico" type='images/ico' rel='shortcut icon' />

<meta name="google-site-verification" content="eZH2zCJFS0R2mpv-pG5sLmYowSRSmDA48lBLzwfFj1I" />


<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
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

  <div id="head" style="padding-top:8px; padding-bottom:4px"> 
  			<font size='6'>
  							JUAN MANUEL BARR&Oacute;S PAZOS
            </font>
  	<br />
			<font size='2'>
    						PALMA DE MALLORCA.
          	</font>
  </div>
  <div style="clear:both"></div>
   
   <div style="margin-top:10px; text-align:center" id="TitTut">
   
	<font color="#59746A">
    
    <a href="http://juanbarrospazos.blogspot.com.es/" target="_blank">
                            PHP5 & SQL WEB CV ~ BLOG JUAN BARR&Oacute;S PAZOS
    </a>
    
        <br />
    
                <span id="hora">000000</span>
     
        <br />
    
    </font>
    
    
</div>
			  <div style="clear:both"></div>

  
<div id="Caja2tut">
  



