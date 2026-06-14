<?php
/**
 * problema4.php - Vista del Problema 4.
 *
 * Muestra el formulario de entrada para el Problema 4 y, cuando
 * el controlador ya procesó los datos (POST), presenta los resultados
 * por separado para números pares e impares, indicando el procedimiento.
 *
 * Variables disponibles inyectadas por Utilidades::renderVista():
 *   $resultado (array|null) - Contiene limite, sumaPares, sumaImpares, procPares, procImpares.
 *   $errores   (array)       - Lista de mensajes de error de validación.
 *   $limite    (string)      - Último valor enviado (para repoblar el input).
 */
?>

<main class="container">

    <?php Utilidades::volverMenu(); ?>

    <h2 style="margin-top: 1rem;">Problema 4</h2>
    <p class="subtitulo" style="color: var(--color-texto-claro); margin-bottom: 2rem;">
        Calcular independientemente la suma de los números pares e impares comprendidos entre 1 y el límite ingresado.
    </p>

    <?php Utilidades::mostrarErrores($errores); ?>

    <form method="POST" action="index.php?problema=4" id="formProblema4" class="panel-formulario">
        <h3 class="titulo-formulario">Configurar Límite del Rango:</h3>
        
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="limite" style="font-weight: 600; color: var(--color-texto);">Calcular del 1 hasta:</label>
            <input
                type="number"
                id="limite"
                name="limite"
                min="1"
                max="100000"
                placeholder="Ej. 200"
                value="<?php echo Utilidades::escapar($limite ?? '200'); ?>"
                style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                required
            >
            <span style="font-size: 0.85rem; color: var(--color-texto-claro); margin-top: 0.25rem; display: block;">
                El valor predeterminado es 200 según lo solicitado en el problema.
            </span>
        </div>
        
        <button type="submit" class="btn btn-bloque">
            ⚡ Calcular Sumatorias
        </button>
    </form>

    <?php if ($resultado !== null): ?>
        <div style="margin-top: 2.5rem;">
            <h3 style="color: var(--color-texto); font-size: 1.35rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                📊 Resultados del Rango 1 a <?php echo Utilidades::escapar($resultado['limite']); ?>
            </h3>

            <div class="resultados-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
                
                <!-- Tarjeta de Números Pares -->
                <div class="panel-columna" style="border-top: 5px solid var(--color-primario);">
                    <div>
                        <h4 style="color: var(--color-primario); font-size: 1.15rem; margin-bottom: 0.25rem; display: flex; align-items: center; gap: 0.4rem;">
                            🔵 Números Pares
                        </h4>
                        <p style="font-size: 0.85rem; color: var(--color-texto-claro);">Sumatoria de valores divisibles por 2</p>
                    </div>

                    <div class="tarjeta-metrica">
                        <span class="tarjeta-metrica__etiqueta">Suma Total</span>
                        <strong class="tarjeta-metrica__valor tarjeta-metrica__valor--xl"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['sumaPares'], 0)); ?></strong>
                    </div>

                    <div>
                        <span class="tarjeta-metrica__etiqueta" style="margin-bottom: 0.4rem;">Procedimiento</span>
                        <code class="bloque-codigo"><?php echo Utilidades::escapar($resultado['procPares']); ?></code>
                    </div>
                </div>

                <!-- Tarjeta de Números Impares -->
                <div class="panel-columna" style="border-top: 5px solid var(--color-secundario);">
                    <div>
                        <h4 style="color: var(--color-secundario); font-size: 1.15rem; margin-bottom: 0.25rem; display: flex; align-items: center; gap: 0.4rem;">
                            🟣 Números Impares
                        </h4>
                        <p style="font-size: 0.85rem; color: var(--color-texto-claro);">Sumatoria de valores no divisibles por 2</p>
                    </div>

                    <div class="tarjeta-metrica tarjeta-metrica--secundario">
                        <span class="tarjeta-metrica__etiqueta">Suma Total</span>
                        <strong class="tarjeta-metrica__valor tarjeta-metrica__valor--xl"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['sumaImpares'], 0)); ?></strong>
                    </div>

                    <div>
                        <span class="tarjeta-metrica__etiqueta" style="margin-bottom: 0.4rem;">Procedimiento</span>
                        <code class="bloque-codigo"><?php echo Utilidades::escapar($resultado['procImpares']); ?></code>
                    </div>
                </div>

            </div>
        </div>
    <?php endif; ?>

</main>
