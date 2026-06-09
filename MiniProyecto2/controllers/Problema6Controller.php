<?php
/**
 * Problema6Controller.php - Controlador del Problema 6.
 *
 * Maneja la lógica del Problema 6 siguiendo el patrón MVC.
 * Recibe datos del formulario, los procesa y pasa los resultados a la vista.
 *
 * @author  Estudiante
 * @version 1.0
 */
class Problema6Controller
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
            // TODO: Implementar lógica del Problema 6
            $datos['resultado'] = 'Resultado del Problema 6 (pendiente de implementación).';
        }

        Utilidades::renderVista('problema6', 'Problema 6', $datos);
    }
}
