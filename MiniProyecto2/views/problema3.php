<?php
/**
 * problema3.php - Vista del Problema 3.
 *
 * Muestra el formulario de entrada para el Problema 3 y, cuando
 * el controlador ya procesó los datos (POST), presenta el resultado
 * estructurado en una tabla HTML.
 *
 * Variables disponibles inyectadas por Utilidades::renderVista():
 *   $resultado (array|null) - Array con N y lista de múltiplos de 4.
 *   $errores   (array)       - Lista de mensajes de error de validación.
 *   $n         (string)      - Último valor ingresado por el usuario.
 */
?>

<main class="container">

    <?php Utilidades::volverMenu(); ?>

    <h2 style="margin-top: 1rem;">Problema 3</h2>
    <p class="subtitulo" style="color: var(--color-texto-claro); margin-bottom: 2rem;">
        Imprimir los N primeros múltiplos de 4, donde N es ingresado por el usuario.
    </p>

    <?php Utilidades::mostrarErrores($errores); ?>

    <form method="POST" action="index.php?problema=3" id="formProblema3" class="panel-formulario">
        <h3 class="titulo-formulario">Generador de Múltiplos:</h3>
        
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="n" style="font-weight: 600; color: var(--color-texto);">Cantidad de múltiplos (N):</label>
            <input
                type="number"
                id="n"
                name="n"
                min="1"
                max="1000"
                placeholder="Ej. 10"
                value="<?php echo Utilidades::escapar($n ?? '10'); ?>"
                style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                required
            >
            <span style="font-size: 0.85rem; color: var(--color-texto-claro); margin-top: 0.25rem; display: block;">
                Ingrese un número entero positivo. Por seguridad, el límite máximo permitido es 1,000.
            </span>
        </div>
        
        <button type="submit" class="btn btn-bloque">
            ⚡ Generar Múltiplos
        </button>
    </form>

    <?php if ($resultado !== null): ?>
        <div class="resultado panel-resultado">
            <h3 class="panel-resultado__titulo">
                📊 Tabla de Múltiplos de 4
            </h3>
            <p style="color: var(--color-texto-claro); margin-bottom: 1rem;">
                Se muestran los primeros <strong><?php echo Utilidades::escapar($resultado['n']); ?></strong> múltiplos de 4.
            </p>

            <div style="overflow-x: auto;">
                <table class="tabla-multiplos">
                    <thead>
                        <tr>
                            <th>Índice</th>
                            <th>Operación</th>
                            <th>Múltiplo de 4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado['multiplos'] as $m): ?>
                            <tr>
                                <td style="font-weight: 600; color: var(--color-texto-claro);"><?php echo Utilidades::escapar($m['indice']); ?></td>
                                <td style="font-family: Consolas, Monaco, monospace;"><?php echo Utilidades::escapar($m['operacion']); ?></td>
                                <td style="font-weight: bold; color: var(--color-primario);"><?php echo Utilidades::escapar(Utilidades::formatearNumero($m['valor'], 0)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


    <?php endif; ?>

</main>
