<?php
/**
 * problema8.php - Vista del Problema 8.
 *
 * Muestra el formulario de entrada para el Problema 8 y, cuando
 * el controlador ya procesó los datos (POST), presenta el resultado
 * o la lista de errores de validación.
 *
 * Variables disponibles inyectadas por Utilidades::renderVista():
 *   $resultado (string|null) - Resultado del procesamiento.
 *   $errores   (array)       - Lista de mensajes de error de validación.
 *   $dato1     (string)      - Último valor enviado (para repoblar el input).
 */
?>

<main class="container">

    <?php Utilidades::volverMenu(); ?>

    <h2>Problema 8</h2>
    <p class="subtitulo">Descripción del problema pendiente de implementación.</p>

    <?php if (!empty($errores)): ?>
        <div class="error-box" style="text-align:left; margin-bottom:1rem;">
            <strong>⚠️ Por favor corrige los siguientes errores:</strong>
            <ul style="margin-top:.5rem; padding-left:1.25rem;">
                <?php foreach ($errores as $e): ?>
                    <li><?php echo Utilidades::escapar($e); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?problema=8" id="formProblema8">
        <div class="form-group">
            <label for="dato1">Dato de entrada:</label>
            <input
                type="text"
                id="dato1"
                name="dato1"
                placeholder="Ingrese un valor numérico"
                value="<?php echo Utilidades::escapar($dato1 ?? ''); ?>"
                required
            >
        </div>
        <button type="submit" class="btn">Procesar</button>
    </form>

    <?php if ($resultado !== null): ?>
        <div class="resultado">
            <h3>📊 Resultado</h3>
            <p><?php echo Utilidades::escapar($resultado); ?></p>
        </div>
    <?php endif; ?>

</main>
