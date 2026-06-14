<?php
/**
 * Problema7Controller.php - Controlador del Problema 7.
 *
 * Calculadora de Datos Estadísticos.
 * Permite al usuario indicar cuántas notas desea ingresar (N) y luego
 * calcula el promedio, la desviación estándar, la nota mínima y la
 * nota máxima recorriendo las notas con foreach.
 *
 * Flujo en dos pasos:
 *   1. El usuario ingresa N (cantidad de notas) → se generan N campos.
 *   2. El usuario ingresa las N notas → se calculan las estadísticas.
 *
 * @author  Estudiante
 * @version 1.0
 */
class Problema7Controller
{
    /**
     * Límite máximo de notas permitido por seguridad (Prevención de DoS).
     */
    const MAX_NOTAS = 50;
    const NOTA_MAXIMA = 100;

    /**
     * Muestra el formulario inicial del Problema 7 (paso 1: pedir N).
     * Se invoca cuando el usuario accede por primera vez (GET).
     *
     * @return void
     */
    public function index()
    {
        $datos = [
            'resultado' => null,
            'errores'   => [],
            'paso'      => 1,
            'cantidad'  => '',
            'notas'     => [],
        ];

        Utilidades::renderVista('problema7', 'Problema 7', $datos);
    }

    /**
     * Procesa las peticiones POST. Determina en qué paso del flujo
     * se encuentra el usuario mediante el campo oculto "paso".
     *
     * @return void
     */
    public function procesar()
    {
        $pasoRaw = Utilidades::sanitizarTexto(Utilidades::obtenerPost('paso'));
        $paso    = ($pasoRaw === '2') ? 2 : 1;

        if ($paso === 1) {
            $this->procesarPaso1();
        } else {
            $this->procesarPaso2();
        }
    }

    /**
     * Paso 1: recibe la cantidad de notas (N), la valida y genera
     * dinámicamente los N campos para el paso 2.
     *
     * @return void
     */
    private function procesarPaso1()
    {
        $errores  = [];
        $cantidad = Utilidades::sanitizarTexto(Utilidades::obtenerPost('cantidad'));

        // ── Validaciones de N ──
        if ($cantidad === '') {
            $errores[] = 'Debe indicar cuántas notas desea ingresar.';
        } elseif (!Utilidades::validarNumero($cantidad, false)) {
            $errores[] = 'La cantidad de notas debe ser un número válido y positivo.';
        } else {
            $cantidadFloat = (float) $cantidad;
            $cantidadInt   = (int) $cantidadFloat;

            if ($cantidadFloat != $cantidadInt) {
                $errores[] = 'La cantidad de notas debe ser un número entero.';
            } elseif ($cantidadInt < 1) {
                $errores[] = 'La cantidad de notas debe ser al menos 1.';
            } elseif ($cantidadInt > self::MAX_NOTAS) {
                $errores[] = 'La cantidad de notas es demasiado grande. Ingrese un valor menor o igual a ' . self::MAX_NOTAS . '.';
            }
        }

        if (!empty($errores)) {
            $datos = [
                'resultado' => null,
                'errores'   => $errores,
                'paso'      => 1,
                'cantidad'  => $cantidad,
                'notas'     => [],
            ];

            Utilidades::renderVista('problema7', 'Problema 7', $datos);
            return;
        }

        // ── Sin errores: avanzar al paso 2 generando los campos de notas ──
        $datos = [
            'resultado' => null,
            'errores'   => [],
            'paso'      => 2,
            'cantidad'  => (int) $cantidad,
            'notas'     => array_fill(1, (int) $cantidad, ''),
        ];

        Utilidades::renderVista('problema7', 'Problema 7', $datos);
    }

    /**
     * Paso 2: recibe las N notas, las valida, sanitiza y calcula
     * promedio, desviación estándar, mínima y máxima usando foreach.
     *
     * @return void
     */
    private function procesarPaso2()
    {
        $errores   = [];
        $resultado = null;
        $notas     = [];

        // ── Recuperar y validar la cantidad (N) enviada de forma oculta ──
        $cantidadRaw = Utilidades::sanitizarTexto(Utilidades::obtenerPost('cantidad'));

        if (!Utilidades::validarNumero($cantidadRaw, false)) {
            $errores[] = 'La cantidad de notas no es válida. Intente nuevamente.';
            $cantidad  = 0;
        } else {
            $cantidad = (int) $cantidadRaw;

            if ($cantidad < 1 || $cantidad > self::MAX_NOTAS) {
                $errores[] = 'La cantidad de notas no es válida. Intente nuevamente.';
                $cantidad  = 0;
            }
        }

        // ── Obtener, sanitizar y validar cada nota ──
        if ($cantidad > 0) {
            for ($i = 1; $i <= $cantidad; $i++) {
                $campo           = "nota$i";
                $valorRaw        = Utilidades::obtenerPost($campo);
                $valorSanitizado = Utilidades::sanitizarTexto($valorRaw);
                $notas[$i]       = $valorSanitizado;

                if ($valorSanitizado === '') {
                    $errores[] = "El campo Nota $i es requerido.";
                } elseif (!Utilidades::validarNumero($valorSanitizado, false)) {
                    $errores[] = "El campo Nota $i debe ser un número válido y no puede ser negativo.";
                } elseif ((float) $valorSanitizado > self::NOTA_MAXIMA) {
                    $errores[] = "El campo Nota $i no puede ser mayor a " . self::NOTA_MAXIMA . ".";
                }
            }
        }

        // ── Procesamiento si no hay errores: recorrido con foreach ──
        if (empty($errores)) {
            $valores = [];

            // Requisito del enunciado: recorrer la colección con foreach
            foreach ($notas as $notaTexto) {
                $valores[] = (float) $notaTexto;
            }

            $promedio   = Utilidades::calcularMedia($valores);
            $desviacion = Utilidades::calcularDesviacionEstandar($valores);
            $minima     = Utilidades::obtenerMinimo($valores);
            $maxima     = Utilidades::obtenerMaximo($valores);

            $resultado = [
                'cantidad'   => $cantidad,
                'promedio'   => $promedio,
                'desviacion' => $desviacion,
                'minima'     => $minima,
                'maxima'     => $maxima,
                'notas'      => $valores,
            ];
        }

        $datos = [
            'resultado' => $resultado,
            'errores'   => $errores,
            'paso'      => 2,
            'cantidad'  => $cantidad > 0 ? $cantidad : '',
            'notas'     => $notas,
        ];

        Utilidades::renderVista('problema7', 'Problema 7', $datos);
    }
}