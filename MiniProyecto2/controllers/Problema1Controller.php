<?php
/**
 * Problema1Controller.php - Controlador del Problema 1.
 *
 * Gestiona el flujo del Problema 1 según el patrón MVC:
 *   - index()    → muestra el formulario vacío (petición GET).
 *   - procesar() → recibe los datos del formulario y pasa resultados a la vista (petición POST).
 *
 * @author  Estudiante
 * @version 2.0
 */
class Problema1Controller
{
    const TOTAL_NUMEROS = 5;

    /**
     * Muestra el formulario del Problema 1 sin procesar datos.
     * Se invoca cuando el usuario accede por primera vez (GET).
     *
     * @return void
     */
    public function index()
    {
        $datos = [
            'resultado' => null,
            'errores'   => [],
            'nums'      => array_fill(1, self::TOTAL_NUMEROS, ''),
        ];

        Utilidades::renderVista('problema1', 'Problema 1', $datos);
    }

    /**
     * Recibe los datos enviados por POST, los valida, sanitiza y calcula
     * la media, desviación estándar, mínimo y máximo de 5 números positivos.
     *
     * @return void
     */
    public function procesar()
    {
        $errores   = [];
        $resultado = null;
        $nums      = [];

        // ── Obtener, sanitizar y validar datos del formulario ──
        for ($i = 1; $i <= self::TOTAL_NUMEROS; $i++) {
            $campo = "num$i";
            $valorRaw = Utilidades::obtenerPost($campo);
            $valorSanitizado = Utilidades::sanitizarTexto($valorRaw);
            $nums[$i] = $valorSanitizado;

            if ($valorSanitizado === '') {
                $errores[] = "El campo Número $i es requerido.";
            } elseif (!Utilidades::validarNumero($valorSanitizado, false)) {
                // Utilidades::validarNumero($val, false) valida que sea número y no sea negativo
                $errores[] = "El campo Número $i debe ser un número válido y no puede ser negativo.";
            } elseif ((float)$valorSanitizado <= 0) {
                // Validación estricta de número positivo (> 0)
                $errores[] = "El campo Número $i debe ser un número positivo estrictamente mayor que cero.";
            }
        }

        // ── Procesamiento si no hay errores de validación ──
        if (empty($errores)) {
            // Convertir el array de inputs a float
            $valores = array_map('floatval', $nums);

            $media = Utilidades::calcularMedia($valores);
            $desviacion = Utilidades::calcularDesviacionEstandar($valores);
            $minimo = Utilidades::obtenerMinimo($valores);
            $maximo = Utilidades::obtenerMaximo($valores);

            $resultado = [
                'media'      => $media,
                'desviacion' => $desviacion,
                'minimo'     => $minimo,
                'maximo'     => $maximo,
            ];
        }

        $datos = [
            'resultado' => $resultado,
            'errores'   => $errores,
            'nums'      => $nums,
        ];

        Utilidades::renderVista('problema1', 'Problema 1', $datos);
    }
}
