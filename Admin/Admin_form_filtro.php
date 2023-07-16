<?php

	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=3 width=100%>
						Busqueda de Administradores.
					</th>
				</tr>

			<!-- INICIO FORMULARIO FILTRO DE USUARIOS -->
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='Realizar Consulta' />
						<input type='hidden' name='oculto' value=1 />
					</td>
					<td>	
						Nombre:
					</td>
					<td>
	<input type='text' name='Nombre' size=20 maxlenth=10 value='".@$defaults['Nombre']."' />
					</td>
				</tr>
	
				<tr>
					<td>
					</td>
					<td>	
						Apellido:
					</td>
					<td>
	<input type='text' name='Apellidos' size=20 maxlenth=10 value='".@$defaults['Apellidos']."' />
					</td>
				</tr>
	
				<tr>
					<td>
					</td>
					<td>	
						Ordenar Por:
					</td>
					<td>

						<select name='Orden'>");
						
				foreach($ordenar as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['Orden']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("	</select>
					</td>
				</tr>
		</form>	
        <!-- FIN FORMULARIO FILTRO USUARIOS -->
		
        <!-- INICIO FORMULARIO VER TODOS LOS USUARIOS -->
		<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
				<tr>
					<td align='center'>
						<input type='submit' value='Ver Todos los Administradores' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td>	
						Ordenar Por:
					</td>
					<td>
						<select name='Orden'>");
				foreach($ordenar as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['Orden']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
	print ("	</select>
					</td>
				</tr>
		</form>
        <!-- FIN FORMULARIO VER TODOS LOS USUARIOS -->

			</table>"); 

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */

?>