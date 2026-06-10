<?php
/**
 * Problema5Controller.php - Controlador del Problema 5.
 *
 * Gestiona el flujo del Problema 5 según el patrón MVC:
 *   - index()    → muestra el formulario vacío (petición GET).
 *   - procesar() → recibe edades, las clasifica y genera estadísticas (petición POST).
 *
 * @author  Estudiante
 * @version 2.0
 */
class Problema5Controller
{
    /**
     * Muestra el formulario del Problema 5 sin procesar datos.
     * Se invoca cuando el usuario accede por primera vez (GET).
     *
     * @return void
     */
    public function index()
    {
        $datos = [
            'resultado' => null,
            'errores'   => [],
            'edades'    => array_fill(1, 5, ''),
        ];

        Utilidades::renderVista('problema5', 'Problema 5', $datos);
    }

    /**
     * Recibe los datos enviados por POST, los valida y pasa los resultados a la vista.
     *
     * @return void
     */
    public function procesar()
    {
        $errores   = [];
        $resultado = null;
        $edades    = [];

        // ── Obtener y sanear datos del formulario ──
        for ($i = 1; $i <= 5; $i++) {
            $campo = "edad$i";
            $valorRaw = Utilidades::obtenerPost($campo);
            $valorSanitizado = Utilidades::sanitizarTexto($valorRaw);
            $edades[$i] = $valorSanitizado;

            if ($valorSanitizado === '') {
                $errores[] = "El campo Edad $i es requerido.";
            } elseif (!Utilidades::validarNumero($valorSanitizado, false)) {
                $errores[] = "El campo Edad $i debe ser un número válido positivo o cero.";
            } else {
                $floatVal = (float)$valorSanitizado;
                $intVal = (int)$valorSanitizado;
                if ($floatVal != $intVal) {
                    $errores[] = "El campo Edad $i debe ser un número entero.";
                } elseif ($intVal < 0 || $intVal > 120) {
                    $errores[] = "El campo Edad $i debe estar entre 0 y 120 años.";
                }
            }
        }

        // ── Procesamiento si no hay errores ──
        if (empty($errores)) {
            $clasificacion = [
                'ninos' => 0,
                'adolescentes' => 0,
                'adultos' => 0,
                'adultos_mayores' => 0
            ];
            
            $edadesFrecuencia = [];
            $detalle = [];

            foreach ($edades as $i => $edadStr) {
                $edad = (int)$edadStr;
                
                // Clasificación
                $categoria = '';
                if ($edad <= 12) {
                    $clasificacion['ninos']++;
                    $categoria = 'Niño (0-12)';
                } elseif ($edad <= 17) {
                    $clasificacion['adolescentes']++;
                    $categoria = 'Adolescente (13-17)';
                } elseif ($edad <= 64) {
                    $clasificacion['adultos']++;
                    $categoria = 'Adulto (18-64)';
                } else {
                    $clasificacion['adultos_mayores']++;
                    $categoria = 'Adulto Mayor (65+)';
                }
                
                $detalle[] = ['persona' => $i, 'edad' => $edad, 'categoria' => $categoria];

                // Frecuencia para identificar repetidas
                if (!isset($edadesFrecuencia[$edad])) {
                    $edadesFrecuencia[$edad] = 0;
                }
                $edadesFrecuencia[$edad]++;
            }

            // Estadísticas adicionales (edades repetidas)
            $repetidas = [];
            foreach ($edadesFrecuencia as $ed => $freq) {
                if ($freq > 1) {
                    $repetidas[] = "La edad $ed se repite $freq veces.";
                }
            }

            $resultado = [
                'clasificacion' => $clasificacion,
                'detalle'       => $detalle,
                'repetidas'     => $repetidas
            ];
        }

        $datos = [
            'resultado' => $resultado,
            'errores'   => $errores,
            'edades'    => $edades,
        ];

        Utilidades::renderVista('problema5', 'Problema 5', $datos);
    }
}
