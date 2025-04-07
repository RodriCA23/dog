<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("conexion.php");

if(isset($_POST['send'])){
    // Validate all required fields
    if(strlen($_POST['name']) >= 1 && 
       strlen($_POST['email']) >= 1 && 
       strlen($_POST['password']) >= 1 && 
       strlen($_POST['telefono']) >= 1
    ){
        // Clean input data
        $nombre = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $telefono = trim($_POST['telefono']);
        $fecha = date('Y-m-d');
        
        // Check connection
        if (!$conexion) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $query = "INSERT INTO datos(nombre, email, pass, telefono,rol ,fecha) 
                 VALUES ('$nombre', '$email', '$password', '$telefono','user','$fecha')";
        
        $result = mysqli_query($conexion, $query);
        
        if(!$result){
            $_SESSION['message'] = 'Error al insertar';
            $_SESSION['message_type'] = 'error';
            echo "<h3 class='error'>Error Al insertar: " . mysqli_error($conexion) . "</h3>";
        } else {
            $_SESSION['message'] = 'Registro Guardado';
            $_SESSION['message_type'] = 'success';
            header("location: index.php");
        }
    } else {
        echo "<h3 class='error'>Llena todos los campos</h3>";
    }
}
?>