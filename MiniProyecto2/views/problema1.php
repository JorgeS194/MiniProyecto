<?php
/**
 * problema1.php - Vista del Problema 1.
 *
 * Presenta el formulario de entrada y muestra los resultados
 * procesados por Problema1Controller.
 *
 * Variables disponibles (extraídas por Utilidades::renderVista):
 *   $resultado (string|null) - Resultado del procesamiento.
 */
?>

<main class="container">
    <!-- Enlace para volver al menú -->
    <nav class="nav-volver">
        <a href="index.php">← Volver al menú</a>
    </nav>

    <h2>Problema 1</h2>
    <p>Descripción del problema pendiente de implementación.</p>

    <!-- Formulario de entrada -->
    <form method="POST" action="index.php?problema=1" id="formProblema1">
        <div class="form-group">
            <label for="dato1">Dato de entrada:</label>
            <input type="text" id="dato1" name="dato1" placeholder="Ingrese un valor" required>
        </div>
        <button type="submit" class="btn">Procesar</button>
    </form>

    <!-- Resultado (se muestra solo si existe) -->
    <?php if ($resultado !== null): ?>
        <div class="resultado">
            <h3>📊 Resultado</h3>
            <p><?php echo Utilidades::escapar($resultado); ?></p>
        </div>
    <?php endif; ?>
</main>
