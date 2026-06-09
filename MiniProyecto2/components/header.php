<?php
/**
 * header.php - Componente reutilizable de encabezado.
 *
 * Genera la estructura HTML inicial de cada página, incluyendo
 * el <head> con meta tags, enlace al CSS y el banner superior.
 *
 * Variables esperadas:
 *   $titulo (string) - Título de la página actual.
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mini Proyecto - Desarrollo Web VII">
    <title><?php echo Utilidades::escapar($titulo ?? 'Mini Proyecto'); ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<!-- ═══ Banner superior ═══ -->
<header class="header">
    <h1>🎓 Mini Proyecto - Desarrollo Web VII</h1>
    <p>Arquitectura MVC &middot; PHP Puro &middot; PSR-1</p>
</header>
