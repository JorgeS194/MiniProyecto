<?php
/**
 * problema1.php - Vista del Problema 1.
 *
 * Muestra el formulario de entrada para el Problema 1 y, cuando
 * el controlador ya procesó los datos (POST), presenta el resultado
 * o la lista de errores de validación.
 *
 * Variables disponibles inyectadas por Utilidades::renderVista():
 *   $resultado (array|null) - Array con media, desviacion, minimo, maximo.
 *   $errores   (array)      - Lista de mensajes de error de validación.
 *   $nums      (array)      - Array de los 5 números ingresados (para repoblar).
 */
?>

<main class="container">

    <?php Utilidades::volverMenu(); ?>

    <h2 style="margin-top: 1rem;">Problema 1</h2>
    <p class="subtitulo" style="color: var(--color-texto-claro); margin-bottom: 2rem;">
        Calcular la media, desviación estándar, mínimo y máximo de 5 números positivos.
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

    <form method="POST" action="index.php?problema=1" id="formProblema1" style="background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde);">
        <h3 style="margin-bottom: 1.5rem; color: var(--color-primario);">Ingresar 5 números positivos (mayores que cero):</h3>
        
        <div class="form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1.25rem; margin-bottom: 1.5rem;">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="form-group">
                    <label for="num<?php echo $i; ?>" style="font-weight: 600; color: var(--color-texto);">Número <?php echo $i; ?>:</label>
                    <input
                        type="number"
                        step="any"
                        id="num<?php echo $i; ?>"
                        name="num<?php echo $i; ?>"
                        placeholder="Ej. 12.5"
                        value="<?php echo Utilidades::escapar($nums[$i] ?? ''); ?>"
                        style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                        required
                    >
                </div>
            <?php endfor; ?>
        </div>
        
        <button type="submit" class="btn" style="width: 100%; padding: 0.85rem; font-size: 1rem; font-weight: 600; transition: background 0.2s;">
            ⚡ Calcular Estadísticas
        </button>
    </form>

    <?php if ($resultado !== null): ?>
        <div class="resultado" style="margin-top: 2rem; background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde); border-left: 6px solid var(--color-primario);">
            <h3 style="display: flex; align-items: center; gap: 0.5rem; color: var(--color-primario); font-size: 1.35rem; margin-bottom: 1.5rem;">
                📊 Resultados Estadísticos
            </h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem;">
                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-primario); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Media</span>
                    <strong style="font-size: 1.4rem; color: var(--color-texto);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['media'], 4)); ?></strong>
                </div>
                
                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-secundario); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Desviación Estándar</span>
                    <strong style="font-size: 1.4rem; color: var(--color-texto);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['desviacion'], 4)); ?></strong>
                </div>
                
                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-exito); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Mínimo</span>
                    <strong style="font-size: 1.4rem; color: var(--color-texto);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['minimo'], 4)); ?></strong>
                </div>
                
                <div style="background: var(--color-fondo); padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--color-error); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                    <span style="font-size: 0.85rem; color: var(--color-texto-claro); display: block; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Máximo</span>
                    <strong style="font-size: 1.4rem; color: var(--color-texto);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['maximo'], 4)); ?></strong>
                </div>
            </div>
        </div>
    <?php endif; ?>

</main>
