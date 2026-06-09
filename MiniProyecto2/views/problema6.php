<?php
/**
 * problema6.php - Vista del Problema 6.
 *
 * Presenta el formulario de entrada y muestra los resultados
 * procesados por Problema6Controller.
 *
 * Variables disponibles (extraídas por Utilidades::renderVista):
 *   $resultado (string|null) - Resultado del procesamiento.
 */
?>

<main class="container">
    <nav class="nav-volver">
        <a href="index.php">← Volver al menú</a>
    </nav>

    <h2>Problema 6</h2>
    <p>Descripción del problema pendiente de implementación.</p>

    <form method="POST" action="index.php?problema=6" id="formProblema6">
        <div class="form-group">
            <label for="dato1">Dato de entrada:</label>
            <input type="text" id="dato1" name="dato1" placeholder="Ingrese un valor" required>
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
