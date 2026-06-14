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

    <?php Utilidades::mostrarErrores($errores); ?>

    <form method="POST" action="index.php?problema=1" id="formProblema1" class="panel-formulario">
        <h3 class="titulo-formulario">Ingresar 5 números positivos (mayores que cero):</h3>
        <p style="font-size: 0.9rem; color: var(--color-texto-claro); margin-bottom: 1.5rem;">
            Ingrese valores positivos. Por seguridad, el valor máximo permitido por campo es 1,000,000.
        </p>
        
        <div class="form-grid grid-inputs">
            <?php for ($i = 1; $i <= Problema1Controller::TOTAL_NUMEROS; $i++): ?>
                <div class="form-group">
                    <label for="num<?php echo $i; ?>" style="font-weight: 600; color: var(--color-texto);">Número <?php echo $i; ?>:</label>
                    <input
                        type="number"
                        step="any"
                        id="num<?php echo $i; ?>"
                        name="num<?php echo $i; ?>"
                        max="1000000"
                        placeholder="Ej. 12.5"
                        value="<?php echo Utilidades::escapar($nums[$i] ?? ''); ?>"
                        style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                        required
                    >
                </div>
            <?php endfor; ?>
        </div>
        
        <button type="submit" class="btn btn-bloque">
            ⚡ Calcular Estadísticas
        </button>
    </form>

    <?php if ($resultado !== null): ?>
        <div class="resultado panel-resultado">
            <h3 class="panel-resultado__titulo">
                📊 Resultados Estadísticos
            </h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem;">
                <div class="tarjeta-metrica">
                    <span class="tarjeta-metrica__etiqueta">Media</span>
                    <strong class="tarjeta-metrica__valor"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['media'], 4)); ?></strong>
                </div>
                
                <div class="tarjeta-metrica tarjeta-metrica--secundario">
                    <span class="tarjeta-metrica__etiqueta">Desviación Estándar</span>
                    <strong class="tarjeta-metrica__valor"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['desviacion'], 4)); ?></strong>
                </div>
                
                <div class="tarjeta-metrica tarjeta-metrica--exito">
                    <span class="tarjeta-metrica__etiqueta">Mínimo</span>
                    <strong class="tarjeta-metrica__valor"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['minimo'], 4)); ?></strong>
                </div>
                
                <div class="tarjeta-metrica tarjeta-metrica--error">
                    <span class="tarjeta-metrica__etiqueta">Máximo</span>
                    <strong class="tarjeta-metrica__valor"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['maximo'], 4)); ?></strong>
                </div>
            </div>
        </div>
    <?php endif; ?>

</main>
