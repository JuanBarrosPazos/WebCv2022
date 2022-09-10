<?php

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
					
	$vd = "INSERT INTO `$db_name`.`visitas` (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES (69, 0, 0, 0, 0)";

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
			  `sector` varchar(60) character set utf8 collate utf8_spanish_ci NULL,
			  `sector2` varchar(60) character set utf8 collate utf8_spanish_ci NULL,
			  `modalidad` varchar(22) character set utf8 collate utf8_spanish_ci NULL,
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
					
	$vd = "INSERT INTO `$db_name`.`secciones` (`id`, `valor`, `nombre`) VALUES ('0', '', 'ESPECIALIDAD')";
		
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

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */

?>