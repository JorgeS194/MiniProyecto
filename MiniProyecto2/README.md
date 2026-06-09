# Mini Proyecto - Desarrollo Web VII

## Descripción

Proyecto académico desarrollado en **PHP puro** utilizando el patrón de diseño **MVC (Modelo-Vista-Controlador)** y siguiendo las convenciones **PSR-1** de codificación.

El proyecto está diseñado para resolver **9 problemas independientes**, cada uno con su propio controlador y vista, compartiendo componentes reutilizables y utilidades comunes.

## Estructura del Proyecto

```
MiniProyecto2/
│
├── assets/              → Recursos estáticos (CSS, JS, imágenes)
│   ├── css/styles.css
│   ├── js/main.js
│   └── images/
│
├── components/          → Componentes PHP reutilizables
│   ├── header.php       → Encabezado HTML y banner
│   ├── footer.php       → Pie de página y scripts
│   └── menu.php         → Menú principal con tarjetas
│
├── controllers/         → Controladores MVC (lógica de negocio)
│   ├── Problema1Controller.php
│   ├── Problema2Controller.php
│   ├── ...
│   └── Problema9Controller.php
│
├── models/              → Modelos de datos (por implementar)
│
├── utilities/           → Clases de utilidades estáticas
│   └── Utilidades.php
│
├── views/               → Vistas (presentación HTML)
│   ├── problema1.php
│   ├── problema2.php
│   ├── ...
│   └── problema9.php
│
├── index.php            → Front Controller (punto de entrada)
└── README.md            → Este archivo
```

## Principios Aplicados

| Principio           | Implementación                                                    |
|---------------------|-------------------------------------------------------------------|
| **MVC**             | Separación clara en controllers/, models/ y views/                |
| **DRY**             | Componentes reutilizables, enrutamiento dinámico, menú con bucle  |
| **PSR-1**           | Nombres PascalCase para clases, camelCase para métodos            |
| **Métodos estáticos** | Clase `Utilidades` con helpers estáticos                        |
| **Seguridad**       | Escape de salida HTML con `htmlspecialchars`                      |

## Requisitos

- PHP 7.4 o superior
- Servidor web (Apache, Nginx, o servidor integrado de PHP)

## Ejecución

Desde la carpeta `MiniProyecto2/`, ejecutar:

```bash
php -S localhost:8000
```

Luego abrir en el navegador: [http://localhost:8000](http://localhost:8000)

## Autor

Estudiante - Desarrollo Web VII
