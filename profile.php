<?php
    session_start();
    include("conexion.php");

    // Verificar si el usuario ha iniciado sesión
    if(!isset($_SESSION['usuarioingresando'])){
        header("location: login/index.php");
        exit();
    }

    $usuarioingresando = $_SESSION['usuarioingresando'];
    $buscandousu = mysqli_query($conexion, "SELECT * FROM datos WHERE email = '".$usuarioingresando."'");
    $mostrar = mysqli_fetch_array($buscandousu);
    $rol = $mostrar['rol'];

    // Procesar eliminación de usuario si es admin
    if($rol === 'admin' && isset($_POST['eliminar_usuario'])) {
        $usuario_id = $_POST['usuario_id'];
        $eliminar = mysqli_query($conexion, "DELETE FROM datos WHERE email = '$usuario_id' AND email != '$usuarioingresando'");
        if($eliminar) {
            echo "<script>alert('Usuario eliminado correctamente');</script>";
        }
    }

    // Procesar edición de usuario si es admin
    if($rol === 'admin' && isset($_POST['editar_usuario'])) {
        $usuario_id = $_POST['editar_usuario_id'];
        $usuario_data = mysqli_query($conexion, "SELECT * FROM datos WHERE email = '$usuario_id'");
        $editar_usuario = mysqli_fetch_array($usuario_data);
    }

    // Procesar actualización de usuario por admin
    if($rol === 'admin' && isset($_POST['actualizar_usuario'])) {
        $usuario_id = $_POST['usuario_id'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $nuevo_rol = $_POST['rol'];
        
        $actualizar = mysqli_query($conexion, "UPDATE datos SET 
            nombre = '$nombre',
            telefono = '$telefono',
            rol = '$nuevo_rol'
            WHERE email = '$usuario_id'");

        if($actualizar) {
            echo "<script> window.location.href='profile.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar los datos');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Adopta un Amigo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.ico">
    <style>
        .profile-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
        }
        .profile-form {
            display: grid;
            gap: 1rem;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .save-button {
            background: #27ae60;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            margin-top: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .save-button:hover {
            background: #219a52;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .users-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .users-table th,
        .users-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #000000;
        }
        .users-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #000000;
        }
        .delete-button {
            background: #e74c3c;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            margin-left: 0.5rem;
        }
        .delete-button:hover {
            background: #c0392b;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .users-table td:last-child {
            text-align: right;
            white-space: nowrap;
        }
        .users-table td:last-child form {
            display: inline-block;
            margin-left: 8px;
        }
        .users-table td:last-child form:first-child {
            margin-left: 0;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <span class="logo-text"></span>
            </div>
            <ul class="nav-links">
                <li><a href="#"><?php echo isset($_SESSION['usuarioingresando']) ? explode(' ', $mostrar['nombre'])[0] : 'Inicio de sesion'; ?></a></li>
                <li><a href="./contacto/index.php">Contacto</a></li>
                <li><a href="./cerrar_session.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <div class="profile-container">
        <div class="profile-header">
            <h1>Mi Perfil</h1>
            <p>Gestiona tu información personal</p>
        </div>

        <?php if($rol === 'admin'): ?>
            <?php if(isset($editar_usuario)): ?>
                <h2>Editar Usuario</h2>
                <form class="profile-form" method="post" action="">
                    <input type="hidden" name="usuario_id" value="<?php echo $editar_usuario['email']; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre completo</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $editar_usuario['nombre']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" value="<?php echo $editar_usuario['email']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" value="<?php echo isset($editar_usuario['telefono']) ? $editar_usuario['telefono'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select id="rol" name="rol" class="form-control">
                            <option value="user" <?php echo $editar_usuario['rol'] === 'user' ? 'selected' : ''; ?>>Usuario</option>
                            <option value="admin" <?php echo $editar_usuario['rol'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                        </select>
                    </div>
                    <button type="submit" class="save-button" name="actualizar_usuario">Guardar cambios</button>
                    <a href="profile.php" class="delete-button" style="text-decoration: none; display: inline-block; margin-left: 10px; text-align: center;">Cancelar</a>
                </form>
            <?php else: ?>
                <h2>Gestión de Usuarios</h2>
                <table class="users-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $usuarios = mysqli_query($conexion, "SELECT * FROM datos");
                    while($usuario = mysqli_fetch_array($usuarios)) {
                        echo "<tr>";
                        echo "<td>".$usuario['nombre']."</td>";
                        echo "<td>".$usuario['email']."</td>";
                        echo "<td>".$usuario['telefono']."</td>";
                        echo "<td>".$usuario['rol']."</td>";
                        echo "<td>";
                        // Solo permitir eliminar otros usuarios, pero editar todos
                        echo "<form method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='editar_usuario_id' value='".$usuario['email']."'>";
                        echo "<button type='submit' name='editar_usuario' class='save-button'><svg width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7'></path><path d='M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z'></path></svg>Editar</button>";
                        echo "</form>";
                        if($usuario['email'] !== $usuarioingresando) {
                            echo "<form method='post' style='display:inline;'>";
                            echo "<input type='hidden' name='usuario_id' value='".$usuario['email']."'>";
                            echo "<button type='submit' name='eliminar_usuario' class='delete-button'><svg width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg>Eliminar</button>";
                            echo "</form>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php endif; ?>
        <?php else: ?>
            <form class="profile-form" method="post" action="">
                <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $mostrar['nombre']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" value="<?php echo $mostrar['email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" value="<?php echo isset($mostrar['telefono']) ? $mostrar['telefono'] : ''; ?>">
                </div>
            
                <button type="submit" class="save-button" name="actualizar">Guardar cambios</button>
            </form>

            <?php
            if(isset($_POST['actualizar'])) {
                $nombre = $_POST['nombre'];
                $telefono = $_POST['telefono'];
                

                $actualizar = mysqli_query($conexion, "UPDATE datos SET 
                    nombre = '$nombre',
                    telefono = '$telefono'
                    WHERE email = '$usuarioingresando'");

                if($actualizar) {
                    echo "<script>alert('Datos actualizados correctamente'); window.location.href='profile.php';</script>";
                } else {
                    echo "<script>alert('Error al actualizar los datos');</script>";
                }
            }
            ?>
        <?php endif; ?>
    </div>

    <footer>
        <p>Contáctanos: adopta@gmail.com</p>
        <p>&copy; 2024 Adopta un Amigo</p>
    </footer>
</body>
</html>