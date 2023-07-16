<?php

	$file_img = "img/new_img.txt";
	$fw_img = fopen($file_img, 'r+');
	$fget_img = fgets($fw_img);
	$fget_img = trim($fget_img);
	fclose($fw_img);
	$_SESSION['img_img'] = $fget_img;
	
		print("<div id=\"foto\">
					<img src=\"img/".$fget_img."\"  width='110' height='158' alt='Juan Barros Pazos' /> 
				</div>

			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='FILTRAR CONSULTA' />
						<input type='hidden' name='oculto' value=1 />
					</td>
					<td align='left'>

	<select name='sector'>");
				
	global $db;
	$sqlb =  "SELECT * FROM `secciones` ORDER BY `valor` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['valor']."' ");
					
					if($rows['valor'] == $defaults['sector']){
															print ("selected = 'selected'");
																								}
													print ("> ".$rows['nombre']." </option>");
												}
											} 
						
	print ("	</select>
					</td>
					<td align='left'>
						<select name='Orden'>");
						
				foreach($ordenar as $option => $label){
					print ("<option value='".$option."' ");
					if($option == $defaults['Orden']){	print ("selected = 'selected'");}
														print ("> $label </option>");
												}	
	print ("	</select>
					</td>
				</tr>
					</form>	
				</table>");


					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */
?>