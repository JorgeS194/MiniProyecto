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

    <?php Utilidades::mostrarErrores($errores); ?>

    <form method="POST" action="index.php?problema=2" id="formProblema2" class="panel-formulario">
        <h3 class="titulo-formulario">Configurar Límite de la Suma:</h3>
        
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="limite" style="font-weight: 600; color: var(--color-texto);">Sumar desde 1 hasta:</label>
            <input
                type="number"
                id="limite"
                name="limite"
                min="1"
                max="1000"
                placeholder="Ej. 1000"
                value="<?php echo Utilidades::escapar($limite ?? '1000'); ?>"
                style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                required
            >
            <span style="font-size: 0.85rem; color: var(--color-texto-claro); margin-top: 0.25rem; display: block;">
                El valor predeterminado es 1000 para obtener el resultado esperado de 500,500.
            </span>
        </div>
        
        <button type="submit" class="btn btn-bloque">
            ⚡ Calcular Sumatoria
        </button>
    </form>

    <?php if ($resultado !== null): ?>
        <div class="resultado panel-resultado">
            <h3 class="panel-resultado__titulo">
                📊 Resultado del Cálculo
            </h3>
            
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div class="tarjeta-metrica tarjeta-metrica--exito">
                    <span class="tarjeta-metrica__etiqueta">Suma Total</span>
                    <strong class="tarjeta-metrica__valor tarjeta-metrica__valor--grande"><?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['suma'], 0)); ?></strong>
                </div>

                <div class="tarjeta-metrica">
                    <span class="tarjeta-metrica__etiqueta">Procedimiento Aplicado (Bucle)</span>
                    <code class="bloque-codigo" style="font-size: 1.05rem;"><?php echo Utilidades::escapar($resultado['procedimiento']); ?></code>
                </div>

                <div class="tarjeta-metrica tarjeta-metrica--secundario">
                    <span class="tarjeta-metrica__etiqueta">Comprobación Matemática</span>
                    <code class="bloque-codigo" style="font-size: 1.05rem;"><?php echo Utilidades::escapar($resultado['formula']); ?></code>
                </div>
            </div>
        </div>
    <?php endif; ?>

</main>
