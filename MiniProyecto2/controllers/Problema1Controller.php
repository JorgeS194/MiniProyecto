<?php
/**
 * Problema1Controller.php - Controlador del Problema 1.
 *
 * Maneja la lógica del Problema 1 siguiendo el patrón MVC.
 * Recibe datos del formulario, los procesa y pasa los resultados a la vista.
 *
 * @author  Estudiante
 * @version 1.0
 */
class Problema1Controller
{
    /**
     * Acción principal del controlador.
     * Procesa la petición y renderiza la vista correspondiente.
     */
    public function index()
    {
        $datos = [
            'resultado' => null,
        ];

        // Procesar formulario si la petición es POST
        if (Utilidades::esPost()) {
            // TODO: Implementar lógica del Problema 1
            $datos['resultado'] = 'Resultado del Problema 1 (pendiente de implementación).';
        }

        // Renderizar la vista
        Utilidades::renderVista('problema1', 'Problema 1', $datos);
    }
}
