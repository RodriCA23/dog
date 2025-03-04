<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../favicon.ico">
    <title>Formulario Login</title>
</head>
<body>
    <a href="../index.php" class="back-home">
        <span class="home-icon">X</span>
        <span class="tooltip">Volver al inicio</span>
    </a>
    <form class="form" method="post" action="">
        <div class="animal-icon">🦊</div>
        <h2 class="form_title">Bienvenido de nuevo</h2>
        <p class="form_paragraph">¿Aun no tienes una cuenta? <a href="../registro/index.php" class="form_link">Únete a nuestra manada</a></p>
        <?php 
        include "../conexion.php"; 
        include "../controlador.php"; 
        ?>     
        <div class="form_container">
                <div class="form_group">
                    <span class="input-icon">🐾</span>
                    <input type="text" id="name" class="form_input" name="name" placeholder="Ingrese su nombre">
                    <span class="form_line"></span>
                </div>
            
                <div class="form_group">
                    <span class="input-icon">🦉</span>
                    <input type="password" id="password"  name="password" class="form_input" placeholder="Ingrese su contraseña">
                    <span class="form_line"></span>
                </div>
                <button name="btningresar" type="submit" class="form_submit" value="Entrar">
                    <span>Ingresar</span>
                    <span class="btn-icon">🦁</span>
                </button>
            </div>
    </form>
</body>
</html>