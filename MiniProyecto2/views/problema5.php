<?php
/**
 * problema5.php - Vista del Problema 5.
 *
 * Muestra el formulario de entrada para el Problema 5 y presenta los resultados
 * con estadísticas de clasificación de edades y una gráfica usando Chart.js.
 *
 * Variables disponibles inyectadas por Utilidades::renderVista():
 *   $resultado (array|null) - Contiene clasificacion, detalle y repetidas.
 *   $errores   (array)       - Lista de mensajes de error de validación.
 *   $edades    (array)       - Array con las edades enviadas.
 */
?>

<main class="container">

    <?php Utilidades::volverMenu(); ?>

    <h2 style="margin-top: 1rem;">Problema 5</h2>
    <p class="subtitulo" style="color: var(--color-texto-claro); margin-bottom: 2rem;">
        Leer la edad de 5 personas, clasificarlas y visualizar las estadísticas.
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

    <form method="POST" action="index.php?problema=5" id="formProblema5" style="background: var(--color-superficie); padding: 2rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde);">
        <h3 style="margin-bottom: 1.5rem; color: var(--color-primario);">Ingresar Edades:</h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="edad<?php echo $i; ?>" style="font-weight: 600; color: var(--color-texto);">Edad <?php echo $i; ?>:</label>
                    <input
                        type="number"
                        id="edad<?php echo $i; ?>"
                        name="edad<?php echo $i; ?>"
                        min="0"
                        max="120"
                        placeholder="Ej. 25"
                        value="<?php echo Utilidades::escapar($edades[$i] ?? ''); ?>"
                        style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                        required
                    >
                </div>
            <?php endfor; ?>
        </div>
        
        <button type="submit" class="btn" style="width: 100%; padding: 0.85rem; font-size: 1rem; font-weight: 600; transition: background 0.2s;">
            ⚡ Procesar y Clasificar
        </button>
    </form>

    <?php if ($resultado !== null): ?>
        <div style="margin-top: 2.5rem;">
            <h3 style="color: var(--color-texto); font-size: 1.35rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                📊 Estadísticas de Clasificación
            </h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                
                <!-- Columna Detalles y Repetidas -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="background: var(--color-superficie); padding: 1.5rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde);">
                        <h4 style="margin-bottom: 1rem; color: var(--color-primario);">📋 Detalle por Persona</h4>
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="border-bottom: 2px solid var(--color-borde);">
                                    <th style="padding: 0.5rem;">Persona</th>
                                    <th style="padding: 0.5rem;">Edad</th>
                                    <th style="padding: 0.5rem;">Clasificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultado['detalle'] as $det): ?>
                                    <tr style="border-bottom: 1px solid var(--color-borde);">
                                        <td style="padding: 0.5rem;">#<?php echo Utilidades::escapar($det['persona']); ?></td>
                                        <td style="padding: 0.5rem;"><strong><?php echo Utilidades::escapar($det['edad']); ?></strong> años</td>
                                        <td style="padding: 0.5rem;"><span style="background: var(--color-fondo); padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.85rem;"><?php echo Utilidades::escapar($det['categoria']); ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if (!empty($resultado['repetidas'])): ?>
                        <div style="background: var(--color-superficie); padding: 1.5rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde); border-left: 4px solid var(--color-secundario);">
                            <h4 style="margin-bottom: 1rem; color: var(--color-secundario);">🔄 Edades Repetidas</h4>
                            <ul style="padding-left: 1.25rem;">
                                <?php foreach ($resultado['repetidas'] as $rep): ?>
                                    <li><?php echo Utilidades::escapar($rep); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div style="background: var(--color-superficie); padding: 1.5rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde); border-left: 4px solid var(--color-exito);">
                            <h4 style="margin-bottom: 0.5rem; color: var(--color-exito);">✅ Sin Repeticiones</h4>
                            <p style="font-size: 0.9rem; color: var(--color-texto-claro);">Todas las edades ingresadas son únicas.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Columna Gráfica -->
                <div style="background: var(--color-superficie); padding: 1.5rem; border-radius: var(--radio-borde); box-shadow: var(--sombra); border: 1px solid var(--color-borde);">
                    <h4 style="margin-bottom: 1rem; text-align: center;">Distribución de Categorías</h4>
                    <canvas id="graficaEdades" style="max-height: 300px; width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <!-- Integración de Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('graficaEdades');
                if (ctx) {
                    // Datos inyectados desde PHP
                    const ninos = <?php echo (int)$resultado['clasificacion']['ninos']; ?>;
                    const adolescentes = <?php echo (int)$resultado['clasificacion']['adolescentes']; ?>;
                    const adultos = <?php echo (int)$resultado['clasificacion']['adultos']; ?>;
                    const adultosMayores = <?php echo (int)$resultado['clasificacion']['adultos_mayores']; ?>;

                    new Chart(ctx.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: ['Niños (0-12)', 'Adolescentes (13-17)', 'Adultos (18-64)', 'Adultos Mayores (65+)'],
                            datasets: [{
                                label: 'Cantidad',
                                data: [ninos, adolescentes, adultos, adultosMayores],
                                backgroundColor: [
                                    '#3b82f6', // blue-500
                                    '#8b5cf6', // violet-500
                                    '#10b981', // emerald-500
                                    '#f59e0b'  // amber-500
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                }
                            }
                        }
                    });
                }
            });
        </script>
    <?php endif; ?>

</main>
