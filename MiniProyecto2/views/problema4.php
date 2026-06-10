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

    <form method="POST" action="index.php?problema=4" id="formProblema4" style="background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde);">
        <h3 style="margin-bottom: 1.5rem; color: var(--color-primario);">Configurar Límite del Rango:</h3>
        
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
        
        <button type="submit" class="btn" style="width: 100%; padding: 0.85rem; font-size: 1rem; font-weight: 600; transition: background 0.2s;">
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
                <div style="background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde); border-top: 5px solid var(--color-primario); display: flex; flex-direction: column; gap: 1.25rem;">
                    <div>
                        <h4 style="color: var(--color-primario); font-size: 1.15rem; margin-bottom: 0.25rem; display: flex; align-items: center; gap: 0.4rem;">
                            🔵 Números Pares
                        </h4>
                        <p style="font-size: 0.85rem; color: var(--color-texto-claro);">Sumatoria de valores divisibles por 2</p>
                    </div>

                    <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-primario);">
                        <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Suma Total</span>
                        <strong style="font-size: 2.25rem; color: var(--color-texto);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['sumaPares'], 0)); ?></strong>
                    </div>

                    <div>
                        <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Procedimiento</span>
                        <code style="font-family: Consolas, Monaco, monospace; font-size: 0.95rem; color: var(--color-texto); word-break: break-all; display: block; background: var(--color-fondo); padding: 0.75rem; border-radius: 6px; border: 1px solid var(--color-borde);"><?php echo Utilidades::escapar($resultado['procPares']); ?></code>
                    </div>
                </div>

                <!-- Tarjeta de Números Impares -->
                <div style="background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde); border-top: 5px solid var(--color-secundario); display: flex; flex-direction: column; gap: 1.25rem;">
                    <div>
                        <h4 style="color: var(--color-secundario); font-size: 1.15rem; margin-bottom: 0.25rem; display: flex; align-items: center; gap: 0.4rem;">
                            🟣 Números Impares
                        </h4>
                        <p style="font-size: 0.85rem; color: var(--color-texto-claro);">Sumatoria de valores no divisibles por 2</p>
                    </div>

                    <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-secundario);">
                        <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Suma Total</span>
                        <strong style="font-size: 2.25rem; color: var(--color-texto);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['sumaImpares'], 0)); ?></strong>
                    </div>

                    <div>
                        <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Procedimiento</span>
                        <code style="font-family: Consolas, Monaco, monospace; font-size: 0.95rem; color: var(--color-texto); word-break: break-all; display: block; background: var(--color-fondo); padding: 0.75rem; border-radius: 6px; border: 1px solid var(--color-borde);"><?php echo Utilidades::escapar($resultado['procImpares']); ?></code>
                    </div>
                </div>

            </div>
        </div>
    <?php endif; ?>

</main>
