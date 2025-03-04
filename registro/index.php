<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>Registro - Animal Kingdom</title>
</head>
<body>
    <a href="../index.php" class="back-home">
        <span class="home-icon">X</span>
        <span class="tooltip">Volver al inicio</span>
    </a>
    <form method="post" action="" autocomplete="off">
    <div class="container">
        <section class="form-register">
            <div class="form-header">
                <div class="animal-icon">🦁</div>
                <h2>Únete a nuestra manada</h2>
            </div>
            <?php 
            include "../conexion.php";
            include "../send.php";
            ?>
            <div class="input-group">
                <div class="input-container">
                    <span class="input-icon">🐾</span>
                    <input class="controls" type="text" name="name" id="name" placeholder="Ingrese su nombre">
                </div>
                
                <div class="input-container">
                    <span class="input-icon">🦊</span>
                    <input class="controls" type="email" name="email" id="email" placeholder="Ingrese su correo">
                </div>
                
                <div class="input-container">
                    <span class="input-icon">🦉</span>
                    <input class="controls" type="password" name="password" id="password" placeholder="Ingrese su contraseña">
                </div>

                <div class="input-container">
                    <span class="input-icon">🐾</span>
                    <input class="controls" type="tel" name="telefono" id="telefono" placeholder="Ingrese tu telefono">
                </div>
            </div>

            <div class="terms">
                <label class="checkbox-container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                    Estoy de acuerdo con los <a href="#">Términos y condiciones</a>
                </label>
            </div>

            <button class="submit-btn" type="submit" name="send" value="Enviar">
                <span class="btn-text">Unirme ahora</span>
                <span class="btn-icon">🐯</span>
            </button>

            <div class="login-link">
                <p>¿Ya eres parte de nuestra manada? <a href="../login/index.php">Inicia sesión</a></p>
            </div>
        </section>
    </div>
    </form>
    
</body>
</html>