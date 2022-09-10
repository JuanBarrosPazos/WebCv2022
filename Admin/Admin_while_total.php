<?php

if(!$qb){
    print("<font color='#FF0000'>Se ha producido un error: </form><br/>".mysqli_error($db)."<br/>");
    
} else {
    
    if(mysqli_num_rows($qb)== 0){
                    print ("No hay datos.");
                    //show_form();	

        } else { print ("<table align='center'>

                            <tr>
                                <td colspan=7 class='BorderInf'></td>
                                <td colspan=3 class='BorderInf'>
                                    <form name='modifica' action='Admin_Crear.php' method='POST'>
                                        <input type='submit' value='CREAR NUEVO ADMINISTRADOR' />
                                    </form>
                                </td>
                                <td colspan=3 class='BorderInf'>
                                    <form name='modifica' action='Admin_Modificar_img.php' method='POST'>
                                        <input type='submit' value='MODIFICAR IMAGEN FRONT PAGE' />
                                    </form>
                                </td>
                            </tr>

                            <tr>
                                <th colspan=13 class='BorderInf'>
                                        TODOS LOS ADMIN EN TUTORIALES.
                                </th>
                            </tr>
                            
                            <tr>
                                <th class='BorderInfDch'>
                                    ID
                                </th>
                                
                                <th class='BorderInfDch'>
                                    Nombre
                                </th>
                                
                                <th class='BorderInfDch'>
                                    Apellidos
                                </th>
                                
                                <th class='BorderInfDch'>
                                    DNI/NIE
                                </th>
                                
                                <th class='BorderInfDch'>
                                    N&uacute;mero
                                </th>
                                
                                <th class='BorderInfDch'>
                                    Control
                                </th>
                                
                                <th class='BorderInfDch'>
                                    Email
                                </th>
                                
                                <th class='BorderInfDch'>
                                    Usuario
                                </th>
                                
                                <th class='BorderInfDch'>
                                    Password
                                </th>
                                
                                <th class='BorderInfDch'>
                                    Dirección
                                </th>
                                
                                <th class='BorderInfDch'>
                                    Telf. 1
                                </th>
                                
                                <th class='BorderInfDch'>
                                    Telf.2
                                </th>
                                
                                <th class='BorderInf'>
                                    
                                </th>
                                
                            </tr>");
    
    while($rowb = mysqli_fetch_assoc($qb)){
     
        print (	"<tr align='center'>
                <form name='modifica' action='Admin_Modificar_02.php' method='POST'>
                    <td class='BorderInfDch'>
                                                    ".$rowb['ID']."
                                            </td>
                                            
                                            <td class='BorderInfDch'>
                                                    ".$rowb['Nombre']."
                                            </td>
                                                
                                            <td class='BorderInfDch'>
                                                    ".$rowb['Apellidos']."
                                            </td>
                                            
                                            <td class='BorderInfDch'>
                                                    ".$rowb['doc']."
                                            </td>
                                                                    
                                            <td class='BorderInfDch'>
                                                    ".$rowb['dni']."
                                            </td>
                                                                        
                                            <td class='BorderInfDch'>
                                                    ".$rowb['ldni']."
                                            </td>
                                            
                                            <td class='BorderInfDch'>
                                                    ".$rowb['Email']."
                                            </td>
                                            
                                            <td class='BorderInfDch'>
                                                    ".$rowb['Usuario']."
                                            </td>
                                            
                                            <td class='BorderInfDch'>
                                                    ".$rowb['Password']."
                                            </td>
                                            
                                            <td class='BorderInfDch'>
                                                    ".$rowb['Direccion']."
                                            </td>
                                            
                                            <td class='BorderInfDch'>
                                                    ".$rowb['Tlf1']."
                                            </td>
                                            
                                            <td class='BorderInfDch'>
                                                    ".$rowb['Tlf2']."
                                            </td>
                                            
                                        ");
                        require 'Admin_row_total.php';
                                    print("
                                        <td class='BorderInf'>
                                                <input type='submit' value='MODIF. DATOS' />
                                                <input type='hidden' name='oculto2' value=1 />
                                            </form>
                                    <form name='modifica' action='Admin_Borrar_02.php' method='POST'>");
                        require 'Admin_row_total.php';
                                    print("											
                                        <input type='submit' value='BORRA ADMIN' />
                                        <input type='hidden' name='oculto2' value=1 />
                                    </form>
                                        </td>
                                    </tr>");
            
                                } // Fin del While

                print("</table>");
    
                } 

    } // Fin else

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */

?>