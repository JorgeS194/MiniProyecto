<?php
/**
 * problema2.php - Vista del Problema 2.
 *
 * Muestra el formulario de entrada para el Problema 2 y, cuando
 * el controlador ya procesó los datos (POST), presenta el resultado.
 *
 * Variables disponibles inyectadas por Utilidades::renderVista():
 *   $resultado (array|null) - Array con límite, suma, procedimiento, fórmula.
 *   $errores   (array)       - Lista de mensajes de error de validación.
 *   $limite    (string)      - Último valor enviado (para repoblar el input).
 */
?>

<main class="container">

    <?php Utilidades::volverMenu(); ?>

    <h2 style="margin-top: 1rem;">Problema 2</h2>
    <p class="subtitulo" style="color: var(--color-texto-claro); margin-bottom: 2rem;">
        Calcular la suma de los números enteros del 1 hasta el límite ingresado.
    </p>

    <?php if (!empty($errores)): ?>
        <div class="error-box" style="text-align:left; margin-bottom:1.5rem;">
            <strong>⚠️ Por favor corrige los siguientes errores:</strong>
            <ul style="margin-top:.5rem; padding-left:1.25rem;">
                <?php foreach ($errores as $e): ?>
                    <li><?php echo Utilidades::escapar($e); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?problema=2" id="formProblema2" style="background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde);">
        <h3 style="margin-bottom: 1.5rem; color: var(--color-primario);">Configurar Límite de la Suma:</h3>
        
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="limite" style="font-weight: 600; color: var(--color-texto);">Sumar desde 1 hasta:</label>
            <input
                type="number"
                id="limite"
                name="limite"
                min="1"
                max="100000"
                placeholder="Ej. 1000"
                value="<?php echo Utilidades::escapar($limite ?? '1000'); ?>"
                style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                required
            >
            <span style="font-size: 0.85rem; color: var(--color-texto-claro); margin-top: 0.25rem; display: block;">
                El valor predeterminado es 1000 para obtener el resultado esperado de 500,500.
            </span>
        </div>
        
        <button type="submit" class="btn" style="width: 100%; padding: 0.85rem; font-size: 1rem; font-weight: 600; transition: background 0.2s;">
            ⚡ Calcular Sumatoria
        </button>
    </form>

    <?php if ($resultado !== null): ?>
        <div class="resultado" style="margin-top: 2rem; background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde); border-left: 6px solid var(--color-primario);">
            <h3 style="display: flex; align-items: center; gap: 0.5rem; color: var(--color-primario); font-size: 1.35rem; margin-bottom: 1.5rem;">
                📊 Resultado del Cálculo
            </h3>
            
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-exito);">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Suma Total</span>
                    <strong style="font-size: 2rem; color: var(--color-texto);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['suma'], 0)); ?></strong>
                </div>

                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-primario);">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Procedimiento Aplicado (Bucle)</span>
                    <code style="font-family: Consolas, Monaco, monospace; font-size: 1.05rem; color: var(--color-texto);"><?php echo Utilidades::escapar($resultado['procedimiento']); ?></code>
                </div>

                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-secundario);">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Comprobación Matemática</span>
                    <code style="font-family: Consolas, Monaco, monospace; font-size: 1.05rem; color: var(--color-texto);"><?php echo Utilidades::escapar($resultado['formula']); ?></code>
                </div>
            </div>
        </div>
    <?php endif; ?>

</main>
