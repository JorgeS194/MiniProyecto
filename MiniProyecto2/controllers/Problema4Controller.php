<?php
/**
 * Problema4Controller.php - Controlador del Problema 4.
 *
 * Gestiona el flujo del Problema 4 según el patrón MVC:
 *   - index()    → muestra el formulario con valor por defecto (petición GET).
 *   - procesar() → calcula la suma de pares e impares hasta el límite dado (petición POST).
 *
 * @author  Estudiante
 * @version 2.0
 */
class Problema4Controller
{
    const MAX_LIMITE = 100000;
    const UMBRAL_DETALLE = 10;

    /**
     * Muestra el formulario del Problema 4.
     * Se invoca cuando el usuario accede por primera vez (GET).
     *
     * @return void
     */
    public function index()
    {
        $datos = [
            'resultado' => null,
            'errores'   => [],
            'limite'    => '200', // Valor por defecto del enunciado
        ];

        Utilidades::renderVista('problema4', 'Problema 4', $datos);
    }

    /**
     * Recibe los datos enviados por POST, los valida y pasa los resultados a la vista.
     * Calcula independientemente la suma de pares e impares.
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
                $errores[] = 'El límite debe ser mayor o igual a 1.';
            } elseif ($limiteInt > self::MAX_LIMITE) { // Prevención de DoS
                $errores[] = 'El límite es demasiado grande. Ingrese un valor menor o igual a 100,000.';
            }
        }

        // ── Procesamiento si no hay errores ──
        if (empty($errores)) {
            $n = (int)$limite;
            $sumaPares = 0;
            $sumaImpares = 0;

            // Bucle único para calcular ambas sumatorias de forma eficiente (no duplicar código)
            for ($i = 1; $i <= $n; $i++) {
                if ($i % 2 === 0) {
                    $sumaPares += $i;
                } else {
                    $sumaImpares += $i;
                }
            }

            // Procedimiento detallado y amigable para la vista
            $ultimoPar = ($n % 2 === 0) ? $n : $n - 1;
            $ultimoImpar = ($n % 2 === 0) ? $n - 1 : $n;

            if ($n <= self::UMBRAL_DETALLE) {
                $pasosPares = [];
                $pasosImpares = [];
                for ($i = 1; $i <= $n; $i++) {
                    if ($i % 2 === 0) {
                        $pasosPares[] = $i;
                    } else {
                        $pasosImpares[] = $i;
                    }
                }
                $procPares = empty($pasosPares) ? 'No hay números pares.' : 'Suma = ' . implode(' + ', $pasosPares);
                $procImpares = empty($pasosImpares) ? 'No hay números impares.' : 'Suma = ' . implode(' + ', $pasosImpares);
            } else {
                $procPares = "Suma = 2 + 4 + 6 + 8 + 10 + ... + " . $ultimoPar;
                $procImpares = "Suma = 1 + 3 + 5 + 7 + 9 + ... + " . $ultimoImpar;
            }

            $resultado = [
                'limite'       => $n,
                'sumaPares'    => $sumaPares,
                'sumaImpares'  => $sumaImpares,
                'procPares'    => $procPares,
                'procImpares'  => $procImpares,
            ];
        }

        $datos = [
            'resultado' => $resultado,
            'errores'   => $errores,
            'limite'    => $limite,
        ];

        Utilidades::renderVista('problema4', 'Problema 4', $datos);
    }
}
