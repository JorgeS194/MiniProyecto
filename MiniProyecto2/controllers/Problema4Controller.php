<?php
/**
 * Problema4Controller.php - Controlador del Problema 4.
 *
 * Maneja la lógica del Problema 4 siguiendo el patrón MVC.
 * Recibe datos del formulario, los procesa y pasa los resultados a la vista.
 *
 * @author  Estudiante
 * @version 1.0
 */
class Problema4Controller
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
            // TODO: Implementar lógica del Problema 4
            $datos['resultado'] = 'Resultado del Problema 4 (pendiente de implementación).';
        }

        Utilidades::renderVista('problema4', 'Problema 4', $datos);
    }
}
