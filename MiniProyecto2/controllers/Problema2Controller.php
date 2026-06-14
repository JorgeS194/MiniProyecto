<?php
/**
 * Problema2Controller.php - Controlador del Problema 2.
 *
 * Gestiona el flujo del Problema 2 según el patrón MVC:
 *   - index()    → muestra el formulario vacío o con valor por defecto (petición GET).
 *   - procesar() → calcula la suma del 1 al N (petición POST).
 *
 * @author  Estudiante
 * @version 2.0
 */
class Problema2Controller
{
    const MAX_LIMITE = 1000;
    const UMBRAL_DETALLE = 5;

    /**
     * Muestra el formulario del Problema 2.
     * Se invoca cuando el usuario accede por primera vez (GET).
     *
     * @return void
     */
    public function index()
    {
        $datos = [
            'resultado' => null,
            'errores'   => [],
            'limite'    => '1000', // Valor por defecto
        ];

        Utilidades::renderVista('problema2', 'Problema 2', $datos);
    }

    /**
     * Recibe el límite, lo valida, lo sanitiza y calcula la suma.
     *
     * @return void
     */
    public function procesar()
    {
        $errores   = [];
        $resultado = null;

        // ── Obtener y sanear datos del formulario ──
        $limiteRaw = Utilidades::obtenerPost('limite');
        $limite = Utilidades::sanitizarTexto($limiteRaw);

        // ── Validaciones ──
        if ($limite === '') {
            $errores[] = 'El campo límite es requerido.';
        } elseif (!Utilidades::validarNumero($limite, false)) {
            $errores[] = 'El límite debe ser un número válido y positivo.';
        } else {
            // Verificar que sea un número entero y positivo
            $limiteFloat = (float)$limite;
            $limiteInt = (int)$limiteFloat;
            
            if ($limiteFloat != $limiteInt) {
                $errores[] = 'El límite debe ser un número entero.';
            } elseif ($limiteInt < 1) {
                $errores[] = 'El límite debe ser al menos 1.';
            } elseif ($limiteInt > self::MAX_LIMITE) { // Límite máximo razonable por seguridad (Prevención de DoS)
                $errores[] = 'El límite es demasiado grande. Ingrese un valor menor o igual a 1000.';
            }
        }

        // ── Procesamiento si no hay errores ──
        if (empty($errores)) {
            $n = (int)$limite;
            $suma = 0;

            // Uso de estructura de control (bucle for) para sumar los números del 1 al N
            for ($i = 1; $i <= $n; $i++) {
                $suma += $i;
            }

            // Explicación detallada del procedimiento para mostrar en la vista
            $procedimiento = "Suma = 1 + 2 + 3 + ... + " . $n;
            if ($n <= self::UMBRAL_DETALLE) {
                $pasos = [];
                for ($i = 1; $i <= $n; $i++) {
                    $pasos[] = $i;
                }
                $procedimiento = "Suma = " . implode(" + ", $pasos);
            }

            $resultado = [
                'limite'        => $n,
                'suma'          => $suma,
                'procedimiento' => $procedimiento,
                'formula'       => "Fórmula: ($n * ($n + 1)) / 2 = " . (($n * ($n + 1)) / 2),
            ];
        }

        $datos = [
            'resultado' => $resultado,
            'errores'   => $errores,
            'limite'    => $limite,
        ];

        Utilidades::renderVista('problema2', 'Problema 2', $datos);
    }
}
