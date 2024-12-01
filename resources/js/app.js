import './bootstrap';

$(document).ready(function() {
    // Inicializa el datepicker con el formato de año en 2 dígitos
    $('#fecha').datepicker({
        dateFormat: 'yy-mm-dd', // Formato: año con 2 dígitos, mes y día
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:2100' // Opcional, puedes definir un rango de años
    });
});
