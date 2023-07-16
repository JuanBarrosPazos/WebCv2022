<?php

	global $db;
	global $db_name;
	global $valor;
	$valor = $_POST['tabla'];
	global $valort;
	$valort = "`".$valor."`";
	global $datein;
	$datein = date('Y.m.d_H.i');
//	$datein = date('Y.m.d');
	
//	print("* EXPORTADA TABLA: ".strtoupper($db_name." => ".$valor).".");

	global $id;
	global $campo;
	global $texc;
	global $c3;
	global $c4;
	global $numr;
	if (trim($_POST['tabla']) == "admin" ){
		$campo = 'ID,Nivel,Nombre,Apellidos,doc,dni,ldni,Email,Usuario,Password,Direccion,Tlf1,Tlf2';
		$texc = '`ID`, `Nivel`, `Nombre`, `Apellidos`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`';
		$id = "`ID`";
$c3 = "\n\t`ID` int(4) NOT NULL AUTO_INCREMENT,
\t`Nivel` varchar(8) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'XBPadmin',
\t`Nombre` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
\t`Apellidos` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
\t`doc` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
\t`dni` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
\t`ldni` varchar(1) COLLATE utf8_spanish2_ci NOT NULL,
\t`Email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
\t`Usuario` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
\t`Password` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
\t`Direccion` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
\t`Tlf1` int(9) NOT NULL,
\t`Tlf2` int(9) NOT NULL,
\tUNIQUE KEY `ID` (`ID`),
\tUNIQUE KEY `Email` (`Email`),
\tUNIQUE KEY `Usuario` (`Usuario`)";
	$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qc = mysqli_query($db, $sqlc);
			while($rowc = mysqli_fetch_row($qc)){
				global $numr;
				$numr = ($rowc[0]+1);}
$c4 = "\nENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
				}	
	if (trim($_POST['tabla']) == "modalidad" ){
		$campo = 'id,valor,nombre';
		$texc = '`id`, `valor`, `nombre`';
		$id = "`id`";
$c3 = "\n\t`id` int(3) NOT NULL AUTO_INCREMENT,
\t`valor` varchar(22) COLLATE utf8_spanish2_ci NOT NULL,
\t`nombre` varchar(22) COLLATE utf8_spanish2_ci NOT NULL,
\tPRIMARY KEY (`id`),
\tUNIQUE KEY `id` (`id`,`valor`,`nombre`)";
	$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qc = mysqli_query($db, $sqlc);
			while($rowc = mysqli_fetch_row($qc)){
				global $numr;
				$numr = ($rowc[0]+1);}
$c4 = "\nENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
				}	
	if (trim($_POST['tabla']) == "secciones" ){
		$campo = 'id,valor,nombre';
		$texc = '`id`, `valor`, `nombre`';
		$id = "`id`";
$c3 = "\n\t`id` int(3) NOT NULL AUTO_INCREMENT,
\t`valor` varchar(22) COLLATE utf8_spanish2_ci NOT NULL,
\t`nombre` varchar(22) COLLATE utf8_spanish2_ci NOT NULL,
\tPRIMARY KEY (`id`),
\tUNIQUE KEY `id` (`id`,`valor`,`nombre`)";
	$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qc = mysqli_query($db, $sqlc);
			while($rowc = mysqli_fetch_row($qc)){
				global $numr;
				$numr = ($rowc[0]+1);}
$c4 = "\nENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
				}	
	if (trim($_POST['tabla']) == "visitas" ){
		$campo = 'idv,visita,admin,deneg,acceso';
		$texc = '`idv`, `visita`, `admin`, `deneg`, `acceso`';
		$id = "`idv`";
$c3 = "\n\t`idv` int(2) NOT NULL,
\t`visita` int(10) NOT NULL,
\t`admin` int(10) NOT NULL,
\t`deneg` int(10) NOT NULL,
\t`acceso` int(10) NOT NULL,
\tPRIMARY KEY (`idv`)";
	$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qc = mysqli_query($db, $sqlc);
			while($rowc = mysqli_fetch_row($qc)){
				global $numr;
				$numr = ($rowc[0]+1);}
$c4 = "\nENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci";
				}	
	if (trim($_POST['tabla']) == "web_cv" ){
		$campo = 'id,year,horas,sector,sector2,modalidad,titulo,modulos,academia,coment';
		$texc = '`id`, `year`, `horas`, `sector`, `sector2`, `modalidad`, `titulo`, `modulos`, `academia`, `coment`';
		$id = "`id`";
$c3 = "\n\t`id` int(4) NOT NULL AUTO_INCREMENT,
\t`year` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
\t`horas` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
\t`sector` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
\t`sector2` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
\t`modalidad` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
\t`titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
\t`modulos` varchar(340) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
\t`academia` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
\t`coment` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
\tPRIMARY KEY (`id`)";
	$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qc = mysqli_query($db, $sqlc);
			while($rowc = mysqli_fetch_row($qc)){
				global $numr;
				$numr = ($rowc[0]+1);}
$c4 = "\nENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
				}	

global $filename;
$filename = "bbdd/T_".$valor."_".$datein.".sql";

	$sqlb =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qb = mysqli_query($db, $sqlb);
	global $numr;
	global $nentradas;
	$nentradas = mysqli_num_rows($qb);
	//$_SESSION['numr'] = $numr;
		if(!$qb){
	print("<font color='#FF0000'>Se ha producido un error: </form><br/>".mysqli_error($db)."<br/>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){
							print ("No hay datos.");
				} else { 
			
			$campos = explode(',',$campo);
			$count = count($campos);
				
			print ("<table align='center' width='auto'>
						<tr>
							<th colspan=".$count." class='BorderInf'>
				UPDATE OK. || BBDD: ".strtoupper($db_name)." || TABLA: ".strtoupper($valor)."
							</th>
						</tr>
						<tr>");
						
				print("<td>* Nº Campos:".$count.".<br/>||  ");
				for($a=0; $c=$count, $a<$c; $a++){
				print($campos[$a]." || ");
					}
				print("<br/>* Nº Entradas: ".$nentradas." &nbsp; * Nº Id. Max: ".($numr-1)."
				<br/>* Ruta Documento: ".$filename."</td>");
									
			for($a=0; $c=$count, $a<$c; $a++){
				//print(	"<td class='BorderInfDch'>".$campos[$a]."</td>");
					}
				print("</tr>");
									
//$_SESSION['ruta'] = $filename;
$fh = fopen($filename,'w+');
$c1 ='SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";';
$c2 ='SET time_zone = "+00:00";';
$linec = "\n-- Servidor: ".$_SERVER['SERVER_NAME'].
"\n-- Tiempo de generación: ".date('Y/m/d')." a las ".date('H:i:s').
"\n-- Versión del servidor: ".$_SERVER['SERVER_SOFTWARE'].
"\n\n".$c1."\n".$c2."\n
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
\n--\n-- Base de datos: `".$db_name."`\n--
\n-- --------------------------------------------------------
\n--\n-- Estructura de tabla para la tabla `".$valor."`\n--\n
CREATE TABLE IF NOT EXISTS `".$valor."` (".$c3."}".$c4.";
\n--\n-- Volcado de datos para la tabla `".$valor."`\n--\n";
		$line0 = "\nINSERT INTO `".$valor."` (";
		$line1 = ") VALUES";
		$line = $linec.$line0.$texc.$line1;
fwrite($fh, $line);
fclose($fh);

			while($rowb = mysqli_fetch_row($qb)){
				//$_SESSION['numr'] = ($rowb[0]+1);
$fh = fopen($filename,'ab+');
		$line0 = "\n(";
fwrite($fh, $line0);
fclose($fh);
				//print (	"<tr align='center'>");
					for($i=0; $c=$count, $i<$c; $i++){
				//	print(	"<td class='BorderInfDch'>".$rowb[$i]."</td>");
$fh = fopen($filename,'ab+');
		$line2 = "'".$rowb[$i]."', ";
fwrite($fh, $line2);
fclose($fh);
						 }
$fh = fopen($filename,'ab+');
		$line3 = "),";
fwrite($fh, $line3);
fclose($fh);
						//print("	</tr>")
						;}
						 
$fh = fopen($filename,'ab+');
		$line3 = ";\n
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
fwrite($fh, $line3);
fclose($fh);
				} 
					print("</table>");
					
			} 

$line = file_get_contents($filename);
$line = str_replace(', ),','),',$line);
$line = str_replace('),;',');',$line);
$fh = fopen($filename,'w+');
fwrite($fh, $line);

global $d;
global $data;
global $tot;
$tot[$d] = @$data[$d];
//print($_SESSION['numr']);

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */
					 
?>