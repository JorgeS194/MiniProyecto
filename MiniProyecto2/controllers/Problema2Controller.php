<?php
/**
 * Problema2Controller.php - Controlador del Problema 2.
 *
 * Maneja la lógica del Problema 2 siguiendo el patrón MVC.
 * Recibe datos del formulario, los procesa y pasa los resultados a la vista.
 *
 * @author  Estudiante
 * @version 1.0
 */
class Problema2Controller
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
            // TODO: Implementar lógica del Problema 2
            $datos['resultado'] = 'Resultado del Problema 2 (pendiente de implementación).';
        }

        // Renderizar la vista
        Utilidades::renderVista('problema2', 'Problema 2', $datos);
    }
}
