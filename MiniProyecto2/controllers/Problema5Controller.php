<?php
/**
 * Problema5Controller.php - Controlador del Problema 5.
 *
 * Maneja la lógica del Problema 5 siguiendo el patrón MVC.
 * Recibe datos del formulario, los procesa y pasa los resultados a la vista.
 *
 * @author  Estudiante
 * @version 1.0
 */
class Problema5Controller
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
            // TODO: Implementar lógica del Problema 5
            $datos['resultado'] = 'Resultado del Problema 5 (pendiente de implementación).';
        }

        Utilidades::renderVista('problema5', 'Problema 5', $datos);
    }
}
