<?php
/**
 * Problema9Controller.php - Controlador del Problema 9.
 *
 * Solicita un número entero entre 1 y 9, y genera/imprime las
 * 15 primeras potencias de dicho número (n^1 hasta n^15).
 *
 * @author  Estudiante
 * @version 2.0
 */
class Problema9Controller
{
    /**
     * Cantidad de potencias a calcular, según el enunciado.
     */
    const TOTAL_POTENCIAS = 15;
    const BASE_MINIMA = 1;
    const BASE_MAXIMA = 9;

    /**
     * Muestra el formulario del Problema 9 sin procesar datos.
     * Se invoca cuando el usuario accede por primera vez (GET).
     *
     * @return void
     */
    public function index()
    {
        $datos = [
            'resultado' => null,
            'errores'   => [],
            'numero'    => '',
        ];

        Utilidades::renderVista('problema9', 'Problema 9', $datos);
    }

    /**
     * Recibe el número base (1-9), lo valida y calcula sus
     * 15 primeras potencias mediante un bucle for.
     *
     * @return void
     */
    public function procesar()
    {
        $errores   = [];
        $resultado = null;

        // ── Obtener y sanear datos del formulario ──
        $numeroRaw = Utilidades::obtenerPost('numero');
        $numero    = Utilidades::sanitizarTexto($numeroRaw);

        // ── Validaciones ──
        if ($numero === '') {
            $errores[] = 'El campo número es requerido.';
        } elseif (!Utilidades::validarNumero($numero, false)) {
            $errores[] = 'El número debe ser un valor válido y positivo.';
        } else {
            $numeroFloat = (float) $numero;
            $numeroInt   = (int) $numeroFloat;

            if ($numeroFloat != $numeroInt) {
                $errores[] = 'El número debe ser un valor entero.';
            } elseif ($numeroInt < self::BASE_MINIMA || $numeroInt > self::BASE_MAXIMA) {
                $errores[] = 'El número debe estar entre 1 y 9.';
            }
        }

        // ── Procesamiento si no hay errores ──
        if (empty($errores)) {
            $base      = (int) $numero;
            $potencias = [];

            // Bucle for para calcular las 15 primeras potencias
            for ($exponente = 1; $exponente <= self::TOTAL_POTENCIAS; $exponente++) {
                $valor = $base ** $exponente;

                $potencias[] = [
                    'exponente' => $exponente,
                    'operacion' => "$base ^ $exponente",
                    'valor'     => $valor,
                ];
            }

            $resultado = [
                'base'      => $base,
                'potencias' => $potencias,
            ];
        }

        $datos = [
            'resultado' => $resultado,
            'errores'   => $errores,
            'numero'    => $numero,
        ];

        Utilidades::renderVista('problema9', 'Problema 9', $datos);
    }
}