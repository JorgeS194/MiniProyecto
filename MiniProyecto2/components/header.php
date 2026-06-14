<?php
/**
 * header.php - Componente reutilizable de encabezado.
 *
 * Genera la estructura HTML inicial de cada página, incluyendo
 * el <head> con meta tags, enlace al CSS, fuentes premium de Google Fonts
 * y el banner superior.
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
    <meta name="description" content="Mini Proyecto - Desarrollo de Software VII">
    <title><?php echo Utilidades::escapar($titulo ?? 'Mini Proyecto'); ?></title>
    <!-- Fuentes premium de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<!-- ═══ Banner superior ═══ -->
<header class="header">
    <h1>🎓 Mini Proyecto - Desarrollo de Software VII</h1>
    <p>Arquitectura MVC &middot; PHP Puro &middot; PSR-1 &middot; OWASP &middot; DRY</p>
</header>
