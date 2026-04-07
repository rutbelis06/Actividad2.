<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="<?php echo URL_BASE; ?>public/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Hola <?php echo htmlspecialchars($_GET['user'] ?? 'Usuario'); ?> Bienvenido word</h2> 
        <br>
        <a href="<?php echo URL_BASE; ?>index.php?action=login" class="btn-submit" style="text-decoration:none; display:inline-block; text-align:center;">Cerrar Sesión</a>
    </div>
</body>
</html>