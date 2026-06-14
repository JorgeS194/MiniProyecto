<?php
/**
 * Utilidades.php - Biblioteca central de métodos estáticos reutilizables.
 *
 * Esta clase agrupa todas las funciones de apoyo que los controladores
 * y vistas pueden necesitar a lo largo del proyecto. Al ser todos los
 * métodos estáticos, se invoca directamente sin instanciar la clase,
 * lo que reduce acoplamiento y favorece el principio DRY.
 *
 * Técnicas utilizadas:
 *  - filter_var()       para validación de tipos numéricos
 *  - preg_match()       para validación de patrones de texto
 *  - htmlspecialchars() para sanitización de salida HTML (anti-XSS)
 *
 * @author  Estudiante
 * @version 2.0
 */
class Utilidades
{
    // =========================================================================
    // SECCIÓN 1 — Validación de datos
    // =========================================================================

    /**
     * Verifica si un valor es un número válido (entero o decimal).
     *
     * Internamente combina filter_var con FILTER_VALIDATE_FLOAT para aceptar
     * tanto enteros como números con punto decimal. También acepta negativos
     * cuando el parámetro $permitirNegativos está en true.
     *
     * Ejemplo de uso:
     *   Utilidades::validarNumero('3.14');        // true
     *   Utilidades::validarNumero('-5', false);   // false
     *   Utilidades::validarNumero('abc');         // false
     *
     * @param  mixed $valor           El valor a evaluar (puede venir de un input HTML).
     * @param  bool  $permitirNegativos Indica si los números negativos son válidos.
     *                                 Por defecto es true.
     * @return bool  True si el valor es un número válido, false en caso contrario.
     */
    public static function validarNumero($valor, $permitirNegativos = true)
    {
        // filter_var devuelve el valor casteado si pasa, o false si falla
        $esNumero = filter_var($valor, FILTER_VALIDATE_FLOAT) !== false;

        if (!$esNumero) {
            return false;
        }

        // Si no se permiten negativos, rechazar valores menores a cero
        if (!$permitirNegativos && (float) $valor < 0) {
            return false;
        }

        return true;
    }

    /**
     * Verifica si un texto cumple con criterios básicos de validez.
     *
     * Utiliza preg_match para asegurar que el texto no esté vacío y
     * que su longitud se encuentre dentro de los límites definidos.
     * Opcionalmente puede restringir el contenido solo a letras, espacios
     * y tildes (útil para nombres y campos de texto simples).
     *
     * Ejemplo de uso:
     *   Utilidades::validarTexto('Hola Mundo');           // true
     *   Utilidades::validarTexto('');                     // false
     *   Utilidades::validarTexto('Hi', 1, 5);             // true
     *   Utilidades::validarTexto('Nombre123', 1, 50, true); // false (modo solo letras)
     *
     * @param  string $texto      El texto a validar.
     * @param  int    $minLen     Longitud mínima permitida. Por defecto 1.
     * @param  int    $maxLen     Longitud máxima permitida. Por defecto 255.
     * @param  bool   $soloLetras Si es true, solo permite letras, tildes y espacios.
     *                            Por defecto false.
     * @return bool   True si el texto pasa todas las validaciones, false si no.
     */
    public static function validarTexto($texto, $minLen = 1, $maxLen = 255, $soloLetras = false)
    {
        // Verificar que sea una cadena y que no esté vacía tras recortar espacios
        if (!is_string($texto) || trim($texto) === '') {
            return false;
        }

        $longitud = mb_strlen(trim($texto), 'UTF-8');

        // Validar rango de longitud
        if ($longitud < $minLen || $longitud > $maxLen) {
            return false;
        }

        // Si se solicita solo letras: permite letras Unicode, tildes y espacios
        if ($soloLetras) {
            // \p{L} cubre letras de cualquier idioma (incluye ñ, á, é, etc.)
            if (!preg_match('/^[\p{L}\s]+$/u', trim($texto))) {
                return false;
            }
        }

        return true;
    }

    // =========================================================================
    // SECCIÓN 2 — Sanitización
    // =========================================================================

    /**
     * Limpia y prepara un texto para ser almacenado o procesado de forma segura.
     *
     * Aplica múltiples capas de limpieza en este orden:
     *  1. trim() para eliminar espacios al inicio y al final.
     *  2. strip_tags() para eliminar etiquetas HTML o PHP incrustadas.
     *  3. htmlspecialchars() para convertir caracteres especiales en entidades HTML.
     *
     * Esto garantiza que ningún texto del usuario pueda inyectar código malicioso
     * en la aplicación (protección básica anti-XSS).
     *
     * Ejemplo de uso:
     *   Utilidades::sanitizarTexto('  <b>Hola</b> Mundo!  ');
     *   // Retorna: '&lt;b&gt;Hola&lt;/b&gt; Mundo!'
     *
     * @param  string $texto El texto crudo que proviene del usuario.
     * @return string        Texto limpio y seguro para mostrar en HTML.
     */
    public static function sanitizarTexto($texto)
    {
        // Paso 1: Eliminar espacios al inicio y al final
        $texto = trim($texto);

        // Paso 2: Eliminar cualquier etiqueta HTML o PHP
        $texto = strip_tags($texto);

        // Paso 3: Convertir caracteres especiales a entidades HTML
        $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');

        return $texto;
    }

    // =========================================================================
    // SECCIÓN 3 — Cálculos estadísticos
    // =========================================================================

    /**
     * Calcula la media aritmética (promedio) de un conjunto de números.
     *
     * Suma todos los elementos del array y divide entre la cantidad total.
     * Si el array está vacío, devuelve null para evitar división por cero.
     *
     * Ejemplo de uso:
     *   Utilidades::calcularMedia([10, 20, 30]);  // 20.0
     *   Utilidades::calcularMedia([]);            // null
     *
     * @param  float[]   $numeros Array de valores numéricos a promediar.
     * @return float|null         La media aritmética, o null si el array está vacío.
     */
    public static function calcularMedia(array $numeros)
    {
        $total = count($numeros);

        if ($total === 0) {
            return null;
        }

        $suma = array_sum($numeros);

        return $suma / $total;
    }

    /**
     * Calcula la desviación estándar de un conjunto de números.
     *
     * La desviación estándar mide cuánto se dispersan los valores
     * respecto a la media. Se implementa la fórmula poblacional (divide
     * entre N), adecuada para conjuntos de datos completos.
     *
     * Pasos de la fórmula:
     *  1. Calcular la media del conjunto.
     *  2. Restar la media a cada elemento y elevar al cuadrado.
     *  3. Calcular la media de esas diferencias al cuadrado (varianza).
     *  4. Aplicar la raíz cuadrada a la varianza.
     *
     * Si se pasa un array con menos de 2 elementos, devuelve null ya que
     * no tiene sentido estadístico calcularla con un solo dato.
     *
     * Ejemplo de uso:
     *   Utilidades::calcularDesviacionEstandar([2, 4, 4, 4, 5, 5, 7, 9]); // 2.0
     *   Utilidades::calcularDesviacionEstandar([7]);                       // null
     *
     * @param  float[]   $numeros Array de valores numéricos.
     * @return float|null         La desviación estándar poblacional, o null si
     *                            el array tiene menos de 2 elementos.
     */
    public static function calcularDesviacionEstandar(array $numeros)
    {
        $total = count($numeros);

        if ($total < 2) {
            return null;
        }

        // Paso 1: Obtener la media
        $media = self::calcularMedia($numeros);

        // Paso 2 y 3: Sumar el cuadrado de las diferencias respecto a la media
        $sumaCuadrados = 0.0;
        foreach ($numeros as $valor) {
            $sumaCuadrados += ($valor - $media) ** 2;
        }

        // Varianza poblacional = suma de cuadrados / N
        $varianza = $sumaCuadrados / $total;

        // Paso 4: Raíz cuadrada de la varianza
        return sqrt($varianza);
    }

    /**
     * Obtiene el valor máximo de un array de números.
     *
     * Utiliza la función nativa max() de PHP y devuelve null si el array
     * está vacío, evitando así errores en tiempo de ejecución.
     *
     * Ejemplo de uso:
     *   Utilidades::obtenerMaximo([3, 1, 7, 2]);  // 7
     *   Utilidades::obtenerMaximo([]);             // null
     *
     * @param  float[]   $numeros Array de valores numéricos.
     * @return float|null         El valor más alto del array, o null si está vacío.
     */
    public static function obtenerMaximo(array $numeros)
    {
        if (empty($numeros)) {
            return null;
        }

        return max($numeros);
    }

    /**
     * Obtiene el valor mínimo de un array de números.
     *
     * Utiliza la función nativa min() de PHP y devuelve null si el array
     * está vacío, evitando así errores en tiempo de ejecución.
     *
     * Ejemplo de uso:
     *   Utilidades::obtenerMinimo([3, 1, 7, 2]);  // 1
     *   Utilidades::obtenerMinimo([]);             // null
     *
     * @param  float[]   $numeros Array de valores numéricos.
     * @return float|null         El valor más bajo del array, o null si está vacío.
     */
    public static function obtenerMinimo(array $numeros)
    {
        if (empty($numeros)) {
            return null;
        }

        return min($numeros);
    }

    // =========================================================================
    // SECCIÓN 4 — Navegación y presentación
    // =========================================================================

    /**
     * Genera y renderiza el botón/enlace "Volver al menú principal".
     *
     * Centraliza el código HTML del enlace de retorno para que todos los
     * problemas lo utilicen de forma idéntica, evitando duplicación (DRY).
     * El parámetro $echo controla si se imprime directamente o se retorna
     * como cadena, dando mayor flexibilidad a las vistas.
     *
     * Ejemplo de uso desde una vista:
     *   Utilidades::volverMenu();          // Imprime el enlace directamente
     *   $html = Utilidades::volverMenu(false); // Retorna el HTML como cadena
     *
     * @param  bool   $echo Si es true (por defecto), imprime el HTML en pantalla.
     *                      Si es false, retorna el HTML como cadena.
     * @return string|void  Retorna el HTML solo si $echo es false.
     */
    public static function volverMenu($echo = true)
    {
        $html = '<nav class="nav-volver">'
              . '<a href="index.php">&#8592; Volver al men&uacute; principal</a>'
              . '</nav>';

        if ($echo) {
            echo $html;
            return;
        }

        return $html;
    }

    /**
     * Muestra la caja de errores de validación si el array no está vacío.
     *
     * Centraliza el bloque HTML de errores para evitar repetición en
     * todas las vistas (principio DRY). Sigue el mismo patrón que
     * volverMenu(). Aplica escape XSS a cada mensaje (OWASP).
     *
     * Ejemplo de uso desde una vista:
     *   Utilidades::mostrarErrores($errores);
     *
     * @param  array  $errores Array de mensajes de error a mostrar.
     * @param  bool   $echo    Si es true (por defecto), imprime el HTML.
     *                         Si es false, retorna el HTML como cadena.
     * @return string|void     Retorna el HTML solo si $echo es false.
     */
    public static function mostrarErrores(array $errores, $echo = true)
    {
        if (empty($errores)) {
            return;
        }

        $html  = '<div class="error-box" style="text-align:left; margin-bottom:1.5rem;">';
        $html .= '<strong>⚠️ Por favor corrige los siguientes errores:</strong>';
        $html .= '<ul style="margin-top:.5rem; padding-left:1.25rem;">';

        foreach ($errores as $e) {
            $html .= '<li>' . self::escapar($e) . '</li>';
        }

        $html .= '</ul>';
        $html .= '</div>';

        if ($echo) {
            echo $html;
            return;
        }

        return $html;
    }

    // =========================================================================
    // SECCIÓN 5 — Métodos heredados de la versión anterior (v1.0)
    // =========================================================================

    /**
     * Escapa una cadena para prevenir XSS al mostrarla en HTML.
     *
     * Aplica htmlspecialchars con la codificación UTF-8 y el modo ENT_QUOTES,
     * de manera que tanto comillas simples como dobles sean escapadas.
     *
     * Ejemplo de uso:
     *   Utilidades::escapar('<script>alert("xss")</script>');
     *   // Retorna: '&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;'
     *
     * @param  string $texto Texto a escapar.
     * @return string        Texto seguro para HTML.
     */
    public static function escapar($texto)
    {
        return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Renderiza una vista dentro del layout completo (header + contenido + footer).
     *
     * Extrae el array $datos como variables individuales accesibles desde
     * la vista, luego incluye los archivos en orden correcto usando BASE_PATH.
     *
     * @param  string $vista  Nombre del archivo de vista sin extensión (e.g. 'problema1').
     * @param  string $titulo Título que se mostrará en la pestaña del navegador.
     * @param  array  $datos  Variables a inyectar en la vista mediante extract().
     * @return void
     */
    public static function renderVista($vista, $titulo = '', $datos = [])
    {
        // Poner $titulo disponible para el header
        extract($datos);

        require_once BASE_PATH . '/components/header.php';
        require_once BASE_PATH . "/views/{$vista}.php";
        require_once BASE_PATH . '/components/footer.php';
    }

    /**
     * Muestra una página de error estilizada con un mensaje descriptivo.
     *
     * Útil cuando el enrutador no encuentra el controlador solicitado o
     * cuando ocurre algún error inesperado en la aplicación.
     *
     * @param  string $mensaje El mensaje de error a mostrar al usuario.
     * @return void
     */
    public static function renderError($mensaje)
    {
        $titulo = 'Error';
        require_once BASE_PATH . '/components/header.php';
        echo '<main class="container">';
        echo '<div class="error-box">';
        echo '<h2>&#9888;&#65039; Error</h2>';
        echo '<p>' . self::escapar($mensaje) . '</p>';
        echo '<a href="index.php" class="btn">Volver al men&uacute;</a>';
        echo '</div>';
        echo '</main>';
        require_once BASE_PATH . '/components/footer.php';
    }

    /**
     * Verifica si la petición HTTP actual es de tipo POST.
     *
     * @return bool True si el método de la petición es POST, false en caso contrario.
     */
    public static function esPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Obtiene un valor de $_POST de forma segura, aplicando trim().
     *
     * @param  string $clave   Clave a buscar en el superglobal $_POST.
     * @param  mixed  $default Valor a retornar si la clave no existe.
     * @return mixed           El valor encontrado (con trim) o el valor por defecto.
     */
    public static function obtenerPost($clave, $default = '')
    {
        return isset($_POST[$clave]) ? trim($_POST[$clave]) : $default;
    }

    /**
     * Obtiene un valor de $_GET de forma segura, aplicando trim().
     *
     * @param  string $clave   Clave a buscar en el superglobal $_GET.
     * @param  mixed  $default Valor a retornar si la clave no existe.
     * @return mixed           El valor encontrado (con trim) o el valor por defecto.
     */
    public static function obtenerGet($clave, $default = '')
    {
        return isset($_GET[$clave]) ? trim($_GET[$clave]) : $default;
    }

    /**
     * Formatea un número con separadores de miles y decimales.
     *
     * Usa el punto como separador decimal y la coma como separador de miles,
     * siguiendo la convención internacional habitual en documentos técnicos.
     *
     * Ejemplo de uso:
     *   Utilidades::formatearNumero(1234567.891); // '1,234,567.89'
     *
     * @param  float  $numero    Número a formatear.
     * @param  int    $decimales Cantidad de decimales a mostrar. Por defecto 2.
     * @return string            Número formateado como cadena.
     */
    public static function formatearNumero($numero, $decimales = 2)
    {
        return number_format((float) $numero, $decimales, '.', ',');
    }
}
