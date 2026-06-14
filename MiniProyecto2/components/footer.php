<?php
/**
 * footer.php - Componente reutilizable de pie de página.
 *
 * Cierra el layout HTML. Incluye créditos y la fecha actual formateada de manera dinámica.
 */
$dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
$meses = ['', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
$nombreDia = $dias[date('w')];
$diaNum = date('j');
$nombreMes = $meses[date('n')];
$anio = date('Y');
$fechaCompleta = "$nombreDia, $diaNum de $nombreMes de $anio";
?>

<!-- ═══ Pie de página ═══ -->
<footer class="footer">
    <p>&copy; <?php echo $anio; ?> &mdash; Mini Proyecto &middot; Desarrollo de Software VII</p>
    <p style="font-size: 0.75rem; margin-top: 0.25rem; opacity: 0.8;"><?php echo "Jorge Sarmiento y Leonardo Castro" ?></p>
    <p style="font-size: 0.75rem; margin-top: 0.25rem; opacity: 0.8;"><?php echo $fechaCompleta; ?></p>

</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
