<?php
/**
 * Problema7Controller.php - Controlador del Problema 7.
 *
 * Maneja la lógica del Problema 7 siguiendo el patrón MVC.
 * Recibe datos del formulario, los procesa y pasa los resultados a la vista.
 *
 * @author  Estudiante
 * @version 1.0
 */
class Problema7Controller
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
            // TODO: Implementar lógica del Problema 7
            $datos['resultado'] = 'Resultado del Problema 7 (pendiente de implementación).';
        }

        Utilidades::renderVista('problema7', 'Problema 7', $datos);
    }
}
