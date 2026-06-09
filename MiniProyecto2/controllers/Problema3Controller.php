<?php
/**
 * Problema3Controller.php - Controlador del Problema 3.
 *
 * Maneja la lógica del Problema 3 siguiendo el patrón MVC.
 * Recibe datos del formulario, los procesa y pasa los resultados a la vista.
 *
 * @author  Estudiante
 * @version 1.0
 */
class Problema3Controller
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
            // TODO: Implementar lógica del Problema 3
            $datos['resultado'] = 'Resultado del Problema 3 (pendiente de implementación).';
        }

        Utilidades::renderVista('problema3', 'Problema 3', $datos);
    }
}
