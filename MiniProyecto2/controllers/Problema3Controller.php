<?php
/**
 * Problema3Controller.php - Controlador del Problema 3.
 *
 * Gestiona el flujo del Problema 3 según el patrón MVC:
 *   - index()    → muestra el formulario vacío o con valor por defecto (petición GET).
 *   - procesar() → calcula los N primeros múltiplos de 4 (petición POST).
 *
 * @author  Estudiante
 * @version 2.0
 */
class Problema3Controller
{
    /**
     * Muestra el formulario del Problema 3.
     * Se invoca cuando el usuario accede por primera vez (GET).
     *
     * @return void
     */
    public function index()
    {
        $datos = [
            'resultado' => null,
            'errores'   => [],
            'n'         => '10', // Valor por defecto
        ];

        Utilidades::renderVista('problema3', 'Problema 3', $datos);
    }

    /**
     * Recibe la cantidad N, la valida, la sanitiza y calcula los múltiplos.
     *
     * @return void
     */
    public function procesar()
    {
        $errores   = [];
        $resultado = null;

        // ── Obtener y sanear datos del formulario ──
        $nRaw = Utilidades::obtenerPost('n');
        $n = Utilidades::sanitizarTexto($nRaw);

        // ── Validaciones ──
        if ($n === '') {
            $errores[] = 'El campo cantidad (N) es requerido.';
        } elseif (!Utilidades::validarNumero($n, false)) {
            $errores[] = 'El valor de N debe ser un número válido y positivo.';
        } else {
            // Verificar que sea un número entero y positivo
            $nFloat = (float)$n;
            $nInt = (int)$nFloat;
            
            if ($nFloat != $nInt) {
                $errores[] = 'La cantidad N debe ser un número entero.';
            } elseif ($nInt < 1) {
                $errores[] = 'La cantidad N debe ser mayor o igual a 1.';
            } elseif ($nInt > 1000) { // Límite máximo razonable por seguridad (Prevención de DoS / Overflow)
                $errores[] = 'La cantidad N es demasiado grande. Ingrese un valor menor o igual a 1,000.';
            }
        }

        // ── Procesamiento si no hay errores ──
        if (empty($errores)) {
            $cantidad = (int)$n;
            $multiplos = [];

            // Estructura repetitiva adecuada para generar los múltiplos de 4
            for ($i = 1; $i <= $cantidad; $i++) {
                $multiplo = 4 * $i;
                $multiplos[] = [
                    'indice'    => $i,
                    'operacion' => "4 × $i",
                    'valor'     => $multiplo
                ];
            }

            $resultado = [
                'n'         => $cantidad,
                'multiplos' => $multiplos,
            ];
        }

        $datos = [
            'resultado' => $resultado,
            'errores'   => $errores,
            'n'         => $n,
        ];

        Utilidades::renderVista('problema3', 'Problema 3', $datos);
    }
}
