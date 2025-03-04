<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../favicon.ico">
    <title>Formulario contacto</title>
</head>
<body>
    <a href="../index.php" class="back-home">
        <span class="home-icon">X</span>
        <span class="tooltip">Volver al inicio</span>
    </a>
    <form action="https://formsubmit.co/rodricarrera2.0@gmail.com" method="POST">
        <div class="animal-icon">🦁</div>
        <h2>Contacto</h2>
        <div class="input-group">
            <div class="input-container">
                <span class="input-icon"></span>
                <input type="text" id="name" name="name" placeholder="Nombre">
            </div>
            <div class="input-container">
                <span class="input-icon"></span>
                <input type="tel" id="phone" name="phone" placeholder="Telefono">
            </div>
            <div class="input-container">
                <span class="input-icon"></span>
                <input type="email" id="email" name="email" placeholder="E-mail">
            </div>
            <div class="input-container">
                <span class="input-icon"></span>
                <textarea id="message" name="message" cols="30" rows="5" placeholder="Mensaje"></textarea>
            </div>
            <div class="form-txt">
                <a href="#">Politica de privacidad</a>
                <a href="#">Terminos y condiciones</a>
            </div>
            <button type="submit" class="btn">
                <span>Enviar</span>
                <span class="btn-icon">🦊</span>
            </button>
            <input type="hidden" name="_next" value="http://127.0.0.1:5500/index.html">
            <input type="hidden" name="_captcha" value="false">
        </div>
    </form>
</body>
</html>