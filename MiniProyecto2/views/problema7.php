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

    <?php Utilidades::mostrarErrores($errores); ?>

    <?php if ((int) ($paso ?? 1) === 1): ?>

        <!-- ═══ PASO 1: Pedir la cantidad de notas (N) ═══ -->
        <form method="POST" action="index.php?problema=7" id="formProblema7Paso1" class="panel-formulario">
            <input type="hidden" name="paso" value="1">

            <h3 class="titulo-formulario">Paso 1: ¿Cuántas notas desea ingresar?</h3>

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

            <button type="submit" class="btn btn-bloque">
                ⚡ Continuar
            </button>
        </form>

    <?php else: ?>

        <!-- ═══ PASO 2: Ingresar las N notas ═══ -->
        <form method="POST" action="index.php?problema=7" id="formProblema7Paso2" class="panel-formulario">
            <input type="hidden" name="paso" value="2">
            <input type="hidden" name="cantidad" value="<?php echo Utilidades::escapar($cantidad); ?>">

            <h3 class="titulo-formulario">
                Paso 2: Ingrese las <?php echo Utilidades::escapar($cantidad); ?> notas
            </h3>

            <div class="form-grid grid-inputs">
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
                <a href="index.php?problema=7" class="btn btn-secundario btn-bloque" style="flex: 1; text-align: center;">
                    ↺ Cambiar cantidad de notas
                </a>
                <button type="submit" class="btn btn-bloque" style="flex: 1;">
                    ⚡ Calcular Estadísticas
                </button>
            </div>
        </form>

    <?php endif; ?>

    <?php if ($resultado !== null): ?>
        <div class="resultado panel-resultado">
            <h3 class="panel-resultado__titulo">
                📊 Resultados Estadísticos
            </h3>

            <p style="color: var(--color-texto-claro); margin-bottom: 1.5rem;">
                Cálculo realizado sobre <strong><?php echo Utilidades::escapar($resultado['cantidad']); ?></strong> nota(s):
                <?php echo Utilidades::escapar(implode(', ', $resultado['notas'])); ?>
            </p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem;">
                <div class="tarjeta-metrica">
                    <span class="tarjeta-metrica__etiqueta">Promedio</span>
                    <strong class="tarjeta-metrica__valor"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['promedio'], 4)); ?></strong>
                </div>

                <div class="tarjeta-metrica tarjeta-metrica--secundario">
                    <span class="tarjeta-metrica__etiqueta">Desviación Estándar</span>
                    <strong class="tarjeta-metrica__valor">
                        <?php echo $resultado['desviacion'] !== null
                            ? Utilidades::escapar(Utilidades::formatearNumero($resultado['desviacion'], 4))
                            : 'N/A'; ?>
                    </strong>
                </div>

                <div class="tarjeta-metrica tarjeta-metrica--exito">
                    <span class="tarjeta-metrica__etiqueta">Nota Mínima</span>
                    <strong class="tarjeta-metrica__valor"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['minima'], 2)); ?></strong>
                </div>

                <div class="tarjeta-metrica tarjeta-metrica--error">
                    <span class="tarjeta-metrica__etiqueta">Nota Máxima</span>
                    <strong class="tarjeta-metrica__valor"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['maxima'], 2)); ?></strong>
                </div>
            </div>
        </div>
    <?php endif; ?>

</main>