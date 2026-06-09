/**
 * main.js - Script principal del Mini Proyecto.
 *
 * Contiene funciones JavaScript reutilizables que pueden ser
 * utilizadas por cualquiera de los 9 problemas.
 */

'use strict';

/**
 * Muestra u oculta un elemento del DOM por su ID.
 *
 * @param {string} id - ID del elemento a alternar.
 */
function toggleElemento(id) {
    const el = document.getElementById(id);
    if (el) {
        el.style.display = el.style.display === 'none' ? 'block' : 'none';
    }
}

/**
 * Limpia todos los campos de un formulario.
 *
 * @param {string} formId - ID del formulario a limpiar.
 */
function limpiarFormulario(formId) {
    const form = document.getElementById(formId);
    if (form) {
        form.reset();
    }
}

// Indicar que el script se cargó correctamente
console.log('Mini Proyecto - JS cargado correctamente.');
