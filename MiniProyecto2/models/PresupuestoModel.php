<?php
/**
 * PresupuestoModel.php - Modelo para el cálculo de presupuesto hospitalario.
 *
 * Encapsula la lógica de negocio y constantes relacionadas con
 * la distribución del presupuesto anual entre las distintas áreas
 * del hospital.
 *
 * @author  Estudiante
 * @version 1.0
 */
class PresupuestoModel
{
    // Constantes para la distribución porcentual
    const PORCENTAJE_GINECOLOGIA = 40.0;
    const PORCENTAJE_TRAUMATOLOGIA = 35.0;
    const PORCENTAJE_PEDIATRIA = 25.0;

    /**
     * Calcula la distribución del presupuesto total.
     *
     * @param float $presupuestoTotal Presupuesto total ingresado.
     * @return array Array asociativo con montos calculados.
     */
    public static function calcularDistribucion($presupuestoTotal)
    {
        return [
            'ginecologia'   => ($presupuestoTotal * self::PORCENTAJE_GINECOLOGIA) / 100,
            'traumatologia' => ($presupuestoTotal * self::PORCENTAJE_TRAUMATOLOGIA) / 100,
            'pediatria'     => ($presupuestoTotal * self::PORCENTAJE_PEDIATRIA) / 100,
        ];
    }

    /**
     * Devuelve los porcentajes definidos para ser utilizados en vistas o gráficas.
     *
     * @return array Array asociativo con los porcentajes.
     */
    public static function obtenerPorcentajes()
    {
        return [
            'ginecologia'   => self::PORCENTAJE_GINECOLOGIA,
            'traumatologia' => self::PORCENTAJE_TRAUMATOLOGIA,
            'pediatria'     => self::PORCENTAJE_PEDIATRIA,
        ];
    }
}
