<?php
/**
 * Problema4Controller.php - Controlador del Problema 4.
 *
 * Gestiona el flujo del Problema 4 según el patrón MVC:
 *   - index()    → muestra el formulario vacío (petición GET).
 *   - procesar() → recibe los datos del formulario y pasa resultados a la vista (petición POST).
 *
 * @author  Estudiante
 * @version 2.0
 */
class Problema4Controller
{
    /**
     * Muestra el formulario del Problema 4 sin procesar datos.
     * Se invoca cuando el usuario accede por primera vez (GET).
     *
     * @return void
     */
    public function index()
    {
        $datos = [
            'resultado' => null,
            'errores'   => [],
        ];

        Utilidades::renderVista('problema4', 'Problema 4', $datos);
    }

    /**
     * Recibe los datos enviados por POST, los valida y pasa los resultados a la vista.
     * La lógica matemática se implementará en una fase posterior.
     *
     * @return void
     */
    public function procesar()
    {
        $errores   = [];
        $resultado = null;

        // ── Obtener y sanear datos del formulario ──
        $dato1 = Utilidades::sanitizarTexto(Utilidades::obtenerPost('dato1'));

        // ── Validaciones básicas ──
        if (!Utilidades::validarNumero($dato1)) {
            $errores[] = 'El valor ingresado no es un número válido.';
        }

        // ── Procesamiento (pendiente de implementación) ──
        if (empty($errores)) {
            // TODO: Implementar lógica del Problema 4
            $resultado = "Datos recibidos correctamente. Lógica pendiente de implementación.";
        }

        $datos = [
            'resultado' => $resultado,
            'errores'   => $errores,
            'dato1'     => $dato1,
        ];

        Utilidades::renderVista('problema4', 'Problema 4', $datos);
    }
}
