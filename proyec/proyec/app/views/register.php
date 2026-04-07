<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="<?php echo URL_BASE; ?>public/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Formulario de Registro</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert-error">
                <strong>Atención:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo URL_BASE; ?>index.php?action=register">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Ej: Jose" required>
            </div>
            <div class="form-group">
                <label>Apellido</label>
                <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Ej: Alvarez" required>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Cédula</label>
                    <input type="text" name="cedula" value="<?php echo $cedula; ?>" placeholder="V12345678" required>
                </div>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="direction" value="<?php echo $direction; ?>" placeholder="Calle, Sector, Nro Casa" required>
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="+584120000000" required>
            </div>
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" value="<?php echo $email; ?>" placeholder="usuario@gmail.com" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Mín. 8 caracteres, letras, números y símbolo" required>
            </div>
            <button type="submit" class="btn-submit">Registrar Usuario</button>
        </form>
        <div class="footer-link">
            <p>¿Ya tienes cuenta? <a href="<?php echo URL_BASE; ?>index.php?action=login">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>