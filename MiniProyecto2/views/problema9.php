<?php
/**
 * problema9.php - Vista del Problema 9.
 *
 * Muestra el formulario para ingresar un número entre 1 y 9, y
 * presenta sus 15 primeras potencias en una tabla HTML.
 *
 * Variables disponibles inyectadas por Utilidades::renderVista():
 *   $resultado (array|null) - Contiene base y la lista de potencias.
 *   $errores   (array)      - Lista de mensajes de error de validación.
 *   $numero    (string)     - Último valor enviado (para repoblar el input).
 */
?>

<main class="container">

    <?php Utilidades::volverMenu(); ?>

    <h2 style="margin-top: 1rem;">Problema 9</h2>
    <p class="subtitulo" style="color: var(--color-texto-claro); margin-bottom: 2rem;">
        Ingrese un número entre 1 y 9 para generar sus 15 primeras potencias.
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

    <form method="POST" action="index.php?problema=9" id="formProblema9" style="background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde);">
        <h3 style="margin-bottom: 1.5rem; color: var(--color-primario);">Generador de Potencias:</h3>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="numero" style="font-weight: 600; color: var(--color-texto);">Número base (1-9):</label>
            <input
                type="number"
                id="numero"
                name="numero"
                min="1"
                max="9"
                placeholder="Ej. 4"
                value="<?php echo Utilidades::escapar($numero ?? ''); ?>"
                style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                required
            >
            <span style="font-size: 0.85rem; color: var(--color-texto-claro); margin-top: 0.25rem; display: block;">
                Ingrese un número entero entre 1 y 9.
            </span>
        </div>

        <button type="submit" class="btn" style="width: 100%; padding: 0.85rem; font-size: 1rem; font-weight: 600; transition: background 0.2s;">
            ⚡ Generar Potencias
        </button>
    </form>

    <?php if ($resultado !== null): ?>
        <div class="resultado" style="margin-top: 2rem; background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde); border-left: 6px solid var(--color-primario);">
            <h3 style="display: flex; align-items: center; gap: 0.5rem; color: var(--color-primario); font-size: 1.35rem; margin-bottom: 1.5rem;">
                📊 Tabla de Potencias de <?php echo Utilidades::escapar($resultado['base']); ?>
            </h3>
            <p style="color: var(--color-texto-claro); margin-bottom: 1rem;">
                Se muestran las primeras <strong>15</strong> potencias de <strong><?php echo Utilidades::escapar($resultado['base']); ?></strong>.
            </p>

            <div style="overflow-x: auto;">
                <table class="tabla-multiplos">
                    <thead>
                        <tr>
                            <th>Exponente</th>
                            <th>Operación</th>
                            <th>Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado['potencias'] as $p): ?>
                            <tr>
                                <td style="font-weight: 600; color: var(--color-texto-claro);"><?php echo Utilidades::escapar($p['exponente']); ?></td>
                                <td style="font-family: Consolas, Monaco, monospace;"><?php echo Utilidades::escapar($p['operacion']); ?></td>
                                <td style="font-weight: bold; color: var(--color-primario);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($p['valor'], 0)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

</main>