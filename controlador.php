<?php
if (!empty($_POST["btningresar"])){
    if(empty($_POST["name"]) and empty($_POST["password"])){
        echo "Los campos estan vacios";
    } else {
        $name = $_POST["name"];
        $pass = $_POST["password"];
        $sql = $conexion->query("select * from datos where nombre='$name' and pass='$pass'");
        if($datos=$sql->fetch_object()){
            header("location: ../index.php");
        } else {
            echo "Nombre o contraseña incorrectos";
        }
    }
}
?>