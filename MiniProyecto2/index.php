<?php
/**
 * index.php - Punto de entrada principal de la aplicación.
 *
 * Este archivo actúa como Front Controller del proyecto.
 * Recibe todas las peticiones, determina qué controlador invocar
 * según el parámetro "problema" de la URL, y delega la ejecución.
 *
 * Ejemplo de URL: index.php?problema=1
 *
 * @author  Estudiante
 * @version 1.0
 */

// ──────────────────────────────────────────────
// 1. Configuración inicial
// ──────────────────────────────────────────────
define('BASE_PATH', __DIR__);

// Incluir utilidades globales
require_once BASE_PATH . '/utilities/Utilidades.php';

// ──────────────────────────────────────────────
// 2. Determinar el problema solicitado
// ──────────────────────────────────────────────

// Se obtiene el número de problema desde la query string; por defecto es null (menú).
$problema = filter_input(INPUT_GET, 'problema', FILTER_VALIDATE_INT);

// ──────────────────────────────────────────────
// 3. Enrutamiento hacia el controlador adecuado
// ──────────────────────────────────────────────

if ($problema !== null && $problema >= 1 && $problema <= 9) {
    // Construir el nombre del controlador dinámicamente (DRY)
    $controllerFile = BASE_PATH . "/controllers/Problema{$problema}Controller.php";
    $controllerClass = "Problema{$problema}Controller";

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controller = new $controllerClass();

        // GET → mostrar formulario vacío | POST → procesar datos enviados
        if (Utilidades::esPost()) {
            $controller->procesar();
        } else {
            $controller->index();
        }
    } else {
        // Controlador no encontrado
        Utilidades::renderError("El controlador para el Problema {$problema} no fue encontrado.");
    }
} else {
    // ──────────────────────────────────────────
    // 4. Sin problema seleccionado → mostrar menú principal
    // ──────────────────────────────────────────
    $titulo = 'Mini Proyecto - Desarrollo Web VII';
    require_once BASE_PATH . '/components/header.php';
    require_once BASE_PATH . '/components/menu.php';
    require_once BASE_PATH . '/components/footer.php';
}
