<?php
// Inicia la sesión actual
session_start();

// Destruye todas las variables de sesión y cierra la sesión actual
session_destroy();

// Redirige al usuario a la página de inicio (index.php)
header("Location: index.php");

// Finaliza la ejecución del script para asegurarse de que no se ejecute más código
exit;
?>
