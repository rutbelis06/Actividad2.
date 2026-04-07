<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URL_BASE; ?>public/css/style.css">
    <title>Iniciar Sesión</title>  
</head>
<body>
    <div class="container">
        <h2>INICIAR SESIÓN</h2>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert-success">
                <strong>¡Registro exitoso!</strong> Ya puedes iniciar sesión con tus credenciales.
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo URL_BASE; ?>index.php?action=login">
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" placeholder="usuario@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="********" required>
            </div>

            <button type="submit" class="btn-submit">Acceder</button>
        </form>

        <div class="footer-link">
            <p>¿No tienes cuenta? <a href="<?php echo URL_BASE; ?>index.php?action=register">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>