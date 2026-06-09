<?php
/**
 * Utilidades.php - Clase de utilidades estáticas.
 *
 * Contiene métodos auxiliares reutilizables en todo el proyecto.
 * Todos los métodos son estáticos para poder invocarse sin instanciar la clase,
 * siguiendo el principio DRY y las convenciones PSR-1.
 *
 * @author  Estudiante
 * @version 1.0
 */
class Utilidades
{
    /**
     * Escapa una cadena para prevenir XSS al mostrarla en HTML.
     *
     * @param  string $texto Texto a escapar.
     * @return string        Texto seguro para HTML.
     */
    public static function escapar($texto)
    {
        return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Renderiza una vista dentro del layout (header + contenido + footer).
     *
     * @param string $vista  Nombre del archivo de vista (sin extensión).
     * @param string $titulo Título de la página.
     * @param array  $datos  Variables a pasar a la vista.
     */
    public static function renderVista($vista, $titulo = '', $datos = [])
    {
        // Extraer el array $datos como variables individuales para la vista
        extract($datos);

        require_once BASE_PATH . '/components/header.php';
        require_once BASE_PATH . "/views/{$vista}.php";
        require_once BASE_PATH . '/components/footer.php';
    }

    /**
     * Muestra una página de error con un mensaje descriptivo.
     *
     * @param string $mensaje Mensaje de error a mostrar.
     */
    public static function renderError($mensaje)
    {
        $titulo = 'Error';
        require_once BASE_PATH . '/components/header.php';
        echo '<main class="container">';
        echo '<div class="error-box">';
        echo '<h2>⚠️ Error</h2>';
        echo '<p>' . self::escapar($mensaje) . '</p>';
        echo '<a href="index.php" class="btn">Volver al menú</a>';
        echo '</div>';
        echo '</main>';
        require_once BASE_PATH . '/components/footer.php';
    }

    /**
     * Verifica si la petición actual es de tipo POST.
     *
     * @return bool True si la petición es POST.
     */
    public static function esPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Obtiene un valor del array $_POST de forma segura.
     *
     * @param  string $clave   Clave a buscar en $_POST.
     * @param  mixed  $default Valor por defecto si la clave no existe.
     * @return mixed           Valor encontrado o el valor por defecto.
     */
    public static function obtenerPost($clave, $default = '')
    {
        return isset($_POST[$clave]) ? trim($_POST[$clave]) : $default;
    }

    /**
     * Obtiene un valor del array $_GET de forma segura.
     *
     * @param  string $clave   Clave a buscar en $_GET.
     * @param  mixed  $default Valor por defecto si la clave no existe.
     * @return mixed           Valor encontrado o el valor por defecto.
     */
    public static function obtenerGet($clave, $default = '')
    {
        return isset($_GET[$clave]) ? trim($_GET[$clave]) : $default;
    }

    /**
     * Formatea un número con separadores de miles y decimales.
     *
     * @param  float  $numero   Número a formatear.
     * @param  int    $decimales Cantidad de decimales.
     * @return string           Número formateado.
     */
    public static function formatearNumero($numero, $decimales = 2)
    {
        return number_format($numero, $decimales, '.', ',');
    }
}
