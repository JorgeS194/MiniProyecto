<?php
/**
 * problema6.php - Vista del Problema 6.
 *
 * Muestra el formulario de entrada para el Problema 6 y presenta los resultados
 * con la distribución del presupuesto hospitalario y una gráfica usando Chart.js.
 *
 * Variables disponibles inyectadas por Utilidades::renderVista():
 *   $resultado   (array|null) - Contiene presupuestoTotal, distribucion y porcentajes.
 *   $errores     (array)      - Lista de mensajes de error de validación.
 *   $presupuesto (string)     - Último valor enviado (para repoblar el input).
 */
?>

<main class="container">

    <?php Utilidades::volverMenu(); ?>

    <h2 style="margin-top: 1rem;">Problema 6</h2>
    <p class="subtitulo" style="color: var(--color-texto-claro); margin-bottom: 2rem;">
        Calcular la distribución del presupuesto anual de un hospital en sus tres áreas principales.
    </p>

    <?php Utilidades::mostrarErrores($errores); ?>

    <form method="POST" action="index.php?problema=6" id="formProblema6" class="panel-formulario">
        <h3 class="titulo-formulario">Ingresar Presupuesto Anual:</h3>
        
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="presupuesto" style="font-weight: 600; color: var(--color-texto);">Monto Total ($):</label>
            <input
                type="number"
                step="0.01"
                id="presupuesto"
                name="presupuesto"
                min="0.01"
                placeholder="Ej. 1000000"
                value="<?php echo Utilidades::escapar($presupuesto ?? ''); ?>"
                style="width: 100%; padding: 0.65rem; border: 1px solid var(--color-borde); border-radius: 6px; font-size: 1rem;"
                required
            >
            <span style="font-size: 0.85rem; color: var(--color-texto-claro); margin-top: 0.25rem; display: block;">
                Ingrese un valor numérico positivo mayor a cero.
            </span>
        </div>
        
        <button type="submit" class="btn btn-bloque">
            ⚡ Calcular Distribución
        </button>
    </form>

    <?php if ($resultado !== null): ?>
        <div style="margin-top: 2.5rem;">
            <h3 style="color: var(--color-texto); font-size: 1.35rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                📊 Distribución del Presupuesto
            </h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                
                <!-- Columna Detalles de Distribución -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div class="panel-columna">
                        <h4 style="margin-bottom: 1rem; color: var(--color-primario);">📋 Asignación por Área</h4>
                        
                        <div style="background: var(--color-fondo); padding: 1rem; border-radius: 8px; margin-bottom: 1rem; text-align: center;">
                            <span style="font-size: 0.85rem; color: var(--color-texto-claro); text-transform: uppercase; font-weight: 600;">Presupuesto Total</span><br>
                            <strong style="font-size: 1.5rem; color: var(--color-texto);">$<?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['presupuestoTotal'])); ?></strong>
                        </div>

                        <table class="tabla-datos">
                            <thead>
                                <tr>
                                    <th>Área</th>
                                    <th>Porcentaje</th>
                                    <th style="text-align: right;">Monto Asignado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight: 500;">Ginecología</td>
                                    <td style="color: var(--color-texto-claro);"><?php echo Utilidades::escapar($resultado['porcentajes']['ginecologia']); ?>%</td>
                                    <td style="text-align: right; font-weight: bold; color: var(--color-primario);">$<?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['distribucion']['ginecologia'])); ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 500;">Traumatología</td>
                                    <td style="color: var(--color-texto-claro);"><?php echo Utilidades::escapar($resultado['porcentajes']['traumatologia']); ?>%</td>
                                    <td style="text-align: right; font-weight: bold; color: var(--color-primario);">$<?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['distribucion']['traumatologia'])); ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 500;">Pediatría</td>
                                    <td style="color: var(--color-texto-claro);"><?php echo Utilidades::escapar($resultado['porcentajes']['pediatria']); ?>%</td>
                                    <td style="text-align: right; font-weight: bold; color: var(--color-primario);">$<?php echo Utilidades::escapar(Utilidades::formatearNumero($resultado['distribucion']['pediatria'])); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Columna Gráfica -->
                <div class="panel-columna">
                    <h4 style="margin-bottom: 1rem; text-align: center;">Gráfica de Distribución</h4>
                    <canvas id="graficaPresupuesto" style="max-height: 300px; width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <!-- Integración de Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('graficaPresupuesto');
                if (ctx) {
                    // Datos inyectados desde PHP
                    const ginecologia = <?php echo (float)$resultado['distribucion']['ginecologia']; ?>;
                    const traumatologia = <?php echo (float)$resultado['distribucion']['traumatologia']; ?>;
                    const pediatria = <?php echo (float)$resultado['distribucion']['pediatria']; ?>;

                    new Chart(ctx.getContext('2d'), {
                        type: 'pie',
                        data: {
                            labels: ['Ginecología (40%)', 'Traumatología (35%)', 'Pediatría (25%)'],
                            datasets: [{
                                label: 'Presupuesto Asignado ($)',
                                data: [ginecologia, traumatologia, pediatria],
                                backgroundColor: [
                                    '#ec4899', // pink-500
                                    '#3b82f6', // blue-500
                                    '#10b981'  // emerald-500
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
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.parsed !== null) {
                                                label += new Intl.NumberFormat('es-US', { style: 'currency', currency: 'USD' }).format(context.parsed);
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            });
        </script>
    <?php endif; ?>

</main>
