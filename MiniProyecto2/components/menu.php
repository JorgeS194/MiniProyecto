<?php
/**
 * menu.php - Componente del menú principal.
 *
 * Muestra una cuadrícula de tarjetas con enlaces a los 9 problemas.
 * Utiliza un array asociativo y un bucle para evitar repetición (DRY).
 */

// Definición de los 9 problemas con título y descripción corta.
$problemas = [
    1 => ['titulo' => 'Problema 1', 'descripcion' => 'Calcular media, desviación estándar, mínimo y máximo de 5 números positivos.'],
    2 => ['titulo' => 'Problema 2', 'descripcion' => 'Calcular la suma de los números del 1 al 1000.'],
    3 => ['titulo' => 'Problema 3', 'descripcion' => 'Imprimir los N primeros múltiplos de 4.'],
    4 => ['titulo' => 'Problema 4', 'descripcion' => 'Descripción pendiente del Problema 4.'],
    5 => ['titulo' => 'Problema 5', 'descripcion' => 'Descripción pendiente del Problema 5.'],
    6 => ['titulo' => 'Problema 6', 'descripcion' => 'Descripción pendiente del Problema 6.'],
    7 => ['titulo' => 'Problema 7', 'descripcion' => 'Descripción pendiente del Problema 7.'],
    8 => ['titulo' => 'Problema 8', 'descripcion' => 'Descripción pendiente del Problema 8.'],
    9 => ['titulo' => 'Problema 9', 'descripcion' => 'Descripción pendiente del Problema 9.'],
];
?>

<!-- ═══ Menú principal con cuadrícula de tarjetas ═══ -->
<main class="container">
    <h2>📋 Seleccione un problema</h2>

    <div class="menu-grid">
        <?php foreach ($problemas as $numero => $info): ?>
            <a href="index.php?problema=<?php echo $numero; ?>" class="card">
                <span class="card-numero">#<?php echo $numero; ?></span>
                <span class="card-titulo"><?php echo Utilidades::escapar($info['titulo']); ?></span>
                <span class="card-desc"><?php echo Utilidades::escapar($info['descripcion']); ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</main>
