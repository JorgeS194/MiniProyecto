<?php
/**
 * EstacionModel.php - Modelo para determinar la estación del año.
 *
 * Encapsula la lógica de negocio y constantes relacionadas con
 * la determinación de la estación del año a partir de una fecha,
 * usando la convención del hemisferio sur (acorde al ejemplo de
 * la guía: 25/09 → Primavera).
 *
 * @author  Estudiante
 * @version 1.0
 */
class EstacionModel
{
    // Nombres de las estaciones (hemisferio sur)
    const PRIMAVERA = 'Primavera';
    const VERANO    = 'Verano';
    const OTONIO    = 'Otoño';
    const INVIERNO  = 'Invierno';

    /**
     * Determina la estación del año correspondiente a una fecha dada,
     * según la convención del hemisferio sur:
     *   - Primavera: 21 de septiembre al 20 de diciembre
     *   - Verano:    21 de diciembre al 20 de marzo
     *   - Otoño:     21 de marzo al 20 de junio
     *   - Invierno:  21 de junio al 20 de septiembre
     *
     * Internamente utiliza switch para evaluar el mes, y resuelve
     * los casos límite (cambios de estación) comparando el día.
     *
     * @param  int $mes Mes de la fecha (1-12).
     * @param  int $dia Día de la fecha (1-31).
     * @return string   Nombre de la estación correspondiente.
     */
    public static function obtenerEstacion($mes, $dia)
    {
        switch ($mes) {
            case 12:
                return ($dia >= 21) ? self::VERANO : self::PRIMAVERA;

            case 1:
            case 2:
                return self::VERANO;

            case 3:
                return ($dia >= 21) ? self::OTONIO : self::VERANO;

            case 4:
            case 5:
                return self::OTONIO;

            case 6:
                return ($dia >= 22) ? self::INVIERNO : self::OTONIO;

            case 7:
            case 8:
                return self::INVIERNO;

            case 9:
                return ($dia >= 23) ? self::PRIMAVERA : self::INVIERNO;

            case 10:
            case 11:
                return self::PRIMAVERA;

            default:
                return self::PRIMAVERA;
        }
    }

    /**
     * Devuelve el nombre del archivo de imagen ilustrativa asociado
     * a una estación, para mostrar en la vista.
     *
     * @param  string $estacion Nombre de la estación.
     * @return string           Nombre del archivo de imagen.
     */
    public static function obtenerImagen($estacion)
    {
        switch ($estacion) {
            case self::PRIMAVERA:
                return 'primavera.jpg';

            case self::VERANO:
                return 'verano.jpg';

            case self::OTONIO:
                return 'otonio.jpg';

            case self::INVIERNO:
                return 'invierno.jpg';

            default:
                return 'primavera.jpg';
        }
    }

    /**
     * Devuelve un emoji representativo de la estación, útil como
     * apoyo visual ligero sin depender de imágenes externas.
     *
     * @param  string $estacion Nombre de la estación.
     * @return string           Emoji asociado.
     */
    public static function obtenerEmoji($estacion)
    {
        switch ($estacion) {
            case self::PRIMAVERA:
                return '🌸';

            case self::VERANO:
                return '☀️';

            case self::OTONIO:
                return '🍂';

            case self::INVIERNO:
                return '❄️';

            default:
                return '🌸';
        }
    }
}