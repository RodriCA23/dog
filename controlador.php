<?php
if (!empty($_POST["btningresar"])){
    if(empty($_POST["name"]) and empty($_POST["password"])){
        echo "Los campos estan vacios";
    } else {
        $correo = $_POST["name"];
        $pass = $_POST["password"];
        $sql = $conexion->query("select * from datos where email='$correo' and pass='$pass'");
        if($datos=$sql->fetch_object()){
            $_SESSION['usuarioingresando'] = $correo;
            header("location: ../index.php");
        } else {
            echo "Nombre o contraseña incorrectos";
        }
    }
}
?>