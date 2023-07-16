<?php

    global $valor;
    if(isset($_POST['valor'])){ $valor = $_POST['valor']; }
    elseif(isset($_POST['valor2'])){ $valor = $_POST['valor2']; }
    else{ }

    global $trid;
    if (isset($crear)){ $trid = ""; }
    else { $trid = "<tr><td width=120px>ID:</td><td width=160px>".$_POST['id']."</td></tr>"; }

    global $tabla;
    $tabla= "<table align='center'>
                    <tr>
                        <th colspan=2  class='BorderInf'>".$titulo."</th>
                    </tr>
                    ".$trid."
                    <tr>
                        <td>Valor:</td>
                        <td>".$valor."</td>
                    </tr>
                    <tr>
                        <td>Nombre:</td>
                        <td>".$_POST['nombre']."</td>
                    </tr>
                    <tr>
                        <th colspan=2 class='BorderInf'>
                            <form name='modifica' action='".$titmod3a."' method='POST'>
                                <input type='hidden' name='todo' value=1 />
                                <input type='submit' value='".$titmod3."' />
                            </form>
                        </th>
                    </tr>
                </table>";	

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */

?>