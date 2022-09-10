<?php

    //require '../Conections/conexion_bbdd.php';
    global $email; 
    if(isset($_POST['Email'])){ $email= $_POST['Email']; } else { $email = ''; }
    global $usuario;
    if(isset($_POST['Usuario'])){ $usuario= $_POST['Usuario']; } else { $usuario = ''; }

    $sqld =  "SELECT * FROM `admin` WHERE `Email` = '$email' OR `Usuario` = '$usuario'";

    $qd = mysqli_query($db, $sqld);
    $rowd = mysqli_fetch_assoc($qd);
    global $num;
    $num = mysqli_num_rows($qd);

					 /* Creado por Juan Manuel Barrós Pazos 2008/2022 */

?>