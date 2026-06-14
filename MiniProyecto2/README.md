# Mini Proyecto — Desarrollo de Software VII

## Información General

- **Universidad:** Universidad Tecnológica de Panamá
- **Facultad:** Facultad de Ingeniería de Sistemas Computacionales
- **Curso:** Desarrollo de Software VII
- **Estudiantes:**
  - Jorge Sarmiento
  - Leonardo Castro
- **Fecha de realización:** Miércoles 3 de junio de 2026
- **Guía elaborada por:** Ing. Irina Fong

---

## Introducción

Este proyecto académico fue desarrollado en **PHP puro**, sin frameworks,
aplicando el patrón de diseño **MVC (Modelo-Vista-Controlador)** y
siguiendo las convenciones de codificación **PSR-1**. El objetivo es
resolver **9 problemas independientes** de lógica de programación
(estadística, sumatorias, clasificación, presupuestos, fechas y
potencias), cada uno con su propio formulario de entrada, validación,
procesamiento y presentación de resultados.

A lo largo del desarrollo se aplicaron de forma consistente los
siguientes principios y buenas prácticas:

- **Programación Orientada a Objetos (POO):** cada problema tiene su
  propia clase Controlador (`Problema1Controller` a
  `Problema9Controller`), y la lógica de negocio más compleja se
  encapsula en clases Modelo (`PresupuestoModel`, `EstacionModel`).
- **Métodos estáticos:** la clase `Utilidades` centraliza validación,
  sanitización, cálculos estadísticos, formateo y componentes de
  presentación reutilizables, todos como métodos estáticos
  (`Utilidades::metodo()`), de modo que no requieren instanciación.
- **Principio DRY (Don't Repeat Yourself):** componentes de layout
  (`header.php`, `footer.php`, `menu.php`), enrutamiento dinámico,
  clases CSS reutilizables y métodos compartidos evitan duplicación de
  código.
- **Seguridad (OWASP):** validación de entradas, sanitización y escape
  de salida en todos los formularios y resultados.

---

## Estructura del Proyecto

```
MiniProyecto2/
│
├── assets/                  → Recursos estáticos
│   ├── css/styles.css       → Estilos globales y componentes reutilizables
│   ├── js/main.js           → Funciones JS auxiliares
│   └── images/              → Imágenes ilustrativas (estaciones del año)
│
├── components/              → Componentes PHP reutilizables (DRY)
│   ├── header.php           → Encabezado HTML, meta tags y banner
│   ├── footer.php           → Pie de página con fecha dinámica
│   └── menu.php             → Menú principal con tarjetas a los 9 problemas
│
├── controllers/              → Controladores MVC (lógica de orquestación)
│   ├── Problema1Controller.php  → Media, desviación, mínimo y máximo
│   ├── Problema2Controller.php  → Suma de 1 a 1000
│   ├── Problema3Controller.php  → N primeros múltiplos de 4
│   ├── Problema4Controller.php  → Suma de pares e impares (1-200)
│   ├── Problema5Controller.php  → Clasificación de edades
│   ├── Problema6Controller.php  → Presupuesto hospitalario
│   ├── Problema7Controller.php  → Calculadora estadística (N notas)
│   ├── Problema8Controller.php  → Estación del año
│   └── Problema9Controller.php  → 15 primeras potencias
│
├── models/                   → Modelos de datos (reglas de negocio)
│   ├── PresupuestoModel.php  → Distribución porcentual del presupuesto
│   └── EstacionModel.php     → Determinación de estación según fecha
│
├── utilities/                → Clases de utilidades estáticas
│   └── Utilidades.php        → Validación, sanitización, estadística, presentación
│
├── views/                     → Vistas (presentación HTML)
│   ├── problema1.php  ...  problema9.php
│
├── index.php                 → Front Controller (punto de entrada)
└── README.md                 → Este archivo
```

---

## Requisitos y Ejecución

**Requisitos:**
- PHP 7.4 o superior
- Servidor web (Servidor integrado de PHP / WAMP/XAMPP, Apache, u otro)

**Ejecución local**, desde la carpeta `MiniProyecto2/`:

```bash
php -S localhost:8000
```

Luego abrir en el navegador: [http://localhost:8000](http://localhost:8000)

---

## Tecnologías Utilizadas

- **PHP 7.4+** (puro, sin frameworks ni dependencias de Composer)
- **HTML5** semántico
- **CSS3** con variables (Custom Properties) para theming centralizado
- **JavaScript** (vanilla, funciones auxiliares en `main.js`)
- **Chart.js** (vía CDN) para las gráficas de los Problemas 5 y 6
- **Google Fonts** (Outfit y Plus Jakarta Sans) para tipografía
- **Git** para control de versiones

---

## Arquitectura MVC

El proyecto sigue una separación estricta de responsabilidades:

- **`index.php` (Front Controller):** punto de entrada único. Lee el
  parámetro `problema` de la URL (`index.php?problema=N`), valida que
  esté en el rango 1-9, instancia dinámicamente el controlador
  correspondiente y delega la petición según el método HTTP (`GET` →
  `index()`, `POST` → `procesar()`).
- **Controladores (`controllers/`):** reciben los datos del formulario,
  los sanitizan y validan, ejecutan la lógica (propia o delegada a un
  modelo), y preparan el array `$datos` que se envía a la vista.
- **Modelos (`models/`):** encapsulan reglas de negocio con entidad
  propia (ver sección "¿Por qué solo dos problemas tienen modelo?").
- **Vistas (`views/`):** solo presentación. Reciben variables ya
  procesadas (`$resultado`, `$errores`, etc.) y las muestran usando
  HTML + métodos de `Utilidades` para escape y formateo. No contienen
  lógica de negocio ni cálculos.
- **`Utilidades` (`utilities/`):** biblioteca transversal de métodos
  estáticos usada por controladores y vistas (validación, sanitización,
  estadística, navegación, manejo de errores).

---

## Uso de POO y Métodos Estáticos

Todas las clases del proyecto siguen PSR-1: nombres de clases en
`PascalCase`, métodos y variables en `camelCase`, y constantes en
`MAYUSCULAS_CON_GUIONES_BAJOS`.

### Clase `Utilidades` (biblioteca estática central)

Es el corazón reutilizable del proyecto. Todos sus métodos son
`public static`, por lo que se invocan directamente
(`Utilidades::metodo(...)`) sin necesidad de instanciar la clase. Está
organizada en 5 secciones:

**Sección 1 — Validación de datos**
- `validarNumero($valor, $permitirNegativos = true)`: usa
  `filter_var($valor, FILTER_VALIDATE_FLOAT)` para verificar que un
  valor sea numérico (entero o decimal), con control opcional sobre
  negativos.
- `validarTexto($texto, $minLen, $maxLen, $soloLetras)`: usa
  `preg_match()` para validar longitud y, opcionalmente, que el texto
  contenga solo letras Unicode (incluye tildes y ñ).

**Sección 2 — Sanitización**
- `sanitizarTexto($texto)`: aplica `trim()` → `strip_tags()` →
  `htmlspecialchars()` en cadena, garantizando que ninguna entrada del
  usuario pueda inyectar HTML o scripts.

**Sección 3 — Cálculos estadísticos**
- `calcularMedia(array $numeros)`: promedio aritmético
  (`array_sum() / count()`), con guarda contra arrays vacíos.
- `calcularDesviacionEstandar(array $numeros)`: desviación estándar
  poblacional (divide entre N), implementando paso a paso media →
  diferencias al cuadrado → varianza → raíz cuadrada (`sqrt()`).
  Devuelve `null` si hay menos de 2 elementos.
- `obtenerMaximo(array $numeros)` / `obtenerMinimo(array $numeros)`:
  envoltorios seguros de `max()` / `min()` con guarda de array vacío.

**Sección 4 — Navegación y presentación**
- `volverMenu($echo = true)`: genera el enlace "Volver al menú
  principal", reutilizado de forma idéntica en las 9 vistas.
- `mostrarErrores(array $errores, $echo = true)`: genera la caja de
  errores de validación (`.error-box`), reutilizada de forma idéntica
  en las 9 vistas. Aplica `escapar()` a cada mensaje antes de mostrarlo.

**Sección 5 — Métodos heredados (v1.0)**
- `escapar($texto)`: envoltorio de `htmlspecialchars()` con
  `ENT_QUOTES` y `UTF-8`, usado en **todas** las salidas dinámicas del
  proyecto para prevenir XSS.
- `renderVista($vista, $titulo, $datos)`: hace `extract($datos)` e
  incluye `header.php` + la vista solicitada + `footer.php`, formando
  el layout completo de cada página.
- `renderError($mensaje)`: muestra una página de error estilizada
  cuando el enrutador no encuentra un controlador válido.
- `esPost()`, `obtenerPost()`, `obtenerGet()`: envoltorios seguros de
  los superglobales `$_SERVER`, `$_POST` y `$_GET`.
- `formatearNumero($numero, $decimales = 2)`: usa `number_format()`
  para mostrar números con separadores de miles y decimales
  consistentes en toda la aplicación.

### Constantes de clase (PSR-1)

Cada controlador define sus propios límites y parámetros como
constantes en `MAYÚSCULAS`, evitando "números mágicos" dispersos en el
código:

| Controlador | Constantes definidas |
|---|---|
| `Problema1Controller` | `TOTAL_NUMEROS = 5`, `VALOR_MAXIMO = 1000000` |
| `Problema2Controller` | `MAX_LIMITE = 1000`, `UMBRAL_DETALLE = 5` |
| `Problema3Controller` | `MAX_N = 1000` |
| `Problema4Controller` | `MAX_LIMITE = 100000`, `UMBRAL_DETALLE = 10` |
| `Problema5Controller` | `TOTAL_PERSONAS = 5`, `EDAD_MIN = 0`, `EDAD_MAX = 120`, `EDAD_LIMITE_NINO = 12`, `EDAD_LIMITE_ADOLESCENTE = 17`, `EDAD_LIMITE_ADULTO = 64` |
| `Problema6Controller` | `PRESUPUESTO_MAXIMO = 1000000000000` |
| `Problema7Controller` | `MAX_NOTAS = 50`, `NOTA_MAXIMA = 100` |
| `Problema9Controller` | `TOTAL_POTENCIAS = 15`, `BASE_MINIMA = 1`, `BASE_MAXIMA = 9` |
| `PresupuestoModel` | `PORCENTAJE_GINECOLOGIA = 40.0`, `PORCENTAJE_TRAUMATOLOGIA = 35.0`, `PORCENTAJE_PEDIATRIA = 25.0` |
| `EstacionModel` | `PRIMAVERA`, `VERANO`, `OTONIO`, `INVIERNO` (nombres de estaciones) |

---

## Funciones Matemáticas y de Cálculo

Aunque el proyecto no define una función `sqr()` genérica como ejemplo
clásico de método estático, sí encapsula toda la lógica matemática
reutilizable dentro de `Utilidades` (Sección 3) y de los modelos:

- **Operaciones con raíz cuadrada:** `calcularDesviacionEstandar()`
  usa `sqrt($varianza)` internamente para obtener la desviación
  estándar a partir de la varianza poblacional.
- **Potenciación:** `Problema9Controller::procesar()` usa el operador
  `**` de PHP (`$base ** $exponente`) dentro de un bucle `for` para
  generar las 15 primeras potencias de un número entre 1 y 9.
- **Sumatorias con bucles `for`:** `Problema2Controller` (suma de 1 a
  N) y `Problema4Controller` (suma de pares e impares) acumulan
  resultados iterando con `for`, evitando fórmulas "mágicas" sin mostrar
  el procedimiento.
- **Distribución porcentual:** `PresupuestoModel::calcularDistribucion()`
  aplica reglas de tres simples (`($total * porcentaje) / 100`) para
  cada área hospitalaria.
- **Determinación de estación:** `EstacionModel::obtenerEstacion()`
  compara mes y día contra rangos de fechas usando `switch` (ver
  sección dedicada más abajo).

---

## Funciones de Validación y Sanitización

Todas las entradas de usuario pasan por el mismo flujo en cada
controlador, garantizando consistencia:

1. **Obtención segura:** `Utilidades::obtenerPost($campo)` — devuelve el
   valor de `$_POST` con `trim()` aplicado, o una cadena vacía si no
   existe.
2. **Sanitización:** `Utilidades::sanitizarTexto($valor)` — aplica
   `trim()` → `strip_tags()` → `htmlspecialchars()` en cadena.
3. **Validación numérica:** `Utilidades::validarNumero($valor, $permitirNegativos)`
   — usa `filter_var(..., FILTER_VALIDATE_FLOAT)` para confirmar que el
   valor sea numérico, con control de signo.
4. **Validaciones de dominio específicas por problema:** cada
   controlador añade reglas adicionales según el enunciado (rango de
   edades, número entero vs. decimal, límites máximos anti-DoS, formato
   de fecha con `preg_match()` y `checkdate()`, etc.).
5. **Escape de salida:** `Utilidades::escapar($valor)` — aplicado a
   **toda** variable que se imprime en HTML, incluyendo mensajes de
   error, valores repoblados en formularios y resultados calculados.

---

## Aplicación de OWASP — Problema por Problema

A continuación se detalla cómo cada uno de los 9 problemas aplica
principios de seguridad alineados con **OWASP** (prevención de XSS,
validación de entrada del lado del servidor, manejo seguro de errores y
prevención de denegación de servicio por entradas excesivas).

### Problema 1 — Media, desviación, mínimo y máximo
- **Validación de entrada:** cada uno de los 5 campos se valida con
  `Utilidades::validarNumero($valor, false)` (no negativos) y además se
  exige `> 0` de forma estricta.
- **Prevención de denegación de servicio / desbordamiento visual:**
  se agregó la constante `VALOR_MAXIMO = 1000000`; cualquier valor que
  la exceda es rechazado con un mensaje de error antes de procesarse,
  evitando que números desproporcionados rompan el layout de las
  tarjetas de resultado.
- **Prevención de XSS:** los 5 valores ingresados se sanitizan con
  `Utilidades::sanitizarTexto()` antes de repoblarse en el formulario, y
  los resultados (`media`, `desviación`, `mínimo`, `máximo`) se imprimen
  siempre a través de `Utilidades::escapar()`.

### Problema 2 — Suma de 1 a 1000
- **Validación de entrada:** se valida que el límite sea numérico
  (`validarNumero`), entero (`(float) == (int)`), mayor o igual a 1 y,
  mediante la constante `MAX_LIMITE = 1000`, no superior al máximo
  permitido — esto previene que un usuario solicite una sumatoria
  arbitrariamente grande (prevención de DoS).
- **Manejo de errores:** si la validación falla, no se ejecuta ningún
  cálculo; `$resultado` permanece `null` y la vista solo muestra la caja
  de errores (`Utilidades::mostrarErrores()`), sin exponer detalles
  internos de PHP.
- **Prevención de XSS:** el procedimiento (`"Suma = 1 + 2 + ... + N"`) y
  la fórmula de comprobación se escapan con `Utilidades::escapar()`
  antes de mostrarse dentro de `<code class="bloque-codigo">`.

### Problema 3 — N primeros múltiplos de 4
- **Validación de entrada y prevención de desbordamiento:** la
  constante `MAX_N = 1000` limita la cantidad de múltiplos a generar,
  evitando que un valor de N extremadamente alto genere un array enorme
  y agote memoria/tiempo de ejecución del servidor (mencionado
  explícitamente en el enunciado como "¿Desbordamiento?").
- **Validación de tipo:** se verifica que N sea un entero positivo
  (`$nFloat != $nInt` rechaza decimales).
- **Prevención de XSS:** cada fila de la tabla de resultados
  (`índice`, `operación`, `valor`) pasa por `Utilidades::escapar()`,
  incluyendo el operando dinámico `"4 × $i"`.

### Problema 4 — Suma de pares e impares (1-200)
- **Prevención de DoS:** la constante `MAX_LIMITE = 100000` acota el
  rango superior que el usuario puede solicitar, evitando bucles
  excesivamente largos.
- **Validación de tipo y signo:** se exige que el límite sea un entero
  positivo (`$limiteInt >= 1`) antes de iniciar el bucle `for`.
- **Prevención de XSS:** las cuatro salidas (`sumaPares`, `sumaImpares`,
  `procPares`, `procImpares`) se escapan individualmente con
  `Utilidades::escapar()` antes de insertarse en las tarjetas
  `.panel-columna`.

### Problema 5 — Clasificación de edades
- **Validación de rango de dominio:** cada una de las 5 edades se
  valida no solo como número entero, sino dentro del rango humano
  realista definido por las constantes `EDAD_MIN = 0` y
  `EDAD_MAX = 120`, evitando datos absurdos (edades negativas o de
  miles de años) que podrían distorsionar las estadísticas o la
  gráfica.
- **Sanitización antes de clasificar:** los valores se sanitizan con
  `sanitizarTexto()` antes de convertirse a `(int)` para la
  clasificación por `if/elseif` (niño/adolescente/adulto/adulto mayor).
- **Prevención de XSS en datos dinámicos de Chart.js:** los conteos por
  categoría se castean explícitamente a `(int)` antes de inyectarse en
  el `<script>` de Chart.js, evitando que cualquier valor no numérico
  termine ejecutándose como código JavaScript.

### Problema 6 — Presupuesto hospitalario
- **Validación de entrada:** el presupuesto debe ser numérico
  (`validarNumero`) y estrictamente mayor a 0.
- **Prevención de desbordamiento visual y DoS:** la constante
  `PRESUPUESTO_MAXIMO = 1000000000000` (un billón) limita el valor
  máximo aceptado, evitando que cifras astronómicas rompan el diseño de
  las tarjetas (`.tarjeta-metrica__valor` además incorpora
  `word-break: break-word` como defensa adicional en CSS).
- **Separación de lógica de negocio:** los porcentajes (40/35/25%) y el
  cálculo de distribución viven en `PresupuestoModel`, no en la vista ni
  expuestos directamente al usuario, reduciendo superficie de
  manipulación.
- **Prevención de XSS en Chart.js:** los tres montos distribuidos se
  castean a `(float)` antes de insertarse en el `<script>` de la
  gráfica de pastel.

### Problema 7 — Calculadora estadística (N notas)
- **Validación en dos pasos:** el paso 1 valida que `N` (cantidad de
  notas) sea un entero entre 1 y `MAX_NOTAS = 50` — este límite previene
  que un usuario solicite generar cientos de campos de formulario
  (prevención de DoS).
- **Validación de dominio en el paso 2:** cada nota individual se valida
  como número no negativo y, mediante `NOTA_MAXIMA = 100`, no puede
  exceder el máximo de una calificación real.
- **Manejo de estado sin exponer lógica interna:** el campo oculto
  `paso` y `cantidad` se sanitizan igual que cualquier otro input del
  usuario (`sanitizarTexto` + `validarNumero`), sin asumir que un campo
  oculto es automáticamente confiable.
- **Prevención de XSS:** el listado de notas ingresadas
  (`implode(', ', $resultado['notas'])`) se escapa como un todo antes de
  mostrarse.

### Problema 8 — Estación del año
- **Validación estricta de formato de fecha:** se usa
  `preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)` para asegurar el formato
  `YYYY-MM-DD` que envía un `<input type="date">`, rechazando cualquier
  cadena que no cumpla ese patrón antes de procesarla.
- **Validación semántica de fecha:** además del formato, se usa
  `checkdate($mes, $dia, $anio)` para rechazar fechas imposibles (por
  ejemplo, 31 de febrero), evitando resultados indefinidos en
  `EstacionModel`.
- **Manejo de errores sin información sensible:** si la fecha es
  inválida, se agrega un mensaje genérico a `$errores` y `$resultado`
  permanece `null`; no se revela ningún detalle de la implementación
  interna del cálculo de estaciones.
- **Prevención de XSS en imagen dinámica:** la ruta de la imagen
  (`'assets/images/' . $resultado['imagen']`) se construye a partir de
  un valor controlado por `EstacionModel` (no por el usuario
  directamente) y aun así se pasa por `Utilidades::escapar()` antes de
  usarse en el atributo `src`.

### Problema 9 — 15 primeras potencias de un número
- **Validación de rango de dominio:** mediante las constantes
  `BASE_MINIMA = 1` y `BASE_MAXIMA = 9`, se garantiza que la base sea
  exactamente la permitida por el enunciado, evitando que un usuario
  solicite potencias de números arbitrarios que podrían generar
  resultados desproporcionadamente grandes.
- **Validación de tipo entero:** se rechaza cualquier valor decimal
  (`$numeroFloat != $numeroInt`).
- **Prevención de XSS en tabla de resultados:** cada celda
  (`exponente`, `operación`, `resultado`) se escapa individualmente con
  `Utilidades::escapar()`, y los valores numéricos grandes se formatean
  con `Utilidades::formatearNumero()` para una presentación legible y
  controlada.

### Aplicación transversal (todos los problemas)
- **Caja de errores centralizada:** `Utilidades::mostrarErrores($errores)`
  escapa cada mensaje de error individualmente antes de mostrarlo,
  evitando que un mensaje de validación mal formado se interprete como
  HTML.
- **Página de error genérica:** `Utilidades::renderError($mensaje)` se
  usa en `index.php` cuando el parámetro `problema` está fuera de rango
  o el controlador no existe, mostrando un mensaje controlado en lugar
  de un error fatal de PHP que expondría rutas del servidor.
- **Enrutamiento validado:** `index.php` usa
  `filter_input(INPUT_GET, 'problema', FILTER_VALIDATE_INT)` y verifica
  el rango `1-9` antes de construir dinámicamente el nombre de la clase
  del controlador, evitando instanciar clases arbitrarias a partir de
  input del usuario.

---

## Uso de `switch` — Problema 8 y `EstacionModel`

Como parte de los requisitos de la guía, se incorporó la estructura de
control `switch` en `models/EstacionModel.php`, en tres métodos:

- **`obtenerEstacion($mes, $dia)`:** un `switch ($mes)` evalúa el mes de
  la fecha ingresada. Para los meses que son límite entre dos
  estaciones (marzo, junio, septiembre, diciembre), el `case`
  correspondiente compara además el día (`$dia >= 21`, etc.) para
  determinar si ya ocurrió el cambio de estación. Se sigue la convención
  del **hemisferio sur**, consistente con el ejemplo de la guía
  (25 de septiembre → Primavera). Un `default` final garantiza que el
  método siempre retorne un valor válido (manejo de errores OWASP: no
  hay rutas sin retorno).
- **`obtenerImagen($estacion)`:** un segundo `switch` mapea el nombre de
  la estación a su archivo de imagen ilustrativa correspondiente, con
  `default` como respaldo.
- **`obtenerEmoji($estacion)`:** un tercer `switch` asigna un emoji
  representativo a cada estación, también con `default`.

Esta estructura demuestra el uso de `switch` con `default` tanto para
lógica de negocio (determinación de estación) como para mapeo de datos
de presentación (imagen, emoji), cumpliendo el patrón de manejo de casos
explícito recomendado en la guía.

---

## Decisión de Diseño: `require_once` explícito en lugar de Autoloader

El proyecto utiliza `require_once` explícito (por ejemplo,
`Problema6Controller.php` incluye `models/PresupuestoModel.php`, y
`Problema8Controller.php` incluye `models/EstacionModel.php`) en lugar
de un autoloader (`spl_autoload_register()` o similar).

Esta es una **decisión de diseño consciente**, no una omisión. Un
autoloader aporta valor cuando un proyecto tiene decenas o cientos de
clases y la carga manual se vuelve inmanejable. En este proyecto, el
total de clases es reducido y estable: 9 controladores, 2 modelos y 1
clase de utilidades (12 clases en total). Con `require_once` explícito:

- Cada archivo declara de forma clara y trazable sus dependencias
  directas, justo donde se usan.
- No se requiere configuración adicional ni convenciones de nombres de
  archivo más allá de las ya usadas (`NombreClase.php`).
- El comportamiento del proyecto es más fácil de seguir para fines
  educativos, ya que cada `require_once` es visible y explícito en el
  punto de uso.

Se optó por mantener esta simplicidad y trazabilidad en lugar de
introducir una capa adicional de configuración que, para el tamaño
actual del proyecto, no aportaría un beneficio proporcional a su
complejidad.

---

## ¿Por qué solo los Problemas 6 y 8 tienen Modelo dedicado?

En el patrón MVC, el **Modelo** existe para encapsular **reglas de
negocio o datos con entidad propia**, independientes de la petición
HTTP actual — es decir, conceptos que tendrían sentido aunque no
existiera un formulario o controlador.

Aplicando ese criterio a los 9 problemas:

- **Problema 6 (`PresupuestoModel`):** la distribución porcentual del
  presupuesto hospitalario (Ginecología 40%, Traumatología 35%,
  Pediatría 25%) es una **regla de negocio real**, con sus propias
  constantes y un método de cálculo (`calcularDistribucion()`). Tiene
  sentido como entidad independiente del controlador.
- **Problema 8 (`EstacionModel`):** la tabla de equivalencias entre
  fechas y estaciones del año (con sus respectivas imágenes y emojis) es
  igualmente una **regla de negocio con entidad propia**
  (`obtenerEstacion()`, `obtenerImagen()`, `obtenerEmoji()`),
  independiente de cómo se solicite o muestre.
- **Problemas 1, 2, 3, 4, 5, 7 y 9:** su lógica corresponde a
  **operaciones matemáticas genéricas y reutilizables** (media,
  desviación estándar, mínimo, máximo, sumatorias, clasificación por
  rangos, potencias). Esas operaciones genéricas ya residen en la capa
  compartida `Utilidades` (Sección 3 — Cálculos estadísticos). La lógica
  *específica* de cada uno de estos problemas (qué validar, cómo armar
  el resultado) es lo bastante simple como para vivir directamente en el
  controlador, sin necesidad de una clase Modelo adicional.

Crear modelos "vacíos" o artificiales solo para que cada carpeta tenga
contenido habría sido sobre-ingeniería. La decisión de qué problemas
requieren un Modelo dedicado refleja el criterio de diseño de **cuándo
una responsabilidad tiene suficiente complejidad y entidad propia** para
justificar su propia clase, y cuándo es más apropiado apoyarse en la
capa de utilidades compartida.

---

## Principios Aplicados (Resumen)

| Principio | Implementación |
|---|---|
| **MVC** | Separación estricta en `controllers/`, `models/` y `views/`, con `index.php` como Front Controller |
| **DRY** | Componentes reutilizables (`header`, `footer`, `menu`), enrutamiento dinámico, clases CSS reutilizables (`.panel-formulario`, `.tarjeta-metrica`, `.tabla-multiplos`, `.tabla-datos`, `.panel-columna`), `Utilidades::volverMenu()` y `Utilidades::mostrarErrores()` |
| **PSR-1** | Clases en `PascalCase`, métodos/variables en `camelCase`, constantes en `MAYUSCULAS`, sin números mágicos en validaciones |
| **POO** | Una clase Controlador por problema, dos clases Modelo para reglas de negocio con entidad propia |
| **Métodos estáticos** | Clase `Utilidades` completa, además de `PresupuestoModel` y `EstacionModel` |
| **Estructuras de control** | `for`, `foreach` (explícito en Problema 7), `if/elseif`, `switch` (Problema 8 / `EstacionModel`) |
| **Seguridad (OWASP)** | Validación server-side, sanitización (`trim`/`strip_tags`/`htmlspecialchars`), escape de salida (`escapar()`), límites anti-DoS, manejo de errores sin exposición de detalles internos |

---

## Autores

- **Jorge Sarmiento**
- **Leonardo Castro**

Desarrollo de Software VII — Universidad Tecnológica de Panamá