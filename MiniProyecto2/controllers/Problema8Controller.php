<?php
/**
 * Problema8Controller.php - Controlador del Problema 8.
 *
 * Maneja la lógica del Problema 8 siguiendo el patrón MVC.
 * Recibe datos del formulario, los procesa y pasa los resultados a la vista.
 *
 * @author  Estudiante
 * @version 1.0
 */
class Problema8Controller
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

        if (Utilidades::esPost()) {
            // TODO: Implementar lógica del Problema 8
            $datos['resultado'] = 'Resultado del Problema 8 (pendiente de implementación).';
        }

        Utilidades::renderVista('problema8', 'Problema 8', $datos);
    }
}
