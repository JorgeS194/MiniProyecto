<?php
/**
 * problema8.php - Vista del Problema 8.
 *
 * Muestra el formulario "¿Qué estación es?" para que el usuario
 * ingrese una fecha y, una vez procesada, presenta la estación
 * del año correspondiente junto con una imagen ilustrativa.
 *
 * Variables disponibles inyectadas por Utilidades::renderVista():
 *   $resultado (array|null) - Contiene fechaIngresada, estacion, emoji, imagen.
 *   $errores   (array)      - Lista de mensajes de error de validación.
 *   $fecha     (string)     - Última fecha enviada (para repoblar el input).
 */
?>

<main class="container">

    <?php Utilidades::volverMenu(); ?>

    <h2 style="margin-top: 1rem;">Problema 8</h2>
    <p class="subtitulo" style="color: var(--color-texto-claro); margin-bottom: 2rem;">
        ¿Qué estación es? Ingrese una fecha y descubra a qué estación del año corresponde.
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

    <form method="POST" action="index.php?problema=8" id="formProblema8" style="background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde);">
        <h3 style="margin-bottom: 1.5rem; color: var(--color-primario);">¿Qué estación es?</h3>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="fecha" style="font-weight: 600; color: var(--color-texto);">Fecha:</label>
            <input
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo Utilidades::escapar($fecha ?? ''); ?>"
                style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                required
            >
            <span style="font-size: 0.85rem; color: var(--color-texto-claro); margin-top: 0.25rem; display: block;">
                Seleccione una fecha (mm/dd/yyyy). El cálculo de la estación se basa en la convención del hemisferio sur.
            </span>
        </div>

        <button type="submit" class="btn" style="width: 100%; padding: 0.85rem; font-size: 1rem; font-weight: 600; transition: background 0.2s;">
            Mostrar
        </button>
    </form>

    <?php if ($resultado !== null): ?>
        <div class="resultado" style="margin-top: 2rem; background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde); border-left: 6px solid var(--color-primario); text-align: center;">
            <h3 style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; color: var(--color-primario); font-size: 1.35rem; margin-bottom: 1.5rem;">
                <?php echo $resultado['emoji']; ?> Resultado
            </h3>

            <p style="font-size: 1.05rem; color: var(--color-texto); margin-bottom: 0.5rem;">
                Fecha ingresada: <strong><?php echo Utilidades::escapar($resultado['fechaIngresada']); ?></strong>
            </p>
            <p style="font-size: 1.25rem; color: var(--color-texto); margin-bottom: 1.5rem;">
                La estación es: <strong style="color: var(--color-primario);"><?php echo Utilidades::escapar($resultado['estacion']); ?></strong>
            </p>

            <?php
                $rutaImagen = 'assets/images/' . $resultado['imagen'];
            ?>
            <img
                src="<?php echo Utilidades::escapar($rutaImagen); ?>"
                alt="Imagen representativa de <?php echo Utilidades::escapar($resultado['estacion']); ?>"
                style="max-width: 100%; max-height: 320px; border-radius: var(--radio-borde); box-shadow: var(--sombra); object-fit: cover;"
                onerror="this.style.display='none';"
            >
        </div>
    <?php endif; ?>

</main>