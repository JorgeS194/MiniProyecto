<?php
/**
 * Problema8Controller.php - Controlador del Problema 8.
 *
 * Estación del Año.
 * Recibe una fecha ingresada por el usuario y determina a qué
 * estación del año corresponde (hemisferio sur), delegando la
 * lógica de negocio al modelo EstacionModel.
 *
 * @author  Estudiante
 * @version 1.0
 */

// Incluir el modelo explícitamente ya que no hay un autoloader configurado
require_once BASE_PATH . '/models/EstacionModel.php';

class Problema8Controller
{
    /**
     * Muestra el formulario del Problema 8 sin procesar datos.
     * Se invoca cuando el usuario accede por primera vez (GET).
     *
     * @return void
     */
    public function index()
    {
        $datos = [
            'resultado' => null,
            'errores'   => [],
            'fecha'     => '',
        ];

        Utilidades::renderVista('problema8', 'Problema 8', $datos);
    }

    /**
     * Recibe la fecha enviada por POST, la valida y determina
     * la estación del año correspondiente.
     *
     * @return void
     */
    public function procesar()
    {
        $errores   = [];
        $resultado = null;

        // ── Obtener y sanear la fecha del formulario ──
        $fechaRaw = Utilidades::obtenerPost('fecha');
        $fecha    = Utilidades::sanitizarTexto($fechaRaw);

        // ── Validaciones ──
        if ($fecha === '') {
            $errores[] = 'Debe seleccionar una fecha.';
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            // El input type="date" envía el formato YYYY-MM-DD
            $errores[] = 'El formato de la fecha no es válido.';
        } else {
            [$anio, $mes, $dia] = array_map('intval', explode('-', $fecha));

            if (!checkdate($mes, $dia, $anio)) {
                $errores[] = 'La fecha ingresada no es una fecha real.';
            }
        }

        // ── Procesamiento si no hay errores ──
        if (empty($errores)) {
            $estacion = EstacionModel::obtenerEstacion($mes, $dia);

            $resultado = [
                'fechaIngresada' => sprintf('%02d-%02d', $dia, $mes),
                'fechaCompleta'  => $fecha,
                'estacion'       => $estacion,
                'emoji'          => EstacionModel::obtenerEmoji($estacion),
                'imagen'         => EstacionModel::obtenerImagen($estacion),
            ];
        }

        $datos = [
            'resultado' => $resultado,
            'errores'   => $errores,
            'fecha'     => $fecha,
        ];

        Utilidades::renderVista('problema8', 'Problema 8', $datos);
    }
}