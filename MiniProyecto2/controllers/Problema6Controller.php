<?php
/**
 * Problema6Controller.php - Controlador del Problema 6.
 *
 * Gestiona el flujo del Problema 6 según el patrón MVC:
 *   - index()    → muestra el formulario vacío (petición GET).
 *   - procesar() → recibe el presupuesto, valida y delega el cálculo al modelo (petición POST).
 *
 * @author  Estudiante
 * @version 2.0
 */

// Incluir el modelo explícitamente ya que no hay un autoloader configurado
require_once BASE_PATH . '/models/PresupuestoModel.php';

class Problema6Controller
{
    const PRESUPUESTO_MAXIMO = 1000000000000;
    /**
     * Muestra el formulario del Problema 6 sin procesar datos.
     * Se invoca cuando el usuario accede por primera vez (GET).
     *
     * @return void
     */
    public function index()
    {
        $datos = [
            'resultado'   => null,
            'errores'     => [],
            'presupuesto' => '',
        ];

        Utilidades::renderVista('problema6', 'Problema 6', $datos);
    }

    /**
     * Recibe los datos enviados por POST, los valida y pasa los resultados a la vista.
     *
     * @return void
     */
    public function procesar()
    {
        $errores   = [];
        $resultado = null;

        // ── Obtener y sanear datos del formulario ──
        $presupuestoRaw = Utilidades::obtenerPost('presupuesto');
        $presupuesto = Utilidades::sanitizarTexto($presupuestoRaw);

        // ── Validaciones ──
        if ($presupuesto === '') {
            $errores[] = 'El campo presupuesto es requerido.';
        } elseif (!Utilidades::validarNumero($presupuesto, false)) {
            $errores[] = 'El presupuesto debe ser un número válido, positivo y mayor a cero.';
        } else {
            $presupuestoFloat = (float)$presupuesto;
            if ($presupuestoFloat <= 0) {
                $errores[] = 'El presupuesto debe ser estrictamente mayor a 0.';
            } elseif ($presupuestoFloat > self::PRESUPUESTO_MAXIMO) {
                $errores[] = 'El presupuesto no puede ser mayor a ' .
                    Utilidades::formatearNumero(self::PRESUPUESTO_MAXIMO, 0) . '.';
            }
        }

        // ── Procesamiento si no hay errores ──
        if (empty($errores)) {
            $presupuestoFloat = (float)$presupuesto;
            
            // Lógica de cálculo delegada al modelo
            $distribucion = PresupuestoModel::calcularDistribucion($presupuestoFloat);
            $porcentajes = PresupuestoModel::obtenerPorcentajes();

            $resultado = [
                'presupuestoTotal' => $presupuestoFloat,
                'distribucion'     => $distribucion,
                'porcentajes'      => $porcentajes
            ];
        }

        $datos = [
            'resultado'   => $resultado,
            'errores'     => $errores,
            'presupuesto' => $presupuesto,
        ];

        Utilidades::renderVista('problema6', 'Problema 6', $datos);
    }
}
