<?php
/**
 * problema7.php - Vista del Problema 7.
 *
 * Calculadora de Datos Estadísticos en dos pasos:
 *   Paso 1: el usuario indica cuántas notas (N) desea ingresar.
 *   Paso 2: el usuario ingresa las N notas y se muestran los resultados.
 *
 * Variables disponibles inyectadas por Utilidades::renderVista():
 *   $resultado (array|null) - Contiene cantidad, promedio, desviacion, minima, maxima, notas.
 *   $errores   (array)      - Lista de mensajes de error de validación.
 *   $paso      (int)        - Paso actual del flujo (1 o 2).
 *   $cantidad  (int|string) - Cantidad de notas (N).
 *   $notas     (array)      - Array de notas ingresadas (para repoblar).
 */
?>

<main class="container">

    <?php Utilidades::volverMenu(); ?>

    <h2 style="margin-top: 1rem;">Problema 7</h2>
    <p class="subtitulo" style="color: var(--color-texto-claro); margin-bottom: 2rem;">
        Calculadora de Datos Estadísticos: ingrese la cantidad de notas y luego sus valores
        para calcular el promedio, la desviación estándar, la nota mínima y la máxima.
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

    <?php if ((int) ($paso ?? 1) === 1): ?>

        <!-- ═══ PASO 1: Pedir la cantidad de notas (N) ═══ -->
        <form method="POST" action="index.php?problema=7" id="formProblema7Paso1" style="background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde);">
            <input type="hidden" name="paso" value="1">

            <h3 style="margin-bottom: 1.5rem; color: var(--color-primario);">Paso 1: ¿Cuántas notas desea ingresar?</h3>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="cantidad" style="font-weight: 600; color: var(--color-texto);">Cantidad de notas (N):</label>
                <input
                    type="number"
                    id="cantidad"
                    name="cantidad"
                    min="1"
                    max="50"
                    placeholder="Ej. 5"
                    value="<?php echo Utilidades::escapar($cantidad ?? ''); ?>"
                    style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                    required
                >
                <span style="font-size: 0.85rem; color: var(--color-texto-claro); margin-top: 0.25rem; display: block;">
                    Ingrese un número entero positivo. Por seguridad, el límite máximo permitido es 50 notas.
                </span>
            </div>

            <button type="submit" class="btn" style="width: 100%; padding: 0.85rem; font-size: 1rem; font-weight: 600; transition: background 0.2s;">
                ⚡ Continuar
            </button>
        </form>

    <?php else: ?>

        <!-- ═══ PASO 2: Ingresar las N notas ═══ -->
        <form method="POST" action="index.php?problema=7" id="formProblema7Paso2" style="background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde);">
            <input type="hidden" name="paso" value="2">
            <input type="hidden" name="cantidad" value="<?php echo Utilidades::escapar($cantidad); ?>">

            <h3 style="margin-bottom: 1.5rem; color: var(--color-primario);">
                Paso 2: Ingrese las <?php echo Utilidades::escapar($cantidad); ?> notas
            </h3>

            <div class="form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1.25rem; margin-bottom: 1.5rem;">
                <?php for ($i = 1; $i <= (int) $cantidad; $i++): ?>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="nota<?php echo $i; ?>" style="font-weight: 600; color: var(--color-texto);">Nota <?php echo $i; ?>:</label>
                        <input
                            type="number"
                            step="any"
                            min="0"
                            max="100"
                            id="nota<?php echo $i; ?>"
                            name="nota<?php echo $i; ?>"
                            placeholder="Ej. 85"
                            value="<?php echo Utilidades::escapar($notas[$i] ?? ''); ?>"
                            style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                            required
                        >
                    </div>
                <?php endfor; ?>
            </div>

            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="index.php?problema=7" class="btn btn-secundario" style="flex: 1; text-align: center; padding: 0.85rem; font-size: 1rem; font-weight: 600;">
                    ↺ Cambiar cantidad de notas
                </a>
                <button type="submit" class="btn" style="flex: 1; padding: 0.85rem; font-size: 1rem; font-weight: 600; transition: background 0.2s;">
                    ⚡ Calcular Estadísticas
                </button>
            </div>
        </form>

    <?php endif; ?>

    <?php if ($resultado !== null): ?>
        <div class="resultado" style="margin-top: 2rem; background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde); border-left: 6px solid var(--color-primario);">
            <h3 style="display: flex; align-items: center; gap: 0.5rem; color: var(--color-primario); font-size: 1.35rem; margin-bottom: 1.5rem;">
                📊 Resultados Estadísticos
            </h3>

            <p style="color: var(--color-texto-claro); margin-bottom: 1.5rem;">
                Cálculo realizado sobre <strong><?php echo Utilidades::escapar($resultado['cantidad']); ?></strong> nota(s):
                <?php echo Utilidades::escapar(implode(', ', $resultado['notas'])); ?>
            </p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem;">
                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-primario);">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Promedio</span>
                    <strong style="font-size: 1.4rem; color: var(--color-texto);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['promedio'], 4)); ?></strong>
                </div>

                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-secundario);">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Desviación Estándar</span>
                    <strong style="font-size: 1.4rem; color: var(--color-texto);">
                        <?php echo $resultado['desviacion'] !== null
                            ? Utilidades::escapar(Utilidades::formatearNumero($resultado['desviacion'], 4))
                            : 'N/A'; ?>
                    </strong>
                </div>

                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-exito);">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Nota Mínima</span>
                    <strong style="font-size: 1.4rem; color: var(--color-texto);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['minima'], 2)); ?></strong>
                </div>

                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-error);">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Nota Máxima</span>
                    <strong style="font-size: 1.4rem; color: var(--color-texto);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['maxima'], 2)); ?></strong>
                </div>
            </div>
        </div>
    <?php endif; ?>

</main>